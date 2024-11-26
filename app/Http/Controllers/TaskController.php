<?php

    namespace App\Http\Controllers;

    use App\Models\Task;
    use Illuminate\Http\Request;

    class TaskController extends Controller
    {
        public function create()
        {
            return view('tasks.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'interval_seconds' => 'required|integer|min:1',
            ]);

            Task::create($request->only('name', 'description', 'interval_seconds'));

            return redirect()->route('tasks.create')->with('success', 'Task created successfully!');
        }

        public function logs()
        {
            return view('tasks.logs');
        }
    }
