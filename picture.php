<?PHP
    session_start();
    if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == "")
        header("Location:must_be_log.php");
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css?version=58">
        <link rel="stylesheet" type="text/css" href="picture.css?version=69">
        <meta charset="utf-8">
        <script src="https://use.fontawesome.com/5c9cd0ccac.js"></script>
        <title>Camagru</title>
    </head>
    <body>
        <div id="top">
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
                                </div>';
                        }
                ?>
            </div>
                <div id="div-connexion">
                    <a href="logout.php"><div id="connexion">Logout</div></a>
                    <a href="profile.php"><div id="connexion">Profile</div></a>
                </div>
        </div>
        <div id="mid">
            <div class="mid-center">
                <div class="card" id="card">
                <div class="webcam">
                    <video class="video" id="video"></video>
                        
                    
                    <canvas id="canvas" style="display: none;"></canvas>
                    <img class="preview_1" id="preview_1" src="ressources/filter/masque.png"></img>
                    <img class="preview_2" id="preview_2" src="ressources/filter/joint.png"></img>
                    <img class="preview_3" id="preview_3" src="ressources/filter/moustache.png"></img>
                    </div>
                    <form method="post" id="form_filter">
                        <div class="div_filters">
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/masque.png');"></div>
                                <input id="filter_input" type="radio" class="filter_input" name="filter" value="masque" disabled><br>
                            </div>
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/joint.png');"></div>
                                <input id="filter_input2" type="radio" class="filter_input" name="filter" value="joint" disabled><br>
                            </div>
                            <div class="filter_and_input">
                                <div class="filter" style="background-image: url('ressources/filter/moustache.png');"></div>
                                <input id="filter_input3" type="radio" class="filter_input" name="filter" value="masque" disabled><br>
                            </div>
                        </div>
                        <div class="div_buttons">
                            <button id="startbutton" disabled>Take a picture</button>
                    </form>
                    <p> or </p>
                    <form id="form_upload" action="upload.php" method="post" class="form_upload" enctype="multipart/form-data">
                        <input name="upload" type="file" id="uploadbutton" class="uploadbutton" disabled> </input>
                        <input name="filter" id="filter_upload" value="" hidden></hidden>
                        <input type="submit" value="Upload" name="submit"></input>
                    </form>
                        </br>
                        <span class="advice_txt"> Advice: Picture size has to be less than 4Mb, 700x560 and .jpeg / .jpg / .png</span>
                    </div>
                    </div>
                <div class="pictures" id="pictures">
                    <?PHP
                        include "functions/f_display.php";

                        display_picture_user();
                    ?>
                </div>
            </div>
        </div>
        <div id="foot">
            <div id="text-foot-div">
                <p id="txt">By afanneau 2017</p>
            </div>
        </div>
        <script type="text/javascript" src="functions/take_picture.js?version=69"></script>
        <script type="text/javascript" src="functions/update_picture.js?version=69"></script>
    </body>
</html>