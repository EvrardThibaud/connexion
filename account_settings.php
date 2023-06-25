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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/account_setting.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Account Settings</title>
</head>
<body>

    <!-- <a id="back" href="account/<?php echo $user['username']."/".$user['username'].".php?account=".$user['username']; ?>">
        <p>retour</p>
    </a> -->

    <form id="accountsetting" action="php/update_account_information.php" method="post">
        <legend>Modifier vos informations</legend>
        <input id="accountsettingName" name="name" type="text" autocomplete="off" placeholder="Nouveau nom" value="<?php echo $user['name']; ?>" >
        <input id="accountsettingFirstname" name="firstname" type="text" autocomplete="off" placeholder="Nouveau prenom" value="<?php echo $user['firstname']; ?>" >
        <input id="accountsettingBirthdate" name="birthdate" type="date" autocomplete="off" placeholder="Nouvelle date de naissance" value="<?php echo $user['birthdate']; ?>" >
        <input id="accountsettingEmail" name="email" type="email" autocomplete="off" placeholder="Nouveau email" value="<?php echo $user['email']; ?>" >
        <input id="accountsettingUsername" name="username" type="text" autocomplete="off" placeholder="Nouveau nom d'utilisateur" value="<?php echo $user['username']; ?>" >
        <input id="accountsettingOldPassword" name="old_password" type="password" autocomplete="off" placeholder="Ancien mot de passe" required title="Veuillez saisir mot de passe">
        <input id="accountsettingNewPassword" name="new_password" type="password" autocomplete="off" placeholder="Nouveau mot de passe"  >
        <input id="accountsettingSubmit" name="submit" type="submit" value="Modifier les infos">
        <button class="passwordVisibitlity" type="button" onclick="changePasswordVisibilityAccountsettingOldPassword()">
            <i id="eyeIcon" class="fa-solid fa-eye " style="color: #ffffff;"></i>
        </button>    
        <button class="passwordVisibitlity" type="button" onclick="changePasswordVisibilityAccountsettingNewPassword()">
            <i id="eyeIcon2" class="fa-solid fa-eye " style="color: #ffffff;"></i>
        </button>    
    </form>
    
    
    <a href="account/<?php echo $user['username']."/".$user['username'].".php?account=".$user['username']; ?>">
        <button id="cancelModif">Annuler</button>
    </a>
    
    <?php
    if(isset($_SESSION['error_message'])){
        echo "<p id='errorMessage'>".$_SESSION['error_message']."</p>";
        unset($_SESSION['error_message']);
    }
    ?>



    <script src="js/password_visibility.js"></script>

</body>
</html>