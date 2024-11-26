<?php

require __DIR__ . '/vendor/autoload.php';

use React\Socket\Server;
use React\Socket\ConnectionInterface;

// Create a new socket server listening on 127.0.0.1:8080
$server = new Server('127.0.0.1:8080');

echo "Socket server running on tcp://127.0.0.1:8080\n";

// Maintain a list of connected clients
$clients = [];

// Function to broadcast data to all clients except the sender
$broadcast = function (ConnectionInterface $sender, string $data) use (&$clients) {
    foreach ($clients as $client) {
        if ($client !== $sender) {
            $client->write($data);
        }
    }
};

// Handle new connections
$server->on('connection', function (ConnectionInterface $connection) use (&$clients, $broadcast) {
    // Add the new connection to the clients list
    $clients[] = $connection;
    $remoteAddress = $connection->getRemoteAddress();
    echo "New connection from {$remoteAddress}\n";

    // Handle incoming data
    $connection->on('data', function (string $data) use ($connection, $broadcast) {
        echo "Received data: {$data} from {$connection->getRemoteAddress()}\n";
        $broadcast($connection, $data);
    });

    // Handle connection closure
    $connection->on('close', function () use (&$clients, $connection, $remoteAddress) {
        // Remove the connection from the clients list
        $clients = array_filter($clients, fn($client) => $client !== $connection);
        echo "Connection closed: {$remoteAddress}\n";
    });
});

