<?php

$job_title = $_GET['job_title'];
$job_title = strtolower($job_title);


if(!empty($job_title)){
    
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    $SELECT = "SELECT job_id, job_title, city, company_id, salary FROM jobs WHERE job_title LIKE '".$job_title."'";
    $result = $conn->query($SELECT);
    
    if($result->num_rows > 0){
        
        echo"<table width=700 border=5>";
        echo"<tr><td>ID</td><td>Job Title</td><td>City</td><td>Company #</td><td>Salary</td><tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>{$row['job_id']}</td><td>{$row['job_title']}</td><td>{$row['city']}</td><td>{$row['company_id']}</td><td>{$row['salary']}</td><tr>";
        }
        echo"</table>";
        
        
        
    } else {
        echo "No Results.";
    }
    
    $companyQuery = "SELECT * FROM company";
    $companyResult = $conn->query($companyQuery);
    
    echo"<table width=700 border=2 padding-top=10";
    echo"<tr><td>Company #</td><td>Company Name</td><tr>";
    while($cRow = $companyResult->fetch_assoc()){
        echo "<tr><td>{$cRow['company_id']}</td><td>{$cRow['company_name']}</td><tr>";
    }
    
    
    $conn->close();
    
}






?>