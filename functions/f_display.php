<?PHP
    function display_post_gallery(){
        include "functions/functions_db.php";

        $pre = $dbsql->prepare('SELECT COUNT(*) FROM post');
        $pre->execute();
        $r2 = $pre->fetchAll();
        $post_nb = $r2[0]['COUNT(*)'];
        if ($post_nb <= 10)
        {
            /* Request post table */

            $pre2 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date ASC');
            $pre2->execute();
            $r = $pre2->fetchAll();
        
        }
        else {
            $page_nb = (int)($post_nb/10 + 1);
            
            if (!isset($_GET['page']))
                $_GET['page'] = 1;

            $post_begin = $_GET['page'] * 10 - 10;
            if ($_GET['page'] == $page_nb)
                $post_end = $post_nb;
            else
                $post_end = $_GET['page'] * 10;

            echo $post_begin;
            echo $post_end;

            $pre1 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date ASC LIMIT :limit1, :limit2');
            $pre1->bindParam(':limit1', $post_begin);
            $pre1->bindParam(':limit2', $post_end);
            $pre1->execute();
            $r = $pre1->fetchAll();
        }

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
        echo "</div>";
        if ($post_nb > 10) {
            echo "<div class='pagination'>";
            $i = 0;
            while ($i != $page_nb)
            {
                $i = $i + 1;
                if ($i == $_GET['page'])
                {
                    echo "<a href='gallery.php?page=". $i ."' class='number_page_actual'>" . $i . "</a>";
                }
                else
                    echo "<a href='gallery.php?page=". $i ."' class='number_page'>" . $i . "</a>";
            }
            echo "</div>";
        }
    }
?>