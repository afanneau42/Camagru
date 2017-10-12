<?PHP
    function create_acc() {
        if ($_POST["submit"] === "Submit")
        {
            /* Check fields */

            if ($_POST['username'] == '' || $_POST['password'] == '' || $_POST['mail'] == '' || $_POST['password-re'] == '')
                return "<p style='color:red;'>Veuillez remplir tout les champs</p>";
            
            /* Check password confirmation */

            else if ($_POST['password'] !== $_POST['password-re'])
                return "<p style='color:red;'>Mot de passe different</p>";
            
            /* Check mail */
            
            else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                return "<p style='color:red;'>mail invalide</p>";
            else
            {
                /* Check username into db */

                include "functions/functions_db.php";
                $prep = $dbsql->prepare('SELECT * FROM user WHERE username = :username');
                $result = $prep->execute(array('username' => $_POST['username']));
                $array = $prep->fetchAll();
                foreach ($array as $user)
                {
                    return "<p style='color:red;'>utilisateur deja existant</p>";
                }

                /* Check mail into db */

                $prep = $dbsql->prepare('SELECT * FROM user WHERE mail = :mail');
                $result = $prep->execute(array('mail' => $_POST['mail']));
                $array = $prep->fetchAll();
                foreach ($array as $user)
                {
                    return "<p style='color:red;'>mail deja existant</p>";
                }
                
                /* Insert user into db */

                $activ_code = hash("whirlpool", rand());
                $prep = $dbsql->prepare('INSERT INTO user VALUES (NULL, :username, :pw_h, :mail, 1, :activ_code)');
                $prep -> bindParam(':username', $_POST['username']);
                $prep -> bindParam(':pw_h', hash('whirlpool', $_POST['password']));
                $prep -> bindParam(':mail', $_POST['mail']);
                $prep -> bindParam(':activ_code', $activ_code);
                $result = $prep->execute();
                
                /* Send activation mail */

                $to = $_POST['mail'];
                $subject = "Activate youre account";
                $txt = "Welcome " .$_POST['username']. ', \r\n The last step is to verify your email by clicking in this link : \r\n \r\n localhost:8080/camagru/verify_email.php?code=' . $activ_code . "\r\n\r\n See you soon\r\nCamagru's staff\r\n";
                $headers = "From: support@camagru.com";

                mail($to,$subject,$txt,$headers);
                
                return "<p style='color:green;'>We sent you an email to activate youre account</p>";
            }
        }
    }
?>