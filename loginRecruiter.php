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
    
    
    $SELECT = "SELECT email_address, password from recruiter WHERE email_address = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("ss", $email_address, $password);
    $stmt->execute();
    $stmt->bind_result($email_address, $password);
    $stmt->store_result();
    
    $result = $stmt->fetch();
   
    if($result){ //getting the contents of that row
        $_SESSION['login_user'] = $email_address;
        echo "success";
        header("location: ./TheCarrieraProject/SignIn/homePage/homepage.html");
    }
    else{
        echo "Invalid email address or password";
    }

    mysqli_close($conn);
}








?>