<?PHP
    if (!isset($_SESSION))
        session_start();

    include "../functions/functions_db.php";

    $data = $_POST['data'];

    $data = substr($data, 22);
    $data = str_replace(' ', '+', $data);
    
    $data = base64_decode($data);

    $key = hash("whirlpool", rand());
    
    // file_put_contents("../ressources/" . $key . ".png", $data);

    $source = imagecreatefrompng("../ressources/filter/" . $_POST['filter'] . ".png"); // Le logo est la source
    $destination = imagecreatefromstring($data); // La photo est la destination
     
    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);
     
    // On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
    $destination_x = $largeur_destination - $largeur_source;
    $destination_y =  $hauteur_destination - $hauteur_source;

    // On flip l'image

    imageflip($destination, IMG_FLIP_HORIZONTAL);
     
    // On met le logo (source) dans l'image de destination (la photo)
    if ($_POST['filter'] === "joint")
    {
        $filt_x = 135;
        $filt_y = 65;
        $scale_x = imagesx($destination) * 0.4;
        $scale_y = imagesy($destination) * 0.4;      
    }
    else if ($_POST['filter'] === "masque")
    {
        $filt_x = 60;
        $filt_y = -57;
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

    $t = time();
    $type = ".jpeg";

    $prep = $dbsql->prepare('INSERT INTO post VALUES (NULL, :author_id, :c_time, :type);');
    $prep -> bindParam(':author_id', $_SESSION['logged_on_user']);
    $prep -> bindParam(':c_time', $t);
    $prep -> bindParam(':type', $type);
    $prep->execute();

    $prep2 = $dbsql->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 1;');
    $prep2->execute();
    $post = $prep2->fetchAll();
    
    imagejpeg($destination, "../ressources/pictures/" . $post[0]['id'] . $type);

    echo "display_new(" . $post[0]['id'] . ", \"" . $type . "\", " . $_SESSION['logged_on_user'] . ");  ";
?>