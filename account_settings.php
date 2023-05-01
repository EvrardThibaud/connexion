<?php
    session_start();
    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
    $result = pg_query($conn, "SELECT * FROM account WHERE id = '{$_SESSION['user_id']}'");
    $user = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
</head>
<body>
    <form id="accountsetting" action="php/update_account_information.php" method="post">
        <input id="accountsettingName" name="name" type="text" autocomplete="off" placeholder="Nouveau nom" value="<?php echo $user['name']; ?>" >
        <input id="accountsettingFirstname" name="firstname" type="text" autocomplete="off" placeholder="Nouveau prenom" value="<?php echo $user['firstname']; ?>" >
        <input id="accountsettingBirthdate" name="birthdate" type="date" autocomplete="off" placeholder="Nouvelle date de naissance" value="<?php echo $user['birthdate']; ?>" >
        <input id="accountsettingEmail" name="email" type="email" autocomplete="off" placeholder="Nouveau email" value="<?php echo $user['email']; ?>" >
        <input id="accountsettingUsername" name="username" type="text" autocomplete="off" placeholder="Nouveau nom d'utilisateur" value="<?php echo $user['username']; ?>" >
        <input id="accountsettingOldPassword" name="old_password" type="password" autocomplete="off" placeholder="Ancien mot de passe" required title="Veuillez saisir mot de passe">
        <button class="passwordVisibitlity" type="button" onclick="changePasswordVisibilityAccountsettingOldPassword()">O</button>    
        <input id="accountsettingNewPassword" name="new_password" type="password" autocomplete="off" placeholder="Nouveau mot de passe"  >
        <button class="passwordVisibitlity" type="button" onclick="changePasswordVisibilityAccountsettingNewPassword()">O</button>    
        <input id="accountsettingSubmit" name="submit" type="submit" value="Modifier les infos">
    </form>

    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p style='color:red'>".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>

    <a href="account/<?php echo $user['username']."/".$user['username']; ?>.php">retour</a>


    <script src="js/password_visibility.js"></script>

</body>
</html>