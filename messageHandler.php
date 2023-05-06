<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PgSql;

class MessageHandler implements MessageComponentInterface {
    protected $connections;
    protected $conn;

    public function __construct($conn) {
        $this->connections = new \SplObjectStorage;
        $this->conn = $conn;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->connections->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $contact = pg_escape_string($_GET['contact']);
        $result = pg_query($this->conn, "SELECT * FROM message WHERE recipient_id = {$_SESSION['user_id']} AND sender_id = {$contact['id']} ORDER BY date_time ASC");
        $messages = [];
        while ($row = pg_fetch_assoc($result)) {
            $messages[] = [
                'sender_id' => $row['sender_id'],
                'recipient_id' => $row['recipient_id'],
                'content' => $row['content'],
                'date_time' => $row['date_time']
            ];
        }
        $data = [
            'type' => 'new_message',
            'messages' => $messages
        ];
        foreach ($this->connections as $connection) {
            $connection->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}
