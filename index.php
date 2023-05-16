<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>connexion </title>

</head>
<body>

    <form id="login" action="php/login_to_account.php" method="post">
        <legend>Connexion à votre compte</legend>
        <input id="loginEmail" name="email" type="email" autocomplete='off' placeholder="Adresse mail" required title="Veuillez saisir votre email">
        <input id="loginPassword" name="password" type="password" autocomplete='off' placeholder="Mot de passe" required title="Veuillez saisir votre mot de passe">
        <input id="loginSubmit" name="submit" type="submit" value="Se connecter">
        <button id="passwordVisibitlity" type="button" onclick="changePasswordVisibilityLogin()" >
            <i id="eyeIcon" class="fa-solid fa-eye " style="color: #ffffff;"></i>
        </button>    
    </form>
    

    <div id="divCreateAccount">
        <p>Pas de compte ?</p><a id="linkCreateAccout" href="signup.php">Créez en un maintenant</a>
    </div>

    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p id='errorMessage' style='color:red'>".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>

    <script src="js/password_visibility.js"></script>
</body>
</html>