<?php   
 session_start();
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "form";  
      
    $con = mysqli_connect ('localhost', 'root', '', 'form');  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
    // console.log("cnnetion good");
?>  