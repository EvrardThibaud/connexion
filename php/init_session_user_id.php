<?php
    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
    $_SESSION['user_id'] = pg_fetch_result(pg_query($conn, "SELECT id FROM account WHERE email = '{$_SESSION['email']}'"),0,0);
?>