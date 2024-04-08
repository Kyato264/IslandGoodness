<?php
session_start();
include("dbConn.php");

$id = $_SESSION['CustomerID'];
$Latitude = $_POST['latitude'];
$Longitude = $_POST['longitude'];

// Quote string values in the SQL query
$query = "INSERT INTO orders (CustomerID, Latitude, Longitude) VALUES ('$id', '$Latitude', '$Longitude')";
mysqli_query($conn, $query);
$OrderID = mysqli_insert_id($conn);

$cart_query = "SELECT ItemID, Quantity FROM cart WHERE CustomerID = '$id'"; // Quote $id
$cart_result = mysqli_query($conn, $cart_query);

// Insert items from the cart into the orderitems table
while ($row = mysqli_fetch_assoc($cart_result)) {
    $item_id = $row['ItemID'];
    $quantity = $row['Quantity'];
    
    // Insert each item into the order_items table with the retrieved OrderID
    $insert_query = "INSERT INTO orderitems (OrderID, ItemID, Quantity) VALUES ('$OrderID', '$item_id', '$quantity')"; // Use $OrderID
    mysqli_query($conn, $insert_query);
}

$query = "DELETE FROM cart WHERE CustomerID = '$id'"; // Quote $id
mysqli_query($conn, $query);

header("Location: orderConfirmation.php");
exit();
?>
