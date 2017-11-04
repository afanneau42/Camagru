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
                <?PHP
                    if ($_SESSION['error'] == 0)
                        echo '<div class="card">';
                    else {
                        echo '<div class="card card-error">';
                    }
                ?>
                    <form action="authentification.php" method="post">
                        <div>
                            Username
                            <br />
                            <input type="text" name="username" value="<?PHP if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username']);}?>">
                        </div>
                        <br />
                        <div>
                            Password
                            <br />
                            <input type="password" name="password">
                        </div>
                        <br />
                        <a id="lost-pw-txt" href="password-lost.php"> Password lost ? </a>
                        <br />
                        <div class="flex-center"></div>
                        <?PHP
                            if ($_SESSION['error'] == 0)
                                echo '<div id="submit-div">
                                    <input id="submit-button" type="submit" value="Submit">';
                            else {
                                echo '<div class="card-error" id="submit-div">
                                    <input class="card-error" id="submit-button" type="submit" value="Submit">';
                            $_SESSION['error'] = 0;
                            }
                        ?>
                        </div>
                    </form>
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
