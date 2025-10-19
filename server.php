<?php

require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocketHandler;

$ipAddress = '0.0.0.0';  
$port = 8080;

// Create the WebSocket handler
$handler = new WebSocketHandler();

// Create the server with LAN IP binding
$server = IoServer::factory(
    new HttpServer(
        new WsServer($handler)
    ),
    $port,
    $ipAddress
);

echo "WebSocket server starting on ws://$ipAddress:$port...\n";
echo "You can test it with a WebSocket client or the included HTML test page.\n";
echo "Press Ctrl+C to stop the server.\n";

// Run the server
$server->run();
