<?php 
session_start();
include("dbConn.php");

if (isset($_SESSION['CustomerID'])) {
    $CustomerID = $_SESSION['CustomerID'];
    $ItemID = $_POST['ItemID'];
    $Quantity = $_POST['quantity'];

    $sql = "INSERT INTO cart (CustomerID, ItemID, Quantity) VALUES ('$CustomerID', '$ItemID', '$Quantity')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();
} else {
    header("Location: menuItemDetails.php?error=Please login in to order!");
}


