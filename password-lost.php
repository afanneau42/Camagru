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
                <div class="card">
                    <form method="post">
                        <div>
                            Your mail
                            <br />
                            <input type="text" name="mail" value="">
                        </div>
                        <br />
                        <div class="flex-center"></div>
                        <?PHP
                            include "functions/f_user.php";
                            
                            if (!empty($_POST['submit']) && htmlspecialchars($_POST['submit']) == "Submit")
                                echo reset_mdp(htmlspecialchars($_POST['mail']));
                        ?>
                        <div id="submit-div">
                            <input id="submit-button" type="submit" value="Submit" name="submit">
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
