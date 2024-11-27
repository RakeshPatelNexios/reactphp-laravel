<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Arr;

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
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:items',
        ]);

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

