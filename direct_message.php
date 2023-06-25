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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/direct_message.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Messages</title>
</head>
<body>

    <a id="back" href="../connexion/menu_direct_message.php">
        <p>retour</p>
    </a>

    <h1><?php echo $contact['name'].' '.$contact['firstname'];?></h1>
    <div id="messageBox">
        <?php
            while ($row = pg_fetch_assoc($result)) {
                if ($row['sender_id'] == $_SESSION['user_id']) {
                    echo "<div class='sent message'><p >" . $row['content'] . "</p></div>";
                } else {
                    echo "<div class='received message'><p >" . $row['content'] . "</p></div>";
                }
            }
        ?>
    </div>

    <form id="message" action="php/send_a_message.php?contact=<?php echo $_GET['contact']; ?>" method="post">
        <input id="messageContent" name="content" type="text" autocomplete='off' placeholder="Votre message">
        <button id="messageSubmit" name="submit" type="submit">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
    
</body>
</html>