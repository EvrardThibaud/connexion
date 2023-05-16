<?php
    session_start();

    $username = $_GET['account'];
    include('../../conn_data_base.php');
    $result = pg_query($conn, "SELECT * FROM account WHERE username = '$username'");
    $user = pg_fetch_assoc($result);

    if($_SESSION['user_id']==$user['id']){
        $isConnect = True;  
    }
    else{
        $isConnect = False;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <title><?php echo $username . " | connexion" ?></title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/account.css">
    </head>

    
    <?php
        $profilePicturePath = 'image/'.$user['username'].'_profile_picture.png';
        if (file_exists($profilePicturePath)) {
            $timestamp = time(); 
            echo '<a href=""><img src="' . $profilePicturePath . '?t=' . $timestamp . '" alt="" style="height: 100px; width: 100px; border-radius: 100px; border: 1px black solid;"></a>';
        } else {
            echo '<a href=""><img src="../../image/profile-picture.png" alt="" style="height: 100px; width: 100px; border-radius: 100px; border: 1px black solid;"></a>';
        }
    ?>
        
        
        <h1><?php echo $user['username'] ?></h1>
        
        <?php
            if($isConnect){
                // profile picture
                echo "<form id='profilePicture' action='../../php/init_profile_picture.php' method='post' enctype='multipart/form-data'>";
                // form to change profile picture
                echo "<div id='drop-area'>";
                echo "<input id='profilePictureFile' name='file' type='file' accept='image/' .'*' autocomplete='off'  required title='Cliquer ou droper' >";
                echo "</div>";
                echo "<input id='profilePictureSubmit' name='submit' type='submit' value='Utiliser'>";
                echo "</form>";
                // button to update account information
                echo "<a href='../../account_settings'><button >modifier</button></a>";
                // form to search an account
                echo "<form id='search' action='../../php/search_account.php' method='post'>";
                echo "    <input id='searchUsername' name='username' type='text' placeholder='Nom d&#39;utilisateur' autocomplete='off'>";
                echo "    <input id='searchSubmit' name='submit' type='submit' value='Rechercher'>";
                echo "</form>";
                echo "<ul id='searchResults'></ul>";
                // Bienvenue / page privé / se déconnecter / messagerie
                echo "<h1>Bienvenue, " . $user['name'] . "</h1>";
                echo "<p>Voici votre page de profil. Cette page est privée et n'est accessible que par vous.</p>";
                echo "<p><a href='../../index.php'>se déconnecter</a></p>";
                echo "<a href='../../menu_direct_message.php'><button>Messagerie</button></a>";
            }
            else{
                
                echo "<a href='../../direct_message.php?contact={$user['username']}'><button>envoyer un message</button></a>";
                echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'><button>revenir</button></a>";
                echo "<p>La page public de " . $user['name'] . ".</p>";
            }
            ?>



        <ul >
            <li><strong>Nom :</strong> <?php echo $user['name'] ?></li>
            <li><strong>Prénom :</strong> <?php echo $user['firstname'] ?></li>
            <li><strong>Date de naissance :</strong> <?php echo $user['birthdate'] ?></li>
            <li><strong>Email :</strong> <?php echo $user['email'] ?></li>
        </ul>

        
        <script src='../../js/search_autocompletion.js' ></script>
        

    </body>
</html>
