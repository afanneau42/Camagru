<?PHP
    function create_acc() {
        include "functions/f_user.php";
        if (htmlspecialchars($_POST["submit"]) === "Submit" && strlen(htmlspecialchars($_POST['username'])) < 120 && strlen(htmlspecialchars($_POST['password'])) < 255 && strlen(htmlspecialchars($_POST['password-re'])) < 255 && strlen(htmlspecialchars($_POST['mail'])) < 120)
        {
            /* Check fields */

            if (htmlspecialchars($_POST['username']) == '' || htmlspecialchars($_POST['password']) == '' || htmlspecialchars($_POST['mail']) == '' || htmlspecialchars($_POST['password-re']) == '')
                return "<p style='color:red;'>Veuillez remplir tout les champs</p>";
            
            /* Check password confirmation */

            else if (htmlspecialchars($_POST['password']) !== htmlspecialchars($_POST['password-re']))
                return "<p style='color:red;'>Mot de passe different</p>";
            
            /* Check password security */
            
            $err = valid_password(htmlspecialchars($_POST['password']));

            if ($err == 1)
                return "<p style='color:red;'>Votre mot de passe doit contenir au moins 8 caracteres</p>";
            else if ($err == 2)
                return "<p style='color:red;'>Votre mot de passe doit contenir au moins une majuscule</p>";
            else if ($err == 3)
                return "<p style='color:red;'>Votre mot de passe doit contenir au moins une minuscule</p>";
            else if ($err == 4)
                return "<p style='color:red;'>Votre mot de passe doit contenir au moins un chiffre</p>";

            /* Check mail */
            
            else if (!filter_var(htmlspecialchars($_POST['mail']), FILTER_VALIDATE_EMAIL))
                return "<p style='color:red;'>mail invalide</p>";
            else
            {
                /* Check username into db */

                include "functions/functions_db.php";
                $prep = $dbsql->prepare('SELECT * FROM user WHERE username = :username');
                $result = $prep->execute(array('username' => htmlspecialchars($_POST['username'])));
                $array = $prep->fetchAll();
                foreach ($array as $user)
                {
                    return "<p style='color:red;'>utilisateur deja existant</p>";
                }

                /* Check mail into db */

                $prep = $dbsql->prepare('SELECT * FROM user WHERE mail = :mail');
                $result = $prep->execute(array('mail' => htmlspecialchars($_POST['mail'])));
                $array = $prep->fetchAll();
                foreach ($array as $user)
                {
                    return "<p style='color:red;'>mail deja existant</p>";
                }
                
                /* Insert user into db */

                $pw_h = hash('whirlpool', $_POST['password']);

                $activ_code = hash("whirlpool", rand());
                $prep = $dbsql->prepare('INSERT INTO user VALUES (NULL, :username, :pw_h, :mail, 1, :activ_code)');
                // $prep -> bindParam(':username', htmlspecialchars($_POST['username']));
                $prep -> bindParam(':username', $_POST['username']);
                $prep -> bindParam(':pw_h', $pw_h);
                $prep -> bindParam(':mail', $_POST['mail']);
                $prep -> bindParam(':activ_code', $activ_code);
                $result = $prep->execute();
                
                /* Send activation mail */

                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", htmlspecialchars($_POST['mail']))) // On filtre les serveurs qui bugs
                {
                    $passage_ligne = "\r\n";
                }
                else
                {
                    $passage_ligne = "\n";
                }

                $link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
                $link = str_replace("/inscription.php", "", $link);
                $link = $link . '/verify_email.php?code=' . $activ_code;

                $to = htmlspecialchars($_POST['mail']);
                $subject = "Activate your account";
                $txt = "Welcome " . htmlspecialchars($_POST['username']) . ', ' . $passage_ligne . ' The last step is to verify your email by clicking in this link : ' . $passage_ligne . $passage_ligne . $link . $passage_ligne . $passage_ligne . "See you soon" . $passage_ligne . "Camagru's staff" . $passage_ligne;
                $headers = "From: support@camagru.com";

                mail($to,$subject,$txt,$headers);
                
                return "<p style='color:green;'>We sent you an email to activate youre account</p>";
            }
        }
    }
?>