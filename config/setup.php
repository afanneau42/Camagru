<?PHP
    session_start();
    if (!empty($_SESSION['logged_on_user']))
        $_SESSION['logged_on_user'] = '';
    /* Connexion */
    include "database.php";
    $dbsql = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* DB Creation */

    $dbsql->query("CREATE DATABASE IF NOT EXISTS camagru_db");
    $dbsql->query("USE camagru_db");

    /* User table creation */

    $key = md5(microtime(TRUE)*100000);

    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS user(
        id INT AUTO_INCREMENT PRIMARY KEY, 
        username VARCHAR(120) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL, 
        mail VARCHAR(120) NOT NULL UNIQUE,
        grade INT NOT NULL,
        active VARCHAR(255))");
    $prep->execute(array($key));

    /* Post table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS post(
        id INT AUTO_INCREMENT PRIMARY KEY, 
        author_id INT NOT NULL, 
        creation_date INT NOT NULL,
        type VARCHAR(10) NOT NULL)");
    $prep->execute(array($key));

    /* Likes table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS likes(
        picture_id INT NOT NULL,
        author_id INT NOT NULL)");
    $prep->execute(array($key));

    /* Coms table creation */
    
    $prep = $dbsql->prepare("CREATE TABLE IF NOT EXISTS comment(
        picture_id INT NOT NULL,
        author_id INT NOT NULL,
        txt VARCHAR(255))");
    $prep->execute(array($key));


    /* Users inserts */

    $dbsql->query("INSERT INTO user VALUES (NULL, 'admin', 'ecb4db9948a78308b05acca49bb1a74cc1c55ca89e11ef04fce8128da7f67a8e85e3f371fd265c17cf744028f9e0d38653e669b8b1288f7d8417991cbf58fe94', 'arthur.f@gmail.com', 2, 0)");
    $dbsql->query("INSERT INTO user VALUES (NULL, 'bgdu75', '8e835240f89a32be8c1c2f31fba878967b8d617d906e128d76f7f333237d63a598cb42bef9b79c6375909e5f2ad5a040c905a8673b915ec65c3ad654505a39a4', 'bgdu75@gmail.com', 1, 0)"); /* mdp='asdf' */
    $dbsql->query("INSERT INTO user VALUES (NULL, 'jeanmiche', '2f81ccdd50c1ee52b233111e5eb529edcbe57d7e132ade0108d932ac77163216e4bec7f96d2fe5b1f2dc795a94aa5b21c0590dabb5ffddd3bc6bc93419e5e031', 'jm.lepetit@gmail.com', 1, 0)"); /* mdp='potiron_bleu' */

    /* Post inserts */
    
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpg');");
    
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpg');");
    
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '3', '1488688384', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '2', '1496924224', '.jpg');");
    $dbsql->query("INSERT INTO `post` (`id`, `author_id`, `creation_date`, `type`) VALUES (NULL, '1', '1503212701', '.jpg');");
    

    /* likes inserts */

    $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('1', '3');");
    $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('1', '2');");
    $dbsql->query("INSERT INTO `likes` (`picture_id`, `author_id`) VALUES ('2', '2');");

    /* Coms inserts */

    $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('1', '1', 'Nice picture man !');");
    $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('1', '2', 'Wow !');");
    $dbsql->query("INSERT INTO `comment` (`picture_id`, `author_id`, `txt`) VALUES ('2', '3', 'Hahaha LOOOOOOOOOOOL ');");

    /* Close connection */

    $dbsql = NULL;

?>