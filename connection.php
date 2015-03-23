
<?php

$servername = "localhost:3306/";
$username = "root";
$sqlpassword = "";
$dbname = "ibctimesheet";

// Create connection
$conn = mysqli_connect($servername, $username, $sqlpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>