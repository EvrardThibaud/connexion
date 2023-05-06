<?php
    session_start();

    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');

    $email = isset($_POST["email"]) ? pg_escape_string($_POST["email"]) : '';
    $_SESSION['email'] = $email; 
    $password = isset($_POST["password"]) ? pg_escape_string($_POST["password"]) : '';
    $hashedPassword = pg_fetch_result(pg_query($conn, "SELECT password FROM account WHERE email = '$email'"),0,0);


    
    if(pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM account WHERE email = '$email'"),0,0) == 0){
        $_SESSION['error_message'] = "Adresse email inexistante";
        header("Location: ../index.php");
    }
    else if (password_verify($password, $hashedPassword)) {
        include('init_session_user_id.php');
        $username = pg_fetch_result(pg_query($conn, "SELECT username FROM account WHERE email = '$email'"),0,0);
        header("Location: ../account/$username/$username.php?account=$username");
    } 
    else {
        $_SESSION['error_message'] = "Mauvais mot de passe";
        header("Location: ../index.php");    
    }

    pg_close($conn);

?>
