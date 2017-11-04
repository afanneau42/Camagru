<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] != '')
        header('Location: index.php');
    if (!isset($_SESSION['error']))
        $_SESSION['error'] = 0;
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="connection.css?version=54">
        <link rel="stylesheet" type="text/css" href="index.css?version=53">
        <meta charset="utf-8">
        <title>Camagru : Connexion</title>
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
            <div id="div-connexion">
                <a href="connection.php"><div id="connexion">Sign in</div></a>
                <a href="inscription.php"><div id="inscription">Sign up</div></a>
            </div>
        </div>
        <div id="mid">
            <div id="mid-center">
                <div class="card" style="text-align:center;font-size:30px;padding-top:5%;font-family:Solar_Bold;">
                    <p>You must be logged !</p>
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