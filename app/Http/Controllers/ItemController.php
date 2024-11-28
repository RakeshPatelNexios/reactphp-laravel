<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function itemslist() {
        return view('items.listings');
    }

    public function index()
    {
        return response()->json(Item::all());
    }

    public function itemscreate() {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:items|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|in:1,0',
        ];
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            $message = $validation->messages()->first();

            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        // Create the item
        $item = Item::create(Arr::except($request->all(), ['_token']));

        // Notify the Socket.IO server
        $this->notifyWebSocketServer([
            'event' => 'new-item',
            'data' => $item,
        ]);

        return response()->json($item);
    }

    // Helper function to notify the WebSocket server
    protected function notifyWebSocketServer($message)
    {
        $socket = fsockopen('127.0.0.1', 3000);
        fwrite($socket, json_encode($message));
        fclose($socket);
    }
}

