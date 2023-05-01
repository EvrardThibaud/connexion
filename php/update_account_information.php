<?php
session_start();
if(isset($_POST['submit'])){
    
    $name = isset($_POST['name']) ? pg_escape_string($_POST['name']) : '';
    $firstname = isset($_POST['firstname']) ? pg_escape_string($_POST['firstname']) : '';
    $birthdate = isset($_POST['birthdate']) ? pg_escape_string($_POST['birthdate']) : '';
    $email = isset($_POST['email']) ? pg_escape_string($_POST['email']) : '';
    $username = isset($_POST['username']) ? pg_escape_string($_POST['username']) : '';
    $old_password = !empty($_POST["old_password"]) ? pg_escape_string($_POST["old_password"]) : '';
    $new_password = isset($_POST['new_password']) ? pg_escape_string($_POST['new_password']) : '';

    
    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
    $hash_password = pg_fetch_result(pg_query($conn, "SELECT password FROM account WHERE id='{$_SESSION['user_id']}'"),0,0);
    if(!password_verify($old_password, $hash_password)){
        $_SESSION['error_message'] = "Le mot de passe actuel est incorrect.";
        header('Location: ../account_settings.php');
        exit();
    }
    

    if(pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM account WHERE email = '$email' and id!='{$_SESSION['user_id']}'"),0,0) == 1){
        $_SESSION['error_message'] = "Cette adresse email est déjà utilisée.";
        header('Location: ../account_settings.php');
        exit();
    }
    if(pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM account WHERE username = '$username' and id!='{$_SESSION['user_id']}'"),0,0) == 1){
        $_SESSION['error_message'] = "Ce nom d'utilisateur est déjà utilisé.";
        header('Location: ../account_settings.php');
        exit();
    }

   
    $query_update = "UPDATE account SET name='$name', firstname='$firstname', birthdate='$birthdate', email='$email', username='$username'";

    if(!empty($new_password)){
        $hash_new_password = password_hash(isset($_POST["new_password"]), PASSWORD_DEFAULT) ? password_hash(pg_escape_string($_POST["new_password"]),PASSWORD_DEFAULT) : '';
        $query_update .= ", password='$hash_new_password'";
    }
    $query_update .= " WHERE id=".$_SESSION['user_id'];
    $old_username = pg_fetch_result(pg_query($conn, "SELECT username FROM account WHERE id='{$_SESSION['user_id']}'"),0,0);
    $result_update = pg_query($conn, $query_update);
    if($result_update){
        $old_php_path = "../account/" . $old_username ."/" . $old_username . ".php";
        $new_php_path = "../account/" . $old_username ."/" . $username . ".php";
        echo rename($old_php_path, $new_php_path);

        $old_profile_picture_path = "../account/" . $old_username . "/image"."/" . $old_username . "_profile_picture.png";
        $new_profile_picture_path = "../account/" . $old_username . "/image"."/" . $username . "_profile_picture.png";
        echo rename($old_profile_picture_path, $new_profile_picture_path);

        $old_file_path = "../account/" . $old_username;
        $new_file_path = "../account/" . $username;
        echo rename($old_file_path, $new_file_path);

        header('Location: ../account_settings.php');
        exit();
    } else {
        $_SESSION['error_message'] = "Une erreur est survenue, veuillez réessayer.";
        header('Location: ../account_settings.php');
        exit();
    }
}
?>
