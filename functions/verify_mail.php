<?PHP
    function verif_mail($code)
    {
        include "functions/functions_db.php";

        $prep = $dbsql->prepare('UPDATE user SET active = 0 WHERE active = :code');
        $prep -> bindParam(':code', $code);
        $result = $prep->execute();
        return "<p style='color:green;'>Your account is now activated, loggin to begin</p>";
    }

?>