<?PHP
        header('Location: picture.php');
    include "functions/functions_db.php";

    if (!isset($_SESSION))
        session_start();
    $type = 0;
    if ($_FILES['upload']['type'] === "image/png")
        $type = ".png";
    else if ($_FILES['upload']['type'] === "image/jpg")
        $type = ".jpg";
    else if ($_FILES['upload']['type'] === "image/jpeg")
        $type = ".jpeg";
    if ($type !== 0 && !empty($_FILES['upload']) && ($_POST['filter'] === "masque" || $_POST['filter'] === "joint" || $_POST['filter'] === "moustache"))
    { 
        if ($_FILES['upload']['size'] < 4000000 && $_FILES['upload']['error'] === 0 && !empty($_SESSION['logged_on_user']))
        {
            $key = hash('whirlpool', rand());
            if (!move_uploaded_file($_FILES['upload']['tmp_name'], "ressources/pictures/" . $key . $type))
                return ;
            $data = file_get_contents("ressources/pictures/" . $key . $type);

            $source = imagecreatefrompng("ressources/filter/" . $_POST['filter'] . ".png"); // Le logo est la source
            $destination = imagecreatefromstring($data); // La photo est la destination
            
            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
            $largeur_source = imagesx($source);
            $hauteur_source = imagesy($source);
            $largeur_destination = imagesx($destination);
            $hauteur_destination = imagesy($destination);

            
            // On met le logo (source) dans l'image de destination (la photo)
            if ($_POST['filter'] === "joint")
            {
                $largeur_source = imagesx($destination) * 0.5;
                $hauteur_source = imagesx($destination) * 0.4;
                $filt_x = $largeur_destination / 2 - $largeur_source / 2;
                $filt_y = $hauteur_destination / 2 - $hauteur_source / 2;
                $scale_x = imagesx($destination) * 0.5;
                $scale_y = imagesy($destination) * 0.4;
            }
            else if ($_POST['filter'] === "masque")
            {
                $largeur_source = imagesx($destination) * 0.60;
                $hauteur_source = imagesx($destination) * 0.77;
                $filt_x = $largeur_destination / 2 - $largeur_source / 2;
                $filt_y = $hauteur_destination / 2 - $hauteur_source / 2;
                $scale_x = imagesx($destination) * 0.60;
                $scale_y = imagesy($destination) * 0.77;
            }
            else if ($_POST['filter'] === "moustache")
            {
                $filt_x = 0;
                $filt_y = 0;
                $scale_x = imagesx($destination);
                $scale_y = imagesy($destination);
            }


            imagecopyresampled($destination, $source, $filt_x, $filt_y, 0, 0, $scale_x, $scale_y, imagesx($source), imagesy($source));
            
            // On affiche l'image de destination qui a été fusionnée avec le logo

            $t = time() + 3600;

            $prep = $dbsql->prepare('INSERT INTO post VALUES (NULL, :author_id, :c_time, :type);');
            $prep -> bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep -> bindParam(':c_time', $t);
            $prep -> bindParam(':type', $type);
            $prep->execute();

            $prep2 = $dbsql->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 1;');
            $prep2->execute();
            $post = $prep2->fetchAll();
            
            unlink("ressources/pictures/" . $key . $type);
            imagejpeg($destination, "ressources/pictures/" . $post[0]['id'] . $type);
        }
    }
?>