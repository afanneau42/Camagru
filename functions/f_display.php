<?PHP
    function display_post_gallery(){
        include "functions/functions_db.php";
        
        $prep = $dbsql->prepare('SELECT * FROM post');
        $prep->execute();
        $r = $prep->fetchAll();

        foreach ($r as $post){

            $prep = $dbsql->prepare('SELECT * FROM user WHERE id=:id');
            $prep -> bindParam(':id', $post['author_id']);
            $prep->execute();
            $user = $prep->fetchAll();

            echo "<div class='pic_card'>" . $user[0]['username'] . "</div>";
        }
    }
?>