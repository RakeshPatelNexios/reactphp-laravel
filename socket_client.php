<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';  // Load Laravel application bootstrap

// use React\ChildProcess\Process;
use React\EventLoop\Loop;
use React\Socket\Connector;

$connector = new Connector();
$globalConnection = null;
$timer = 0;

$connector->connect('127.0.0.1:8082')->then(function (React\Socket\ConnectionInterface $connection) use(&$globalConnection) {
    $globalConnection = $connection;
    echo "\ninside connect \n\n";

    // Send data to the server
    $connection->write("Hello Server!");

    // Handle server response
    $connection->on('data', function ($data) {
        echo "\nReceived from SERVER : $data\n";
    });
}, function (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
});

Loop::addPeriodicTimer(5, function () use (&$globalConnection, &$timer) {
    $timer++;
    // $globalConnection->write($timer);
    if ($globalConnection) {
        $globalConnection->write("Timer count: $timer");
    }
});

// Non-blocking input reading on Windows
Loop::addPeriodicTimer(0.1, function () use (&$globalConnection) {
    $read = [STDIN]; // Define as a separate variable to avoid the "Only variables should be passed by reference" notice
    $write = [];
    $except = [];
    if (stream_select($read, $write, $except, 0, 100000)) {
        $input = trim(fgets(STDIN));
        if ($input !== '' && $globalConnection) {
            $globalConnection->write("User Input: $input");
            echo "You sent: $input\n";
        }
    }
});

// Start the event loop
Loop::run();



// Using ReactPHP Process to read user input
// $process = new Process('php -r "while (1) { echo fgets(STDIN); }"');
// $process->start(Loop::get());

// $process->stdout->on('data', function ($chunk) use (&$globalConnection) {
//     if ($globalConnection) {
//         $globalConnection->write("User Input: $chunk");
//     }
// });

// $process->stdout->on('end', function () {
//     echo "Input stream ended\n";
// });

/*
$stream = new ReadableResourceStream(STDIN);

$stream->on('data', function ($chunk) use (&$globalConnection) {
    $globalConnection->write($chunk);
});
$stream->on('end', function () {
    echo 'END';
});
*/