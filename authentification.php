<?PHP
    session_start();
    if (!isset($_SESSION['error']))
        $_SESSION['error'] = 0;

    if (htmlspecialchars($_POST['username']) !== '' && htmlspecialchars($_POST['password']) !== '')
    {
        include "functions/functions_db.php";
        $pw_h = hash("whirlpool", htmlspecialchars($_POST['password']));
        $prep = $dbsql->prepare('SELECT * FROM user WHERE username = :username');
        $result = $prep->execute(array('username' => htmlspecialchars($_POST['username'])));
        $array = $prep->fetchAll();
        foreach ($array as $user)
        {
            if ($user['password'] == $pw_h && $user['active'] == 0){
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