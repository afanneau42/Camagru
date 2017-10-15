<?PHP
    session_start();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    include "functions/functions_db.php";

    if (isset($_SESSION['logged_on_user']))
    {
        $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id AND author_id=:author_id');
        $prep4 -> bindParam(':picture_id', htmlspecialchars($_GET['id']));
        $prep4 -> bindParam(':author_id', $_SESSION['logged_on_user']);
        $prep4->execute();
        $like_user = $prep4->fetchAll();

        if ($like_user[0]['COUNT(*)'] == 0)
        {
            $prep2 = $dbsql->prepare('INSERT INTO `likes` (`picture_id`, `author_id`) VALUES (:picture_id, :author_id);');
            $prep2 -> bindParam(':picture_id', htmlspecialchars($_GET['id']));
            $prep2 -> bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep2->execute();
        }   
        else
        {
            $prep3 = $dbsql->prepare('DELETE FROM `likes` WHERE picture_id=:picture_id AND author_id=:author_id;');
            $prep3 -> bindParam(':picture_id', htmlspecialchars($_GET['id']));
            $prep3 -> bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep3->execute();
        }
    }
?>