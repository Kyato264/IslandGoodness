<?php
include ("../dbConn.php");

session_start();

if (isset($_POST['name'])) {
    $searchTerm = $_POST['name'];

    $sql = "SELECT 
        orders.OrderID,
        customer.CustomerID,
        CONCAT(customer.FirstName, ' ', customer.LastName) AS FullName
        FROM orders
        INNER JOIN customer ON customer.CustomerID = orders.CustomerID";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        if (($row['OrderID'] == $searchTerm) || ($row['FullName'] == $searchTerm)) {
            $OrderID = $row['OrderID'];
            header("Location:searchResult.php?$OrderID");
            exit();
        }
    }
    header("Location:searchResult.php?error=No order found!");
    exit();
}