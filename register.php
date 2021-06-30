<?php
include 'DB_connect.php';
if(isset($_POST['Submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $password = mysqli_real_escape_string($conn, md5($_POST['pwd']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['c_pwd']));

    $stm = "SELECT email FROM user_info WHERE email='$email'";
    $check_exist = mysqli_num_rows(mysqli_query($conn, $stm));
    if($password != $cpassword){
        echo "<script>alert('Password didn't match')</script>";
    }elseif($check_exist > 0){
        echo "<script>alert('Email exists, choose another')</script>";
    }else{
        $sql = "INSERT INTO user_info (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Submit and save to database Successfully!')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Logout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

    <div class="wrapper">
        <div class="title">Register Form</div>

        <form action="" method="post">
            <div class="field">
                <input type="text" placeholder="Username"  name="username" required><br>
            </div>

            <div class="field">
                <input type="email" placeholder="Email"  name="mail" required><br>
            </div>

            <div class="field">
                <input type="password" placeholder="Password"  name="pwd" required><br>
            </div>

            <div class="field">
                <input type="password" placeholder="Confirm Password"  name="c_pwd" required><br>
            </div>

 
            <div class="field">
                <input name="Submit" type="submit" value="Register">
            </div>
            <div class="signup-link">Have an account? <a href="login.php">Login here</a></div>
 
        </form>
    </div>
</body>

</html>