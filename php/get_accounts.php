<?php
$conn = pg_connect('host=localhost dbname=connexion user=postgres password=T1b0$postgres');

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $result = pg_query($conn, "SELECT username FROM account WHERE username iLIKE '$query%'");

    if (pg_num_rows($result) > 0) {
        echo "<ul>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<li>" . "<p>" . $row["username"] . "</p>" . "</li>";
        }

        echo "</ul>";
    } 

    pg_close($conn);

}
?>