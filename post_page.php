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
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=51">
        <link rel="stylesheet" type="text/css" href="connection.css?version=51">
        <link rel="stylesheet" type="text/css" href="post.css?version=55">
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
                    <div class="picture"></div>
                    <div class="text">
                        <div class="info">
                            <div class="login">test login</div>
                            <div class="attributes">
                                <div class="likes"></div>
                                <div class="nb_commentaries"> </div>
                            </div>
                            <div class="date">posted 10 november 1997 at 14:20</div>
                        </div>
                        <div class="commentaries_area">
                            <div class="com1">
                                <div class="com1_author">autor</div>
                                <div class="com1_txt">NIIIIIIIIIICjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjE !</div>
                                <div class="com1_date">11/07/1996</div>
                            </div>
                            <div class="com2">
                                
                                <!-- ... -->
                                    
                            </div>

                            <!-- ... -->
                            
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