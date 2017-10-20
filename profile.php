<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == "")
        header("Location:must_be_log.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=58">
        <link rel="stylesheet" type="text/css" href="connection.css?version=58">
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
                <div id="div-connexion">
                    <a href="logout.php"><div id="connexion">Logout</div></a>
                    <a href="profile.php"><div id="connexion">Profile</div></a>
                </div>
        </div>
        <div id="mid">
            <div id="mid-center">
            <div class="card">
                    <form method="post">
                        <div>
                            Password
                            <br />
                            <input type="password" name="password" value="">
                        </div>
                        <br />
                        <div>
                            New password
                            <br />
                            <input type="password" name="new_password">
                        </div>
                        <div>
                            Confirm new password
                            <br />
                            <input type="password" name="new_password_re">
                        </div>
                        <br />
                        <?PHP
                            include "functions/f_user.php";
                            
                            /* Check password validity */

                            if (!empty($_POST['submit']))
                            {  
                                $err = valid_password($_POST['new_password']);
                                if ($_POST['submit'] !== 'Submit'){}
                                else if (good_pw(htmlspecialchars($_POST['password']), $_SESSION['logged_on_user']) == 0)
                                    echo "<p style='color:red;'>Mot de passe actuel mauvais</p>";
                                else if (htmlspecialchars($_POST['new_password']) !== htmlspecialchars($_POST['new_password_re']))
                                    echo "<p style='color:red;'>Mot de passe different</p>";
                                else if ($err == 1)
                                    echo "<p style='color:red;'>Votre mot de passe doit contenir au moins 8 caracteres</p>";
                                else if ($err == 2)
                                    echo "<p style='color:red;'>Votre mot de passe doit contenir au moins une majuscule</p>";
                                else if ($err == 3)
                                    echo "<p style='color:red;'>Votre mot de passe doit contenir au moins une minuscule</p>";
                                else if ($err == 4)
                                    echo "<p style='color:red;'>Votre mot de passe doit contenir au moins un chiffre</p>";
                                else
                                    echo change_pass(htmlspecialchars($_POST['new_password']), $_SESSION['logged_on_user'])."<br />";
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