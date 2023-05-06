<?php

    session_start();

    include('conn_data_base.php');

    $contact_result = pg_query($conn, "SELECT * FROM account WHERE username = '" . $_GET['contact'] . "'");
    $contact = pg_fetch_assoc($contact_result);
    
    $result = pg_query($conn, "select * from message m
    join account a on m.sender_id = a.id OR m.recipient_id = a.id 
    where (m.sender_id = {$contact['id']} or m.recipient_id = {$contact['id']}) and a.id = {$_SESSION['user_id']}
    order by date_time ASC");

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>

    <div>
        <?php
            while ($row = pg_fetch_assoc($result)) {
                if ($row['sender_id'] == $_SESSION['user_id']) {
                    echo "<p class='sent'>" . $row['content'] . "</p>";
                } else {
                    echo "<p class='received'>" . $row['content'] . "</p>";
                }
            }
        ?>
    </div>

    <form id="message" action="php/send_a_message.php?contact=<?php echo $_GET['contact']; ?>" method="post">
        <input id="messageContent" name="content" type="text" autocomplete='off' placeholder="Votre message">
        <input id="messageSubmit" name="submit" type="submit" value="Envoyer">
    </form>
    
</body>
</html>