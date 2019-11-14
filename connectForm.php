<?php
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$emailaddress = $_POST['email_address'];
$password = $_POST['password'];
$resume = $_POST['resume'];


if(!empty($firstname) || !empty($lastname) || !empty($age) || !empty($gender) || !empty($birthday) || !empty($emailaddress) || !empty($password) || !empty($resume)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    /*if(mysql_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else { */
    $SELECT = "SELECT email_address FROM job_seeker WHERE email_address = ? Limit 1";
    $INSERT = "INSERT INTO job_seeker (first_name, last_name, age, gender, birthday, email_address, password, resume) values(?, ?, ?, ?, ?, ?, ?, ?)";

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
        $stmt->bind_param("ssisssss", $firstname, $lastname, $age, $gender, $birthday, $emailaddress, $password, $resume);
        $stmt->execute();
        header('Location: ./TheCarrieraProject/SignIn/homePage/homepage.html');
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