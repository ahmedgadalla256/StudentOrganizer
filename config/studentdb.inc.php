<?php

$dsn = "mysql: host=localhost;dbname=studentdb";
$dbusername = "root";
$dbpassword = "";

try{
    $conn = new PDO($dsn, $dbusername, $dbpassword);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}

