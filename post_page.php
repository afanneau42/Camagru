<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == "")
        header("Location:must_be_log.php");
    
    include "functions/functions_db.php";

    $id = htmlspecialchars($_GET['id']);
    $prep = $dbsql->prepare('SELECT COUNT(*) FROM post WHERE id=:id');
    $prep -> bindParam(':id', $id);
    $prep->execute();
    $count = $prep->fetchAll();

    if ($count[0]['COUNT(*)'] == 0)
        header("Location:index.php");
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=58">
        <link rel="stylesheet" type="text/css" href="post.css?version=63">
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
                <div class="post_card">
                    <div class="picture" style="background-image: url(
                        <?PHP
                            if (file_exists("ressources/pictures/" . $_GET['id'] . $_GET['type']))
                                echo "ressources/pictures/" . $_GET['id'] . $_GET['type'];
                            else
                                echo "ressources/error.png";
                        ?>
                        );"></div>
                    <div class="text">
                        <div class="info">

                            
                            <?PHP

                                include "functions/f_display.php";

                                display_post_info($id);
                            ?>
                        </div>
                        <div class="commentaries_area">
                            <?PHP
                                display_comments($id);
                            ?>
                        </div>
                        <div class="com_input_div">
                            <form action="create_com.php?id=<?PHP
                             echo $id;
                             ?>
                              " method="post">
                                <input class="com_input_text" placeholder="Write your comment (Max 250 characters) ..." type="text" name="text"></input>
                                <input class="com_input_submit" type="submit" value="submit" name="button"></input>
                            </form>
                        </div>    
                    </div>
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