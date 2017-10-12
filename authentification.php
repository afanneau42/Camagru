<?PHP
    session_start();
    if (!isset($_SESSION['error']))
        $_SESSION['error'] = 0;

    if ($_POST['username'] !== '' && $_POST['password'] !== '')
    {
        include "functions/functions_db.php";
        $pw_h = hash("whirlpool", $_POST['password']);
        $prep = $dbsql->prepare('SELECT * FROM user WHERE username = :username');
        $result = $prep->execute(array('username' => $_POST['username']));
        $array = $prep->fetchAll();
        foreach ($array as $user)
        {
            if ($user['password'] == $pw_h){
                $_SESSION['logged_on_user'] = $user['id'];
                $_SESSION['grade'] = $user['grade'];
                header("Location: index.php");
            }
            else {
                $_SESSION['error'] = 1;
                header("Location: connection.php");
            }
        }
        $_SESSION['error'] = 1;
        header("Location: connection.php");
    }
    else {
        $_SESSION['error'] = 1;
        header('Location: connection.php');
    }
?>