<?php
session_start();
include 'DB_connect.php';
if(isset($_POST['Login'])){
    $email = $_POST['mail'];
    $password = md5($_POST['pwd']);

    $stm = "SELECT * FROM user_info WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $stm);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username']=$row['username'];
        header("location: home.php");
    }else{
        echo "<script>alert('Email or password is wrong!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Logout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Login Form</div>
        <form action="" method="post">
            <div class="field">
                <input type="email" placeholder="Email"  name="mail" required><br>
            </div>

            <div class="field">
                <input type="password" placeholder="Password"  name="pwd" required><br>
            </div>

            <div class="field">
                <input name="Login" type="submit" value="Login">
            </div>

            <div class="forget-pwd"> 
                <a href="forget_pwd.php">Forget password?</a>
            </div>

            <div class="signup-link">Not a member? 
                <a href="register.php">Signup now</a>
            </div>
        </form>
    </div>
</body>



<script>
$(document).ready(function(){  
    $(".wrapper").slideDown(1000);
});
$(document).ready(function(){  
    $("body, html").animate({
        opacity: '1'
    }, 1200);
});
</script>
</html>