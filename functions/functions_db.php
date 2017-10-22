<?PHP

    if (file_exists("config/database.php"))
        include "config/database.php";
    else if (file_exists("../config/database.php"))
        include "../config/database.php";
    $dbsql = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbsql->query("USE camagru_db");
?>