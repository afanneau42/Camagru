<?PHP
    session_start();
    if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] != '')
        header('Location: index.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=52">
        <link rel="stylesheet" type="text/css" href="connection.css?version=52">
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
                <div class="card">
                    <form method="post">
                        <div>
                            Username
                            <br />
                            <input type="text" name="username" value="<?PHP if (!empty($_POST['username'])) { echo htmlspecialchars($_POST['username']);}?>">
                        </div>
                        <br />
                        <div>
                            Password
                            <br />
                            <input type="password" name="password">
                        </div>
                        <div>
                            Confirm password
                            <br />
                            <input type="password" name="password-re">
                        </div>
                        <br />
                        <div>
                            Email
                            <br />
                            <input type="mail" name="mail" value="<?PHP if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['mail']);}?>">
                        </div>
                        <br />
                        <br />
                        <?PHP
                            include "create_account.php";
                            if (!empty($_POST['submit'])) {
                                echo create_acc()."<br />";
                            }
                        ?>
                        <div class="flex-center"></div>
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
