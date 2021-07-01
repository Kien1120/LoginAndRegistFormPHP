<?php
session_start();
include 'DB_connect.php';


if(isset($_SESSION['username'])){
    header("location: home.php");
}

if(!isset($_GET['code'])){
    exit("Cant find page");
}

$code = $_GET['code'];
$getEmail = mysqli_query($conn, "SELECT  email FROM user_info WHERE Code = '$code'");

if(mysqli_num_rows($getEmail)==0){
    exit("Cant find page");
}
if(isset($_POST['Change'])){
    $row =mysqli_fetch_array($getEmail);
    $email = $row['email'];
    $pwd = mysqli_real_escape_string($conn, md5($_POST['pwd']));
    $n_pwd = mysqli_real_escape_string($conn, md5($_POST['n_pwd']));
    $cn_pwd = mysqli_real_escape_string($conn, md5($_POST['cn_pwd']));
    $t_pwd = mysqli_fetch_array(mysqli_query($conn, "SELECT  password FROM user_info WHERE email = '$email'"));
    $origin_pwd =$t_pwd['password'];
    


    if(($origin_pwd == $pwd) && ($n_pwd==$cn_pwd)){
        $stm = "UPDATE user_info SET password='$n_pwd' WHERE email='$email'";
        $result = mysqli_query($conn, $stm);
     
        if($result){
            echo "<script>alert('Passwword Updated')</script>";
            $result=mysqli_query($conn, "UPDATE user_info SET Code = NULL WHERE email='$email'");

        }else{
            echo "<script>alert('Something went wrong!')</script>";
        }

    }else{
        echo "<script>alert('Passwword didnt match')</script>";

    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Logout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Reset Password</div>
        <form action="" method="post">
            <div class="field">
                <input type="password" placeholder="Password"  name="pwd" required><br>
            </div>

            <div class="field">
                <input type="password" placeholder="New Password"  name="n_pwd" required><br>
            </div>

            <div class="field">
                <input type="password" placeholder="Confirm New Password"  name="cn_pwd" required><br>
            </div>


            <div class="field">
                <input name="Change" type="submit" value="Change Password">
            </div>

            <div class="back">
                <a  href="login.php">Login</a>
                <a  href="register.php">Register</a>
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