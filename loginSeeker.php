<?php

session_start();

$email_address = $_POST['email_address'];
$password = $_POST['password'];

if(!empty($email_address) || !empty($password)){
    
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    
    $SELECT = "SELECT email_address, password from job_seeker WHERE email_address = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("ss", $email_address, $password);
    $stmt->exexutre();
    $stmt->bind_result($email_address, $password);
    $stmt->store_result();
    
    if($stmt->fetch()){ //getting the contents of that row
        $_SESSION['login_user'] = $email_address;
        header("location: ./TheCarrieraProject/SignIn/homePage/homepage.html");
    }
    
    mysqli_close($conn);
}








?>