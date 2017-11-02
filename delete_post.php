<?PHP
    if (!isset($_SESSION))
        session_start();

    include "../functions/functions_db.php";

    if (!empty($_SESSION['logged_on_user']) && $_POST['id'] > 0)
    {
        $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM post WHERE author_id=:author_id AND id=:id');
        $prep4->bindParam(':author_id', $_SESSION['logged_on_user']);
        $prep4->bindParam(':id', htmlspecialchars($_POST['id']));
        $prep4->execute();
        $r = $prep4->fetchAll();

        if ($r[0]['COUNT(*)'] > 0)
        {
            $prep = $dbsql->prepare('DELETE FROM post WHERE author_id=:author_id AND id=:id');
            $prep->bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep->bindParam(':id', htmlspecialchars($_POST['id']));
            $prep->execute();

            $prep2 = $dbsql->prepare('DELETE FROM likes WHERE picture_id=:id');
            $prep2->bindParam(':id', htmlspecialchars($_POST['id']));
            $prep2->execute();

            $prep3 = $dbsql->prepare('DELETE FROM comment WHERE picture_id=:id');
            $prep3->bindParam(':id', htmlspecialchars($_POST['id']));
            $prep3->execute();
        }
    }
?>