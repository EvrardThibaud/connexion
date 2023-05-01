<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion </title>

</head>
<body>

    <form id="login" action="php/login_to_account.php" method="post">
        <input id="loginEmail" name="email" type="email" autocomplete='off' placeholder="email" required title="Veuillez saisir votre email">
        <input id="loginPassword" name="password" type="password" autocomplete='off' placeholder="Mot de passe" required title="Veuillez saisir votre mot de passe">
        <button id="passwordVisibitlity" type="button" onclick="changePasswordVisibilityLogin()">O</button>    
        <input id="loginSubmit" name="submit" type="submit" value="Se connecter">
    </form>

    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p style='color:red'>".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>

    <p><a href="signup.php">Créer un compte</a></p>

    

    <script src="js/password_visibility.js"></script>
</body>
</html>