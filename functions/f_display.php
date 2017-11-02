<?PHP
    // function display_post_gallery(){
    //     include "functions/functions_db.php";
        
    //     if (is_numeric($_GET['page']))
    //     {
    //         $pre = $dbsql->prepare('SELECT COUNT(*) FROM post');
    //         $pre->execute();
    //         $r2 = $pre->fetchAll();
    //         $post_nb = $r2[0]['COUNT(*)'];
    //         if ($post_nb <= 10)
    //         {
    //             /* Request post table */

    //             $pre2 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date DESC');
    //             $pre2->execute();
    //             $r = $pre2->fetchAll();
            
    //         }
    //         else {
    //             $page_nb = (int)($post_nb/10 + 1);
                
    //             if ($_GET['page'] > $page_nb)
    //                 $_GET['page'] = 1;
    //             if (!isset($_GET['page']))
    //                 $_GET['page'] = 1;

    //             $post_begin = $_GET['page'] * 10 - 10;
    //             if ($_GET['page'] == $page_nb)
    //                 $post_end = $post_nb - (($page_nb - 1)*10);
    //             else
    //                 $post_end = 10;

    //             $pre1 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date DESC LIMIT :limit1, :limit2');
    //             $pre1->bindParam(':limit1', $post_begin, PDO::PARAM_INT);
    //             $pre1->bindParam(':limit2', $post_end, PDO::PARAM_INT);
    //             $pre1->execute();
    //             $r = $pre1->fetchAll();
    //         }

    //         foreach ($r as $post){

    //             /* Request username of the author of the post */
                
    //             $prep = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
    //             $prep -> bindParam(':id', $post['author_id']);
    //             $prep->execute();
    //             $user = $prep->fetchAll();

    //             /* Request the number of likes of the post */

    //             $prep2 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id');
    //             $prep2 -> bindParam(':picture_id', $post['id']);
    //             $prep2->execute();
    //             $likes = $prep2->fetchAll();

    //             /* Set difference if no likes */

    //             if ($likes[0]['COUNT(*)'] == 0)
    //                 $likes_display = "<img id='vomi' src='./ressources/emoji_vomi.png'>";
    //             else if ($likes[0]['COUNT(*)'] >= 1)
    //                 $likes_display = $likes[0]['COUNT(*)'] . " <img src='./ressources/like_red.png'>";

    //             /* Request the number of commentaries of the post */

    //             $prep3 = $dbsql->prepare('SELECT COUNT(*) FROM comment WHERE picture_id=:picture_id');
    //             $prep3 -> bindParam(':picture_id', $post['id']);
    //             $prep3->execute();
    //             $coms = $prep3->fetchAll();

    //             /* Set difference if no commentaries */

    //             if ($coms[0]['COUNT(*)'] == 0)
    //                 $coms_display = "No <img src='./ressources/comments_icon.png'>";
    //             else if ($coms[0]['COUNT(*)'] >= 1)
    //                 $coms_display = $coms[0]['COUNT(*)'] . " <img src='./ressources/comments_icon.png'>";
                
    //             /* Request if user like or not the post */

    //             $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id AND author_id=:author_id');
    //             $prep4 -> bindParam(':picture_id', $post['id']);
    //             $prep4 -> bindParam(':author_id', $_SESSION['logged_on_user']);
    //             $prep4->execute();
    //             $like_user = $prep4->fetchAll();

    //             /* Display like button in fucntion of user's data */

    //             if ($like_user[0]['COUNT(*)'] == 0)
    //                 $like_button = "<div class='like_button_void'>
    //                                     <a href='like_button.php?id=" . $post['id'] . "'>
    //                                         <div>
    //                                         </div>
    //                                     </a>
    //                                 </div>";
    //             else
    //                 $like_button = "<div class='like_button_red'>
    //                                     <a href='like_button.php?id=" . $post['id'] . "'>
    //                                         <div>
    //                                         </div>
    //                                     </a>
    //                                 </div>";
                
    //             /* Set timestamp to good format */

    //             $url = "ressources/pictures/" . $post['id'] . $post['type'];
    //             $date = date('d F Y \a\t H:i' , $post['creation_date']);

    //             echo    "<div class='post_card'>
    //                         <div class='post_author'>" 
    //                             . $user[0]['username'] .
    //                         "</div>
    //                             <div class='post_picture' style='background-image: url($url);'>
    //                                 " . $like_button . "
    //                             </div>
                            
    //                         <a href='post_page.php?id=" . $post['id'] . "&type=" . $post["type"] . "'>
    //                         <div class='post_atributes'>
    //                             <div class='post_like'> 
    //                                 " . $likes_display . "
    //                             </div>
    //                             <div class='post_com'>
    //                                 " . $coms_display . "
    //                             </div>
    //                             <div class='post_date'>
    //                                 " . $date . "
    //                             </div>
    //                         </div>
    //                         </a>
    //                     </div>";
    //         }
    //         echo "</div>";
    //         if ($post_nb > 10) {
    //             echo "<div class='pagination'>";
    //             $i = 0;
    //             while ($i != $page_nb)
    //             {
    //                 $i = $i + 1;
    //                 if ($i == $_GET['page'])
    //                 {
    //                     echo "<a href='gallery.php?page=". $i ."' class='number_page_actual'>" . $i . "</a>";
    //                 }
    //                 else
    //                     echo "<a href='gallery.php?page=". $i ."' class='number_page'>" . $i . "</a>";
    //             }
    //         }
    //     }
    //     echo "</div>";
    // }

    function display_post_gallery(){
        include "functions/functions_db.php";
        
        if (is_numeric($_GET['page']))
        {
            $pre = $dbsql->prepare('SELECT COUNT(*) FROM post');
            $pre->execute();
            $r2 = $pre->fetchAll();
            $post_nb = $r2[0]['COUNT(*)'];
            if ($post_nb <= 9)
            {
                /* Request post table */

                $pre2 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date DESC');
                $pre2->execute();
                $r = $pre2->fetchAll();
            
            }
            else {
                $page_nb = (int)($post_nb/9 + 1);
                
                if ($_GET['page'] > $page_nb)
                    $_GET['page'] = 1;
                if (!isset($_GET['page']))
                    $_GET['page'] = 1;

                $post_begin = $_GET['page'] * 9 - 9;
                if ($_GET['page'] == $page_nb)
                    $post_end = $post_nb - (($page_nb - 1)*9);
                else
                    $post_end = 10;

                $pre1 = $dbsql->prepare('SELECT * FROM post ORDER BY creation_date DESC');
                $pre1->execute();
                $r = $pre1->fetchAll();
            }

            $elem = 1;

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
                    $coms_display = "0 <img src='./ressources/comments_icon.png'>";
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

                $url = "ressources/pictures/" . $post['id'] . $post['type'];
                $date = date('d F Y \a\t H:i' , $post['creation_date']);

                if ($elem <= 9)
                    echo    "<div class='post_card' id='post_card_".$elem."'>";
                else
                    echo    "<div class='card_hidden' id='post_card_".$elem."'>";

                
                echo        "<div class='post_author'>" 
                                . $user[0]['username'] .
                            "</div>
                                <div class='post_picture' style='background-image: url($url);'>
                                    " . $like_button . "
                                </div>
                            
                            <a href='post_page.php?id=" . $post['id'] . "&type=" . $post["type"] . "'>
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
                        $elem += 1;
            }
            echo "</div>";
        }
        echo "</div>";
    }

    function display_comments($id) {
        include "functions/functions_db.php";

        /* Request comments on the post */

        $prep = $dbsql->prepare('SELECT * FROM comment WHERE picture_id=:picture_id');
        $prep -> bindParam(':picture_id', $id);
        $prep->execute();
        $comment = $prep->fetchAll();

        /* Display comments on the post */

        foreach ($comment as $r) {

            $prep2 = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
            $prep2->bindParam(':id', $r['author_id']);
            $prep2->execute();
            $user = $prep2->fetchAll();

            echo "
                <div class='com'>
                    <div class='com_author'>" . $user[0]['username'] . "</div>
                    <div class='com_txt'>" . $r['txt'] . "</div>
                </div>";
        }
    }

    function display_post_info($id) {
        include "functions/functions_db.php";
        
            /* Request info of the post */
        
            $prep = $dbsql->prepare('SELECT * FROM post WHERE id=:picture_id');
            $prep -> bindParam(':picture_id', $id);
            $prep->execute();
            $post_info = $prep->fetchAll();

            /* Request info of the author of the post */

            $uid = $post_info[0]['author_id'];
            $prep2 = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
            $prep2 -> bindParam(':id', $uid);
            $prep2->execute();
            $user = $prep2->fetchAll();

            /* Request likes number of the post */
        
            $prep3 = $dbsql->prepare('SELECT COUNT(*) FROM likes WHERE picture_id=:picture_id');
            $prep3 -> bindParam(':picture_id', $id);
            $prep3->execute();
            $post_likes = $prep3->fetchAll();

            /* Request comments number of the post */
        
            $prep4 = $dbsql->prepare('SELECT COUNT(*) FROM comment WHERE picture_id=:picture_id');
            $prep4 -> bindParam(':picture_id', $id);
            $prep4->execute();
            $post_comments = $prep4->fetchAll();

            $date = date('d F Y \a\t H:i' , $post_info[0]['creation_date']);

            if ($post_likes[0]['COUNT(*)'] == 0)
                $likes_display = "<img id='vomi' src='./ressources/emoji_vomi.png'>";
            else if ($post_likes[0]['COUNT(*)'] >= 1)
                $likes_display = $post_likes[0]['COUNT(*)'] . " <img src='./ressources/like_red.png'>";

            if ($post_comments[0]['COUNT(*)'] == 0)
                $coms_display = "No <img src='./ressources/comments_icon.png'>";
            else if ($post_comments[0]['COUNT(*)'] >= 1)
                $coms_display = $post_comments[0]['COUNT(*)'] . " <img src='./ressources/comments_icon.png'>";

            echo "
                    <div class='login'>" . $user[0]['username'] . "</div>
                    <div class='attributes'>
                        <div class='likes'>" . $likes_display . "</div>
                        <div class='nb_commentaries'>" . $coms_display . "</div>
                        <div class='date'>posted " . $date . "</div>
                        </div>
                    ";

    }

    function display_picture_user() {
        if (!isset($_SESSION))
            session_start();
        include "functions/functions_db.php";
        if (!empty($_SESSION['logged_on_user']))
        {
            $prep = $dbsql->prepare('SELECT * FROM post WHERE author_id=:id ORDER BY creation_date DESC');
            $prep->bindParam(':id', $_SESSION['logged_on_user']);
            $prep->execute();
            $r = $prep->fetchAll();

            foreach ($r as $pic) {
                echo "<div class='picture_history' id='pic_" . $pic['id'] . "'>
                    "        
                // <a href='delete_post.php?id=" . $pic['id'] . "'><i class='fa fa-times fa-2x' aria-hidden='true'></i></a>                        
                        ."<a><i class='fa fa-times fa-2x' aria-hidden='true'></i></a>
                        <a href='post_page.php?id=" . $pic['id'] . "&type=" . $pic['type'] . "'><div class='picture_background' style='background-image: url(ressources/pictures/" . $pic['id']. $pic['type'];
                echo ");'></div></a></div>";
            }
        }
    }
?>