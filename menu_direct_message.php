<?php 

    session_start();

    include('conn_data_base.php');
    $result = pg_query($conn, "SELECT DISTINCT ON (a.id) a.* FROM account a JOIN message m ON m.sender_id = a.id OR m.recipient_id = a.id WHERE a.id != '" . $_SESSION['user_id'] . "' AND (m.sender_id = '" . $_SESSION['user_id'] . "' OR m.recipient_id = '" . $_SESSION['user_id'] . "') ORDER BY a.id, m.date_time DESC;");

    while ($user = pg_fetch_assoc($result)) {
        echo "username: <a href='direct_message.php?contact=" . $user["username"] . "'><button>" . $user['username'] . "</button></a><br>";
    }


?>
