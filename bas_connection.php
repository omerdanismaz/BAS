<?php

    include "bas_config.php";

    try
    {
        $dsn = "mysql:host={$cfg_servername};dbname={$cfg_database};charset=utf8mb4";
        $conn = new PDO($dsn, $cfg_username, $cfg_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        die("<h3 style ='font-family: Consolas'>(BAS) ---> (connection.php) ---> Unable to establish a connection to the database server. ---> " . $e->getMessage() . "</h3>");
    }

?>
