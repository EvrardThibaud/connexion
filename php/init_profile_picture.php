<?php
session_start();

$conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
$result = pg_query($conn, "SELECT username FROM account WHERE id = '".$_SESSION['user_id']."'");
$username = pg_fetch_result($result, 0);



if(isset($_FILES['file']) && $_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 0) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    if(strpos($file_type, 'image') === 0) {
        $directory = "../account/$username/image/";
        echo "directory" . $directory;

        $destination = $directory . $username . "_profile_picture.png";
        move_uploaded_file($file_tmp, $destination);

        // Redirection vers la page précédente
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Le fichier sélectionné n'est pas une image.";
    }
}
?>
