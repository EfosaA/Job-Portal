<?php

$applied_date = $_GET['applied_date'];



if(!empty($applied_date)){
    
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "jobPortal";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    
    $SELECT = "SELECT s.seeker_id, s.first_name, s.last_name, s.age, s.resume FROM job_seeker as s JOIN applications as a  WHERE s.seeker_id = a.seeker_id";
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