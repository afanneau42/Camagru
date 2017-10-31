<?PHP
    if (!isset($_SESSION))
        session_start();
    if (empty($_SESSION['logged_on_user']))
        $_SESSION['logged_on_user'] = '';
    /* Connexion */
    include "database.php";
    include "functions/f_insert.php";
    $dbsql = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* DB Creation */

    $dbsql->query("CREATE DATABASE IF NOT EXISTS camagru_db");
    $dbsql->query("USE camagru_db");

    /* User table creation */

    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS user(
        id INT AUTO_INCREMENT PRIMARY KEY, 
        username VARCHAR(120) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL, 
        mail VARCHAR(120) NOT NULL UNIQUE,
        grade INT NOT NULL,
        active VARCHAR(255))");
    $prep->execute();

    /* Post table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS post(
        id INT AUTO_INCREMENT PRIMARY KEY, 
        author_id INT NOT NULL, 
        creation_date INT NOT NULL,
        type VARCHAR(10) NOT NULL)");
    $prep->execute();

    /* Likes table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS likes(
        picture_id INT NOT NULL,
        author_id INT NOT NULL)");
    $prep->execute();

    /* Coms table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS comment(
        id INT AUTO_INCREMENT PRIMARY KEY,
        picture_id INT NOT NULL,
        author_id INT NOT NULL,
        txt VARCHAR(255))");
    $prep->execute();

    $pre = $dbsql->prepare('SELECT COUNT(*) FROM user WHERE id = 1');
    $pre->execute();
    $r2 = $pre->fetchAll();

    /* Users inserts */
    insert_user($dbsql, 1, 'amin68_nature', 'ecb4db9948a78308b05acca49bb1a74cc1c55ca89e11ef04fce8128da7f67a8e85e3f371fd265c17cf744028f9e0d38653e669b8b1288f7d8417991cbf58fe94', 'arthur.f@gmail.com', 2);
    insert_user($dbsql, 2, 'bgdu75', '8e835240f89a32be8c1c2f31fba878967b8d617d906e128d76f7f333237d63a598cb42bef9b79c6375909e5f2ad5a040c905a8673b915ec65c3ad654505a39a4', 'bgdu75@gmail.com', 1);
    insert_user($dbsql, 3, 'jeanmiche', '2f81ccdd50c1ee52b233111e5eb529edcbe57d7e132ade0108d932ac77163216e4bec7f96d2fe5b1f2dc795a94aa5b21c0590dabb5ffddd3bc6bc93419e5e031', 'jm.lepetit@gmail.com', 1);
    insert_user($dbsql, 4, 'animalZZZZ', 'f54b8f7ed182d1a17daddf770a8a8e91f9986ada6b2d9a067c9a00d987a7243645559047c9328755267b2a91999ccbae4e36ff095450861911bd51e1cbc06523', 'animauxxxxx@gmail.com', 1); /* mdp = Louve98456 */
    insert_user($dbsql, 5, 'brosse_passion', 'eaa500a2499f07daba70714bafd346bc5eb01041a9fcb2c840c4f9496b0a9431f25afadb1299c69c5237db29d496ab307187da0768c285f7988d28a9c2ba4796', 'brosse_passion@yahoo.fr', 1); /* mdp = Kiffelesbrosses89 */

    if ($r2[0]['COUNT(*)'] == 0)
    {

        /* Post inserts */

        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.jpeg');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.png');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpeg');");
        
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.png');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.png');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpeg');");
        
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.jpeg');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.jpeg');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpeg');");

        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '4', '1303212701', '.jpeg');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '4', '1503412701', '.jpeg');");
        
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '5', '1453615721', '.jpeg');");
        $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '5', '1600000000', '.jpeg');");
        

        /* likes inserts */

        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('1', '3');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('1', '2');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('2', '2');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('10', '2');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('10', '1');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('9', '3');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('7', '1');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('6', '3');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('6', '2');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('6', '1');");

        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('3', '2');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('3', '3');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('3', '4');");

        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('11', '4');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('11', '3');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('11', '1');");
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('11', '2');");
        
        $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('12', '5');");
        

        /* Coms inserts */

        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('1', '1', 'Nice picture man !');");
        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('1', '2', 'Wow !');");
        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('2', '3', 'Hahaha LOOOOOOOOOOOL ');");

        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('11', '1', 'OMG ITS SO CUTE OMG OMG OMG OMG');");
        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('11', '4', 'Haha thanks ! :) ');");
        
        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('10', '4', 'When i see a pic like this I immediatly think to upload it on camagru ! What an awesome website, perfectly developped WOW OMG');");

        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('12', '2', 'C moche');");
        $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('13', '5', 'Voila j ai voulu vous présenter un nouveau modèle trop joli ! Bisous les brosses <3');");
        
    }
    /* Close connection */

    $dbsql = NULL;
?>