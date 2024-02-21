<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    form {
      
    }
</style>
</head>

<body>
    

<?php

include('connect.php'); 


    $error = array();

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($_POST["email"])){
            $error['email'] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] = "Invalid email format";
        }
        

        if (empty($password)){
            $error['password'] = "Password is required";
        } elseif(strlen($password) < 6){
            $error['password'] = "Password must be at least 6 characters";
        }

        if (empty($error)) {
            // header("Location: authenticate.php?");

    $email = stripcslashes($email);  
    $password = stripcslashes($password);  
    $email = mysqli_real_escape_string($con, $email);  
    $password = mysqli_real_escape_string($con, $password);  
      
    $sql = "SELECT * FROM formval WHERE email = '$email' AND password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
      
    if ($count == 1) {  
        // Redirect to dashboard if login is successful
        header("Location: dashboard.php");
        exit();
    } else {  
        // Display error message if login fails
        echo "<h1> Login failed. Invalid email or password.</h1>";  
    }  
            exit(); 
        }
    } 
    
   if(isset($_SESSION['error'])){

    $error = $_SESSION['error'];
   }

    ?>


    <form method="post" action="authenticate.php" class="form-group mt-5" >
    <div class="container">

    <div class="row">
    <div class="col-md-6 offset-md-3">    

    <h2 class="text-center">Form validation </h2>
    Email: <br> <input type="text" name="email" class="form-control">
    <span class="error text-danger" >
    <?php if(isset($error['email'])) echo $error['email']; ?>
    </span><br>

    Password: <br>
    <input type="password" id="password" name="password" class="form-control">
    <span class="error text-danger">
    <?php if(isset($error['password'])) echo $error['password']; ?>
    </span><br>

    <input type="submit" name="submit" value="Submit" class="btn btn-success"></div></div></div>
    </form>
    
    
</body>
</html>
