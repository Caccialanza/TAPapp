<?php
    $host = "db";
    $root = "root";
    $root_password = "MYSQL_ROOT_PASSWORD";

    $dbname = "TAPdb"; //TAP = TasteAndPurchase

    try {
        $conn = new PDO("mysql:host=$host", $root, $root_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->query($sql);
        $conn->query("use $dbname");
        echo "Database $dbname created successfully<br>";
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }


?>