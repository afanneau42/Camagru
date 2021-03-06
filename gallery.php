<?PHP
    session_start();
    if (!isset($_GET['page']))
        $_GET['page'] = 1;
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=58">
        <link rel="stylesheet" type="text/css" href="connection.css?version=51">
        <link rel="stylesheet" type="text/css" href="gallery.css?version=62">
        <meta charset="utf-8">
        <script type="text/javascript" src="functions/gallery_infinite_scroll.js?version=70"></script>
        <title>Camagru</title>
    </head>
    <body>
        <div id="top">
            <div id="text-logo-div">
                <a href="index.php" id="text-logo">Camagru</a>
            </div>
            <div class="flex-center">
                <?PHP
                        if (!$_SESSION['logged_on_user'] == ''){
                            echo '
                                <div id="div-core">
                                    <a href="picture.php"><div class="div-core-txt">Take a picture !</div></a>
                                </div>
                                ';
                        }
                ?>
                <div id="div-core">
                                <a href="gallery.php"><div class="div-core-txt">Gallery</div></a>
                </div> 
            </div>
            <?PHP
            if ($_SESSION['logged_on_user'] == ''){
                echo '
                    <div id="div-connexion">
                        <a href="connection.php"><div id="connexion">Sign in</div></a>
                        <a href="inscription.php"><div id="inscription">Sign up</div></a>
                    </div>';
            }
            else {
                echo '
                <div id="div-connexion">
                    <a href="logout.php"><div id="connexion">Logout</div></a>
                    <a href="profile.php"><div id="connexion">Profile</div></a>
                </div>';
            }
        ?>
        </div>
        <div id="mid">
            <div id="mid-center">
                <div class="card_container">
                    <?PHP
                    include "functions/f_display.php";

                    display_post_gallery();
                    ?>
            </div>
        </div>
        <div id="foot">
            <div id="text-foot-div">
                <p id="txt">By afanneau 2017</p>
            </div>
        </div>
    </body>
</html>