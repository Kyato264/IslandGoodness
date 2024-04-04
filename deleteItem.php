<?php
session_start();
include ("dbConn.php");

echo $_GET['CartID'];

if(isset($_GET['CartID'])) {
    $encodedCartID = $_GET['CartID'];
    $CartID = urldecode($encodedCartID);
    $CustomerID = $_SESSION['CustomerID'];

    if(empty($CartID)) {
        header("Location: cart.php?error=no cartID");
        exit();
    }

    if(empty($CustomerID)) {
        header("Location: cart.php?error=no CustomerID");
        exit();
    }

    $sql = "DELETE FROM cart
        WHERE CartID = '$CartID' AND CustomerID = '$CustomerID'";
    mysqli_query($conn, $sql);
    header("Location: cart.php?pass=Item deleted");
    exit();

}