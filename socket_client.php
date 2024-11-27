<?php

require __DIR__ . '/vendor/autoload.php';

use React\EventLoop\Loop;
use React\Stream\ReadableResourceStream;

$connector = new React\Socket\Connector();
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

Loop::addPeriodicTimer(0.1, function () use (&$globalConnection, &$timer) {
    $timer++;
    $globalConnection->write($timer);
});


$stream = new ReadableResourceStream(STDIN);

$stream->on('data', function ($chunk) use (&$globalConnection) {
    $globalConnection->write($chunk);
});
$stream->on('end', function () {
    echo 'END';
});
