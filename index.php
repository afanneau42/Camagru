<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']))
        $_SESSION['logged_on_user'] = '';
    include "config/setup.php";
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=60">
        <meta charset="utf-8">
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
                            <div id="div-core">
                                <a href="gallery.php"><div class="div-core-txt">Gallery</div></a>
                            </div>
                            ';
                    }
                ?> 
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
            </div>
        </div>
        <div id="foot">
            <div id="text-foot-div">
                <p id="txt">By afanneau 2017</p>
            </div>
        </div>
    </body>
</html>
