<?php

// php socket_server.php

require __DIR__ . '/vendor/autoload.php';

$timer = 0;
$socket = new React\Socket\SocketServer('127.0.0.1:8082');

echo "Server running : tcp://127.0.0.1:8082";

$socket->on('connection', function ($connection) {
    echo "\n\nconnection established\n";
    echo "Remote address is : \n", $connection->getRemoteAddress();

    $connection->on('data', function ($data) use ($connection) {
        echo "\n\n--------------------------------------------------";
        echo "\nReceived from CLIENT : $data\n";

        $connection->write("You said: $data");
    });

    // Handle connection close
    $connection->on('close', function () {
        echo "Connection closed\n";
    });
});

$socket->on('error', function (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
});
