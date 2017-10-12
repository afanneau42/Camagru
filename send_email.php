<?PHP
    $email= "arthur.fanneau@gmail.com";
$subject = "Activer votre compte";
  $from = "From: support@camagru.com\n";
  $from .= "Content-type: text; charset= utf8\n";
  $message = "
  Bienvenue sur Camagru,
  
  Pour activer votre compte, veuillez cliquer sur le lien ci dessous
  ou le copier/coller dans votre navigateur.
  Ceci est un mail automatique, veuillez ne pas y répondre.";
  mail($email, $subject, $message, $from);

?>