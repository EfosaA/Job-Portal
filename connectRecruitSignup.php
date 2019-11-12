<?php
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$emailaddress = $_POST['email_address'];
$password = $_POST['password'];


if(!empty($firstname) || !empty($lastname) || !empty($emailaddress) || !empty($password)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    /*if(mysql_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else { */
    $SELECT = "SELECT email_address FROM recruiter WHERE email_address = ? Limit 1";
    $INSERT = "INSERT INTO recruiter (first_name, last_name, email_address, password) values(?, ?, ?, ?)";

    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $emailaddress);
    $stmt->execute();
    $stmt->bind_result($emailaddress);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum == 0){
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssss", $firstname, $lastname, $emailaddress, $password);
        $stmt->execute();
        echo "New record successfully inserted into DB!";
    } else {
        echo "Someone already registered with that email";
    }

    $stmt->close();
    $conn->close();
    //}
     
    
} else {
    echo "All fields are required";
    die();
}


?>