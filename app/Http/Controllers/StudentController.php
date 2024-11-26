<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $student = Student::create(['name' => $request->name]);

        // Notify WebSocket clients
        $msg = json_encode(['type' => 'new-student', 'data' => $student]);
        $this->sendToWebSocketServer($msg);

        return response()->json($student);
    }

    public function index()
    {
        return view('students.list');
    }
    
    public function getStudentsListings()
    {
        return Student::all();
    }

    public function create() {
        return view('students.create');
    }

    protected function sendToWebSocketServer($message)
    {
        $socket = fsockopen('127.0.0.1', 8082);
        fwrite($socket, $message);
        fclose($socket);
    }
}
