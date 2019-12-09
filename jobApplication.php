<?php
$job_id = $_POST['job_id'];
$seeker_id = $_POST['seeker_id'];
$applied_date = $_POST['applied_date'];
$resume = $_POST['resume'];



if(!empty($job_id) ||!empty($seeker_id) || !empty($applied_date) || !empty($resume)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    /*if(mysql_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else { */
    $SELECT = "SELECT application_id FROM applications WHERE application_id = ? Limit 1";
    $INSERT = "INSERT INTO applications (job_id, seeker_id, applied_date, resume) values(?, ?, ?, ?)";

    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $resume);
    $stmt->execute();
    $stmt->bind_result($resume);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum == 0){
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("iiss", $job_id, $seeker_id, $applied_date, $resume);
        $stmt->execute();
        header('Location: ./TheCarrieraProject/SignIn/homePage/homepage.html');
    } else {
        echo "You already applied!";
    }

    $stmt->close();
    $conn->close();
    //}
     
    
} else {
    echo "All fields are required";
    die();
}


?>