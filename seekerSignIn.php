<?php
session_start(); //start a session
$error = ""; //error msg init

if(isset($_POST['submit'])) { //if user hits submit
    if(empty($_POST['email_address']) || empty($_POST['password'])) {
        $error = "Email or Password is invalid";
    }
    else{
        $emailaddress = ['emailaddress'];
        $password = ['password'];
        
        $conn = mysqli_connect("localhost", "root", "", "JobPortal");
        
        $query = "SELECT email_address, password FROM job_seeker WHERE email_address=? AND password=? LIMIT 1";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $emailaddress, $password);
        $stmt->execute();
        $stmt->bind_result();
        $stmt->store_result();
        echo "You signed in";
        if($stmt->fetch()){
            $_SESSION['login_user'] = $emailaddress;
            header("location: landingPage.html");
        }
        mysqli_close($conn);
    }
}




?>