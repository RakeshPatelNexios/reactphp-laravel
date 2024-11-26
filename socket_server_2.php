<?php

// php socket_server.php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) {
    return React\Http\Message\Response::plaintext(
        "Hello World!\n"
    );
});

$loop = Loop::get();
$socket = new React\Socket\SocketServer('127.0.0.1:8082', [], $loop);

$http->listen($socket);
echo "Server running : http://127.0.0.1:8082";

$socket->on('connection', function ($connection) {
    echo "\n\nconnection established\n";
    echo "Remote address is : \n", $connection->getRemoteAddress();

    $connection->on('data', function ($data) use ($connection) {
        echo "\n\nReceived: $data";
        $connection->write("You said: $data");
    });

    // Handle connection close
    $connection->on('close', function () {
        echo "Connection closed\n";
    });
});

$loop->run();