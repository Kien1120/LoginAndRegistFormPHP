<?php
session_start();
include 'DB_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_SESSION['username'])){
    header("location: home.php");
}
if(isset($_POST['Reset'])){
    $email = mysqli_real_escape_string($conn, $_POST['mail']); 
    $stm = "SELECT email FROM user_info WHERE email='$email'";
    $result = mysqli_query($conn, $stm);
 
    if( mysqli_num_rows($result)>0){
        $emailTo = mysqli_real_escape_string($conn, $_POST['mail']); 
        $code = uniqid(true);
        $stm2 = "UPDATE user_info SET Code = '$code' WHERE email='$emailTo'"; ///////

        $query = mysqli_query($conn,  $stm2);

        $reset_url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset_pwd.php?code=$code";
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            
            $mail->isSMTP();                                        
            $mail->Host       = "smtp.gmail.com";                    
            $mail->SMTPAuth   = true;                                 
            $mail->Username   = "nguyenduykien1120@gmail.com";            
            $mail->Password   = "Ki11112000";                           
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          
            $mail->Port       = "587";                                    
            $mail->setFrom("nguyenduykien1120@gmail.com");
            $mail->addAddress("$emailTo");     
            //$mail->addAddress('ellen@example.com');              
            $mail->addReplyTo('no-reply@gmail.com', 'No-reply');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //$mail->addAttachment('/var/tmp/file.tar.gz');         
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

            $mail->isHTML(true);                                 
            $mail->Subject = 'PASSWORD RESET MESSAGE';
            $mail->Body    = "<h1>You requested reset password</h1>Click <a href='$reset_url'>this link</a> to do it";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->Send();
            echo "<script>alert('Message has been sent')</script>";
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $mail->smtpClose();
    }else{
        echo "<script>alert('Email doesn't exist on our system, choose another')</script>";
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
                <input type="email" placeholder="Email"  name="mail" required><br>
            </div>

            <div class="field">
                <input name="Reset" type="submit" value="Send Verification Link">
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