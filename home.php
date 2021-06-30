<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simple Calculator</title>
    <meta charset="utf-8">

</head>

<body>

    <?php
    if(isset($_SESSION['username'])){
        ?>
        Welcome USER: <span style="font-weight:bold; color:firebrick;"><?php echo $_SESSION['username']; ?>
        </span>. Click here to <a href="logout.php" title="Logout">Logout
    <?php
    }else{
        header('location: login.php');
    } 
    ?>


</body>

</html>