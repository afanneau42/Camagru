<?PHP
    function display_post_gallery(){
        include "functions/functions_db.php";
        
        /* Request post table */

        $prep = $dbsql->prepare('SELECT * FROM post');
        $prep->execute();
        $r = $prep->fetchAll();

        foreach ($r as $post){

            /* Request username of the author of the post */
            
            $prep = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
            $prep -> bindParam(':id', $post['author_id']);
            $prep->execute();
            $user = $prep->fetchAll();

            /* Request the number of likes of the post */

            $prep2 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id');
            $prep2 -> bindParam(':picture_id', $post['id']);
            $prep2->execute();
            $likes = $prep2->fetchAll();

            /* Set difference if no likes */

            if ($likes[0]['COUNT(*)'] == 0)
                $likes_display = "<img id='vomi' src='./ressources/emoji_vomi.png'>";
            else if ($likes[0]['COUNT(*)'] >= 1)
                $likes_display = $likes[0]['COUNT(*)'] . " <img src='./ressources/like_red.png'>";

            /* Request the number of commentaries of the post */

            $prep3 = $dbsql->prepare('SELECT COUNT(*) FROM comment WHERE picture_id=:picture_id');
            $prep3 -> bindParam(':picture_id', $post['id']);
            $prep3->execute();
            $coms = $prep3->fetchAll();

            /* Set difference if no commentaries */

            if ($coms[0]['COUNT(*)'] == 0)
                $coms_display = "No <img src='./ressources/comments_icon.png'>";
            else if ($coms[0]['COUNT(*)'] >= 1)
                $coms_display = $coms[0]['COUNT(*)'] . " <img src='./ressources/comments_icon.png'>";
            
            /* Request if user like or not the post */

            $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id AND author_id=:author_id');
            $prep4 -> bindParam(':picture_id', $post['id']);
            $prep4 -> bindParam(':author_id', $_SESSION['logged_on_user']);
            $prep4->execute();
            $like_user = $prep4->fetchAll();

            /* Display like button in fucntion of user's data */

            if ($like_user[0]['COUNT(*)'] == 0)
                $like_button = "<div class='like_button_void'>
                                    <a href='like_button.php?id=" . $post['id'] . "'>
                                        <div>
                                        </div>
                                    </a>
                                </div>";
            else
                $like_button = "<div class='like_button_red'>
                                    <a href='like_button.php?id=" . $post['id'] . "'>
                                        <div>
                                        </div>
                                    </a>
                                </div>";
            
            /* Set timestamp to good format */

            $date = date('d F Y \a\t H:i' , $post['creation_date']);

            echo    "<div class='post_card'>
                        <div class='post_author'>" 
                            . $user[0]['username'] .
                        "</div>
                            <div class='post_picture'>
                                " . $like_button . "
                            </div>
                        
                        <a href='post_page.php?id=" . $post['id'] . "'>
                        <div class='post_atributes'>
                            <div class='post_like'> 
                                " . $likes_display . "
                            </div>
                            <div class='post_com'>
                                " . $coms_display . "
                            </div>
                            <div class='post_date'>
                                " . $date . "
                            </div>
                        </div>
                        </a>
                    </div>";
        }
    }
?>