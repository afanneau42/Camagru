<?PHP
    
    function insert_user($dbh, $id, $username, $password, $email, $rank)
    {
        $sql = $dbh->prepare("
        INSERT INTO user
        SELECT * FROM (SELECT ?, ?, ?, ?, ?, ?) AS tmp
        WHERE NOT EXISTS (
            SELECT username FROM user WHERE username = ?
        ) LIMIT 1;
        ");
        $sql->execute(array($id, $username, $password, $email, $rank, 0,$username));
    }
?>