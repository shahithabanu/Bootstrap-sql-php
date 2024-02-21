
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connect.php'); 

    
    $error = array();

  

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
          $error['waring']="<h1> Login failed. Invalid email or password.</h1>";  
    }  
        
        }

        $_SESSION["error"] =  $error;
       // print_r( $_SESSION);exit;
        header("Location: login.php");

    }     



?>
