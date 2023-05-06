<?php

include('conn_data_base.php');

require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\MessageHandler;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MessageHandler($conn)
        )
    ),
    8080
);

$server->run();
