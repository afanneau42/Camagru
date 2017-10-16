<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == "")
        header("Location:must_be_log.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=51">
        <link rel="stylesheet" type="text/css" href="picture.css?version=51">
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
                </div>';
        </div>
        <div id="mid">
            <div class="mid-center" >
                <div class="card" id="card">
                    <video class="video" id="video"></video>
                    
                    
                    <!-- <canvas id="canvas"></canvas> -->
                    <form method="post">
                        <div class="div_filters">
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/masque.png');"></div>
                                <input type="radio" class="filter_input" name="filter" value="masque"><br>
                            </div>
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/joint.png');"></div>
                                <input type="radio" class="filter_input" name="filter" value="joint"><br>
                            </div>
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/moustache.png');"></div>
                                <input type="radio" class="filter_input" name="filter" value="masque"><br>
                            </div>
                        </div>
                        <div class="div_buttons">
                            <button id="startbutton">Take a picture</button>
                            <p> or </p>
                            <button id="uploadbutton"> Upload </button>
                        </div>
                    </form>
                </div>
                <div class="pictures">
                </div>
            </div>
        </div>
        <div id="foot">
            <div id="text-foot-div">
                <p id="txt">By afanneau 2017</p>
            </div>
        </div>
        <script type="text/javascript" src="functions/take_picture.js"></script>
    </body>
</html>