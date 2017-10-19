<?PHP
        include "functions/functions_db.php";
        session_start();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] != '' && $_POST['text'] != '' && strlen($_POST['text']) < 250)
        {

            $_POST['text'] = htmlspecialchars($_POST['text']);

            /* Insert new comment into db */

            $prep = $dbsql->prepare('INSERT INTO comment VALUES (:picture_id, :uid, :txt)');
            $prep -> bindParam(':picture_id', $_GET['id']);
            $prep -> bindParam(':uid', $_SESSION['logged_on_user']);
            $prep -> bindParam(':txt', $_POST['text']);
            $prep->execute();

            /* Request datas about the post */

            $prep2 = $dbsql->prepare('SELECT * FROM post WHERE id=:picture_id');
            $prep2 -> bindParam(':picture_id', $_GET['id']);
            $prep2->execute();
            $r = $prep2->fetchAll();


            /* Request datas about the author of the post */

            $author_id = $r[0]['author_id'];
            $prep3 = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
            $prep3 -> bindParam(':id', $author_id);
            $prep3->execute();
            $r2 = $prep3->fetchAll();

            /* Send a mail to the author of the post */

            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", htmlspecialchars($r2[0]['mail']))) // On filtre les serveurs qui bugs
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }

            $to = htmlspecialchars($r2[0]['mail']);
            $subject = "New comment on your post";
            $txt = "Hi " . $r2[0]['username'] . ", someone posted a comment on your post : " . $passage_ligne . $passage_ligne . $_SERVER['HTTP_REFERER'] . $activ_code . $passage_ligne . $passage_ligne . "See you soon" . $passage_ligne . "Camagru's staff" . $passage_ligne;
            $headers = "From: support@camagru.com";

            mail($to,$subject,$txt,$headers);
        }

?>