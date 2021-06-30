<?php
$servername = "127.0.0.2:3307";
$username = "root";
$password = "";
$db_name = "users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>