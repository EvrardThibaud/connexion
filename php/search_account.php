<?php
    
    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');

    $username = isset($_POST["username"]) ? pg_escape_string($_POST["username"]) : '';

    header("Location: ../account/$username/$username.php?account=$username");

?>