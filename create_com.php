<?PHP
        include "functions/functions_db.php";
        session_start();
        echo "<div style='width:1000px;height:1000px'>" . $_SESSION['logged_on_user'] . $_GET['id'] . $_POST['txt'] . "</div>";
        if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] == '')
        {
            $prep = $dbsql->prepare('INSERT INTO comment VALUES (:picture_id, :uid, :txt)');
            $prep -> bindParam(':picture_id', $_GET['id']);
            $prep -> bindParam(':uid', $_SESSION['logged_on_user']);
            $prep -> bindParam(':txt', $_POST['txt']);
            $prep->execute();
        }

?>