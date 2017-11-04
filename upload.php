<?PHP
    if (!isset($_SESSION))
        session_start();
    if (!empty($_POST['data']))
    {    


        include "functions/functions_db.php";
        $type = 0;

        if ($_POST['data']['upload']['type'] === "image/png")
            $type = ".png";
        else if ($_POST['data']['upload']['type'] === "image/jpg")
            $type = ".jpg";
        else if ($_POST['data']['upload']['type'] === "image/jpeg")
            $type = ".jpeg";
        if ($type !== 0)
        {
            if ($_POST['data']['upload']['size'] < 4000000 && $_POST['data']['upload']['error'] === 0 && !empty($_SESSION['logged_on_user']))
            {
                $t = time();

                $prep = $dbsql->prepare('INSERT INTO post VALUES (NULL, :author_id, :c_time, :type);');
                $prep -> bindParam(':author_id', $_SESSION['logged_on_user']);
                $prep -> bindParam(':c_time', $t);
                $prep -> bindParam(':type', $type);
                $prep->execute();

                $prep2 = $dbsql->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 1;');
                $prep2->execute();
                $post = $prep2->fetchAll();
                
                if (move_uploaded_file($_POST['data']['upload']['tmp_name'], "ressources/pictures/" . $post[0]['id'] . $type))
                {
                    if (!empty($_SERVER['HTTP_REFERER']))
                        echo "nice";
                }
            }

        }
    }
?>