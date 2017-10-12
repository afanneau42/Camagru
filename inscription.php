<?PHP
    if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] != '')
        header('Location: index.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="inscription.css?version=52">
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
                <a href="connection.php"><div id="connexion">Connexion</div></a>
                <a href="inscription.php"><div id="inscription">Inscription</div></a>
            </div>
        </div>
        <div id="mid">
            <div id="center2">
                <div class="card">
                    <form>
                        <div>
                            Username
                            <br />
                            <input type="text" name="firstname">
                        </div>
                        <br />
                        <div>
                            Password
                            <br />
                            <input type="password" name="firstname">
                        </div>
                        <div>
                            Confirm password
                            <br />
                            <input type="password" name="firstname">
                        </div>
                        <br />
                        <div>
                            Email
                            <br />
                            <input type="mail" name="firstname">
                        </div>
                        <br />
                        <br />
                        <div class="flex-center"></div>
                        <div id="submit-div">
                            <input id="submit-button" type="submit" value="Submit">
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
