<?php
    session_start();

    $username = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4);
    $conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');
    $result = pg_query($conn, "SELECT * FROM account WHERE username = '$username'");
    $user = pg_fetch_assoc($result);

    if($_SESSION['user_id']==$user['id']){
        $isConnect = True;  
    }
    else{
        $isConnect = False;
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        <title><?php echo $username . " | connexion" ?></title>
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
                // Bienvenue / page privé / se déconnecter 
                echo "<h1>Bienvenue, " . $user['name'] . "</h1>";
                echo "<p>Voici votre page de profil. Cette page est privée et n'est accessible que par vous.</p>";
                echo "<p><a href='../../index.php'>se déconnecter</a></p>";
            }
            else{
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

        <script src="../../js/search_autocompletion.js" ></script>
        <script src="../../js/drop_image.js" ></script>
        

    </body>
</html>
