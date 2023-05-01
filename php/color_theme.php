<?php
    session_start();

    $color = isset($_POST["color"]) ? pg_escape_string($_POST["color"]) : '';

    $_SESSION['color'] = $color;

    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
    $username = pg_fetch_result(pg_query($conn, "SELECT username FROM account WHERE id = '{$_SESSION['user_id']}'"),0,0);

    header("Location: ../account/$username.php");
?>