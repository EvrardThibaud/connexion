<?php
    session_start();

    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');

    $name = isset($_POST["name"]) ? pg_escape_string($_POST["name"]) : '';
    $firstname = isset($_POST["firstname"]) ? pg_escape_string($_POST["firstname"]) : '';
    $birthdate = isset($_POST["birthdate"]) ? pg_escape_string($_POST["birthdate"]) : '';
    $email = isset($_POST["email"]) ? pg_escape_string($_POST["email"]) : '';
    $username = isset($_POST["username"]) ? pg_escape_string($_POST["username"]) : '';
    $hashedPassword = password_hash(isset($_POST["password"]), PASSWORD_DEFAULT) ? password_hash(pg_escape_string($_POST["password"]),PASSWORD_DEFAULT) : '';

    
    
    
    if(pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM account WHERE email = '$email'"),0,0) == 1){
        $_SESSION['error_message'] = "Cet email a déjà été utilisé pour créer un compte.";
        header("Location: ../signup.php");
    }
    else if(pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM account WHERE username = '$username'"),0,0) == 1){
        $_SESSION['error_message'] = "Ce nom d'utilisateur a déjà été utilisé pour créer un compte.";
        header("Location: ../signup.php");
    }
    else{
        
        $query = "INSERT INTO account (name, firstname, birthdate, email, password, username) VALUES ('$name', '$firstname', '$birthdate', '$email', '$hashedPassword','$username')";
        $result = pg_query($conn, $query);


        $userDir = "../account/" . $username;
        mkdir($userDir);

        $userImagesDir = $userDir . "/image";
        mkdir($userImagesDir);

        $fileName = "../account/" .$username ."/".$username .".php";
        $fileHandle = fopen($fileName, 'w');
        fwrite($fileHandle, "<?php include('../../php/display_account.php') ?>");
        fclose($fileHandle);

        header("Location: ../account_creation_approve.php");
    }

    

    pg_close($conn);

?>
