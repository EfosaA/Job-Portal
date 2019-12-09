<?php

$email_address = $_GET['email_address'];



if(!empty($email_address)){
    
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    $SELECT = "SELECT seeker_id, first_name, last_name, age, resume FROM job_seeker WHERE email_address LIKE '".$email_address."'";
    $result = $conn->query($SELECT);
    
    if($result->num_rows > 0){
        
        echo"<table width=700 border=5>";
        echo"<tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Age</td><td>Resume</td><tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>{$row['seeker_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['age']}</td><td>{$row['resume']}</td><tr>";
        }
        echo"</table>";
        
        
        
    } else {
        echo "No Results.";
    }
    
    
    
    $conn->close();
    
}






?>