<?PHP
    function verif_mail($code)
    {
        include "functions/functions_db.php";

        $prep = $dbsql->prepare('SELECT COUNT(*) FROM user WHERE active = :code');
        $prep -> bindParam(':code', $code);
        $prep->execute();
        $r = $prep->fetchAll();
        if ($r[0]["COUNT(*)"] == 1)
        {
            $prep = $dbsql->prepare('UPDATE user SET active = 0 WHERE active = :code');
            $prep -> bindParam(':code', $code);
            $result = $prep->execute();
            return "<p style='color:green;'>Your account is now activated, loggin to begin</p>";
        }
        else
            return "<p style='color:red;'>Wrong code</p>";
    }

    function reset_mdp($mail)
    {
        include "functions/functions_db.php";

        $prep = $dbsql->prepare('SELECT COUNT(*) FROM user WHERE mail = :mail');
        $prep -> bindParam(':mail', $mail);
        $prep->execute();
        $r = $prep->fetchAll();
        if ($r[0]["COUNT(*)"] == 1)
        {
            $new_p = md5(rand());
            $new_p_h = hash("whirlpool", $new_p);
            $prep = $dbsql->prepare('UPDATE user SET password = :new_p WHERE mail = :mail');
            $prep -> bindParam(':mail', $mail);
            $prep -> bindParam(':new_p', $new_p_h);
            $result = $prep->execute();

            
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui bugs
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }

            $to = $_POST['mail'];
            $subject = "Reset your password";
            $txt = "Hello , " . $passage_ligne . 'Your password has been resetted, this is the new one: ' . $passage_ligne . $passage_ligne . $new_p . $passage_ligne . "You should change it in the profile section." . $passage_ligne . $passage_ligne . "See you soon" . $passage_ligne . "Camagru's staff" . $passage_ligne;
            $headers = "From: support@camagru.com";

            mail($to,$subject,$txt,$headers);

            return "<p style='color:green;'>We sent you a mail with your new password</p>";
        }
        else
            return "<p style='color:red;'>Wrong mail</p>";
    }

     function valid_password($pw){
        if (strlen($pw) < 8)
            return 1;
        else if (!preg_match('@[A-Z]@', $pw))
            return 2;
        else if (!preg_match('@[a-z]@', $pw))
            return 3;
        else if (!preg_match('@[0-9]@', $pw))
            return 4;
     }

     function change_pass($pw, $uid){
        include "functions/functions_db.php";

        $pw_h = hash("whirlpool", $pw);
        $prep = $dbsql->prepare('UPDATE user SET password = :pw_h WHERE id = :uid');
        $prep -> bindParam(':pw_h', $pw_h);
        $prep -> bindParam(':uid', $uid);
        $result = $prep->execute();
        return "<p style='color:green;'>Your password has been succefully changed</p>";
     }

     function good_pw($pw, $uid){
        include "functions/functions_db.php";

        $pw_h = hash("whirlpool", $pw);
        $prep = $dbsql->prepare('SELECT COUNT(*) FROM user WHERE password = :pw_h AND id = :uid');
        $prep -> bindParam(':pw_h', $pw_h);
        $prep -> bindParam(':uid', $uid);
        $prep->execute();
        $r = $prep->fetchAll();
        if ($r[0]["COUNT(*)"] == 1)
            return 1;
        else
            return 0;
     }
?>