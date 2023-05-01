<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body autocomplete="off">

    <p><a href="index.php">menu</a></p>

    <form id="signup" action="php/create_account.php" method="post">
        <input id="signupeName" name="name" type="text" autocomplete="off" placeholder="Nom" required title="Veuillez saisir votre nom">
        <input id="signupFirstname" name="firstname" type="text" autocomplete="off" placeholder="Prenom" required title="Veuillez saisir votre prenom">
        <input id="signupBirthdate" name="birthdate" type="date" autocomplete="off" placeholder="Date de naissance" required title="Veuillez saisir votre date de naissance">
        <input id="signupEmail" name="email" type="email" autocomplete="off" placeholder="email" required title="Veuillez saisir votre email">
        <input id="signupUsername" name="username" type="text" autocomplete="off" placeholder="Nom d'utilisateur" required title="Veuillez choisir un nom d'utilisateur">
        <input id="signupPassword" name="password" type="password" autocomplete="off" placeholder="Mot de passe" required title="Veuillez choisir un mot de passe">
        <button id="passwordVisibitlity" type="button" onclick="changePasswordVisibilitySignup()">O</button>    
        <input id="signupSubmit" name="submit" type="submit" value="Créer le compte">
    </form>
    
    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p style='color:red'>".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>

    <script src="js/password_visibility.js"></script>
</body>
</html>