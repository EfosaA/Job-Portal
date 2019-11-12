<?php

$dsn = "mysql:host=localhost;dbname=jobPortal";
$username = "root";
$password = "";

try{
    $db = new PDO($dsn, $username, $password);
    echo "Efosa, you connected!";
}catch(PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}

 
?>