<?php
//CONNECTION TO THE DATABASE DON'T TOUCH!!!
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "islandgoodness";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>