<?PHP
    session_start();
    $_SESSION['logged_on_user'] = '';
    $_SESSION['grade'] = '';
    header('Location: index.php');
?>