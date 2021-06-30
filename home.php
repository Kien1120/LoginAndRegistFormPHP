<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simple Calculator</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style3.css">


</head>

<body>

    <?php
    if(isset($_SESSION['username'])){
    ?>
        <div class="head">Welcome <span><?php echo $_SESSION['username']; ?></span> to ALfheim World</div>
        <a class="btn" href="logout.php" title="Logout">Logout</a>
    <?php
    }else{
        header('location: login.php');
    } 
    ?>


</body>

</html>