<?php
$host = "localhost";
$user = "root";       // default XAMPP username
$password = "";       // default XAMPP password
$dbname = "myapp_db";

// Create connection
$connect = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
