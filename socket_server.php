<?php

require __DIR__ . '/vendor/autoload.php'; // Load composer autoload
$app = require __DIR__ . '/bootstrap/app.php';  // Load Laravel application bootstrap
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Task;
use React\EventLoop\Loop;
use React\Socket\SocketServer;
use React\Socket\ConnectionInterface;

$loop = Loop::get();
$server = new SocketServer('127.0.0.1:8080', [], $loop);

echo "WebSocket server running on ws://127.0.0.1:8080\n";

// Track executed tasks
$executedTasks = [];

// Handle new client connections
$server->on('connection', function (ConnectionInterface $connection) use ($loop, &$executedTasks) {
    echo "New client connected\n";

    // Periodic task execution every 10 seconds
    $loop->addPeriodicTimer(10, function () use ($connection, &$executedTasks) {
        // echo "Checking tasks...\n";

        // Fetch tasks in chunks to avoid large memory usage
        Task::chunk(50, function ($tasks) use ($connection, &$executedTasks) {
            foreach ($tasks as $task) {
                if (isset($executedTasks[$task->id]) && $executedTasks[$task->id] >= now()->timestamp) {
                    continue; // Skip already executed tasks
                }

                $log = "Task Executed: {$task->name} at " . now();
                $task->last_executed_at = now();
                $task->save();

                $executedTasks[$task->id] = now()->timestamp; // Mark as executed
                $connection->write($log . "\n");
                echo $log . PHP_EOL;
            }
        });
    });

    // Periodically poll for new tasks every 5 seconds
    $loop->addPeriodicTimer(5, function () use (&$executedTasks, $connection) {
        // echo "Polling for new tasks...\n";

        $newTasks = Task::whereNotIn('id', array_keys($executedTasks))->get();
        foreach ($newTasks as $task) {
            $executedTasks[$task->id] = 0; // Mark as not executed yet
            $log = "New Task Added: {$task->name}";
            $connection->write($log . "\n");
            echo $log . PHP_EOL;
        }
    });

    $connection->on('data', function ($data) {
        echo "Received data: $data\n";
    });
    $connection->on('close', function () {
        echo "Client disconnected\n";
    });
});

// Run the loop
$loop->run();
