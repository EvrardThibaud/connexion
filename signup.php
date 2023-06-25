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
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Document</title>
</head>
<body autocomplete="off">

    

    <form id="signup" action="php/create_account.php" method="post">
        <legend>Création de votre compte</legend>
        <input id="signupeName" name="name" type="text" autocomplete="off" placeholder="Nom" required title="Veuillez saisir votre nom">
        <input id="signupFirstname" name="firstname" type="text" autocomplete="off" placeholder="Prenom" required title="Veuillez saisir votre prenom">
        <input id="signupBirthdate" name="birthdate" type="date" autocomplete="off" placeholder="Date de naissance" required title="Veuillez saisir votre date de naissance">
        <input id="signupEmail" name="email" type="email" autocomplete="off" placeholder="Adresse mail" required title="Veuillez saisir votre email">
        <input id="signupUsername" name="username" type="text" autocomplete="off" placeholder="Nom d'utilisateur" required title="Veuillez choisir un nom d'utilisateur">
        <input id="signupPassword" name="password" type="password" autocomplete="off" placeholder="Mot de passe" required title="Veuillez choisir un mot de passe">
        <input id="signupSubmit" name="submit" type="submit" value="Créer le compte">
        <button id="passwordVisibitlity" type="button" onclick="changePasswordVisibilitySignup()">
            <i id="eyeIcon" class="fa-solid fa-eye " style="color: #ffffff;"></i>
        </button>    
    </form>


    <div id="divLoginToAccount">
        <p>Déjà un compte ?</p><a id="linkLoginToAccount" href="index.php">Connectez vous maintenant</a>
    </div>
    
    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p id='errorMessage' >".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>

    <script src="js/password_visibility.js"></script>
</body>
</html>