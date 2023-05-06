<?php

    session_start();

    include('../conn_data_base.php');

    $contact_result = pg_query($conn, "SELECT * FROM account WHERE username = '" . $_GET['contact'] . "'");
    $contact = pg_fetch_assoc($contact_result);

    $message = isset($_POST["content"]) ? pg_escape_string($_POST["content"]) : '';

    date_default_timezone_set('Europe/Paris');
    $currentDateTime = date('Y-m-d H:i:s');

    pg_query($conn, "INSERT INTO message (sender_id, recipient_id, date_time, content)
    VALUES ({$_SESSION['user_id']}, {$contact['id']}, '$currentDateTime', '$message');");

    header("Location: {$_SERVER['HTTP_REFERER']}");
?>