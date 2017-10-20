<?PHP
    session_start();

    include "functions/functions_db.php";
    $type = 0;
    
    if ($_FILES['upload']['type'] === "image/png")
        $type = ".png";
    else if ($_FILES['upload']['type'] === "image/jpg")
        $type = ".jpg";
    else if ($_FILES['upload']['type'] === "image/jpeg")
        $type = ".jpeg";
    if ($type !== 0)
    {
        if ($_FILES['upload']['size'] < 4000000 && $_FILES['upload']['error'] === 0 && !empty($_SESSION['logged_on_user']))
        {
            $prep = $dbsql->prepare('INSERT INTO post VALUES (NULL, :author_id, :c_time, :type);');
            $prep -> bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep -> bindParam(':c_time', time());
            $prep -> bindParam(':type', $type);
            $prep->execute();

            $prep2 = $dbsql->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 1;');
            $prep2->execute();
            $post = $prep2->fetchAll();
            
            if (move_uploaded_file($_FILES['upload']['tmp_name'], "ressources/pictures/" . $post[0]['id'] . $type))
            {
                if (!empty($_SERVER['HTTP_REFERER']))
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                else
                    header("Location: index.php");
            }
        }
        else
            header("Location: index.php");
    }
    else
        header("Location: index.php");
?>