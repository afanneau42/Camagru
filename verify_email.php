<?PHP
    session_start();
    if (empty($_GET['code'])) {
        header("Location:index.php");
    }
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=53">
        <link rel="stylesheet" type="text/css" href="connection.css?version=53">
        <meta charset="utf-8">
        <title>Camagru</title>
    </head>
    <body>
        <div id="top">
            <a href="index.php">
                <div id="logo"></div>
            </a>
            <div id="text-logo-div">
                <a href="index.php" id="text-logo">Camagru</a>
            </div>
            <div class="flex-center">

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
                        <a href="connection.php"><div id="connexion">Profile</div></a>
                    </div>';
                }
            ?>
        </div>
        <div id="mid">
            <div id="mid-center">
                <div class="card" style="text-align:center;font-size:30px;padding-top:5%;font-family:Solar_Bold;">
                    <?PHP
                        include "functions/f_user.php";
                        echo verif_mail(htmlspecialchars($_GET['code']));
                    ?>
                </div>
            </div>
        </div>
        <div id="foot">
            <div id="text-foot-div">
                <p id="txt">By afanneau 2017</p>
            </div>
        </div>
    </body>
</html>
