<?php

$job_title = $_POST['job_title'];
$experience = $_POST['experience'];
$job_status = $_POST['job_status'];
$application_due = $_POST['application_due'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$company_id = $_POST['company_id'];
$salary = $_POST['salary'];

if(!empty($job_title) || !empty($experience) || !empty($job_status) || !empty($application_due) || !empty($street_address) || !empty($city) || !empty($state) || !empty($company_id) || !empty($salary)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    $SELECT = "SELECT job_id FROM jobs WHERE job_id = ? Limit 1";
    $INSERT = "INSERT INTO jobs (job_title, experience, job_status, application_due, street_address, city, state, company_id, salary) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $stmt->bind_result($company_id);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    
    if($rnum == 0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sisssssii", $job_title, $experience, $job_status, $application_due, $street_address, $city, $state, $company_id, $salary);
        $stmt->execute();
        
        header("Location: ./TheCarrieraProject/SignIn/homePage/new-post.html");
    } else{
        echo "error";
    }
    
    $stmt-close();
    $conn->close();
    
}else {
    echo "All fields are required";
    die();
}

?>