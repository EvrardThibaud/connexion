<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu_direct_message.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Mes messages</title>
</head>
<body>

    <div id="title">
        <h1>Messagerie</h1>
    </div>

    <div id="contact">
    <?php 

        session_start();

        include('conn_data_base.php');
        $result = pg_query($conn, "SELECT DISTINCT ON (a.id) a.* FROM account a JOIN message m ON m.sender_id = a.id OR m.recipient_id = a.id WHERE a.id != '" . $_SESSION['user_id'] . "' AND (m.sender_id = '" . $_SESSION['user_id'] . "' OR m.recipient_id = '" . $_SESSION['user_id'] . "') ORDER BY a.id, m.date_time DESC;");

        while ($user = pg_fetch_assoc($result)) {
            $profilePicturePath = 'account/'.$user['username'].'/image/'.$user['username'].'_profile_picture.png';
            if (file_exists($profilePicturePath)) {
                $timestamp = time(); 
                echo '<img class="profile-picture" src="' . $profilePicturePath . '?t=' . $timestamp . '" alt="" ">';
            } else {
                echo '<img class="profile-picture" src="image/profile-picture.png" alt="" ">';
            }

            echo "username: <a href='direct_message.php?contact=" . $user["username"] . "'><button>" . $user['username'] . "</button></a><br>";
        }
    ?>
    </div>

</body>
</html>

