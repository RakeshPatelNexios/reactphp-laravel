<?php

require __DIR__ . '/vendor/autoload.php';

use React\EventLoop\Loop;

$loop = Loop::get();
$connector = new React\Socket\Connector($loop);


$connector->connect('127.0.0.1:8082')->then(function (React\Socket\ConnectionInterface $connection) {
    echo "\n\ninside connect \n";

    // Send data to the server
    $connection->write("Hello Server!\n");

    // Handle server response
    $connection->on('data', function ($data) {
        echo "Server replied: $data";
    });
}, function (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
});

$loop->run();