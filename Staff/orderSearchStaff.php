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

    $matchedOrderIDs = array();

while ($row = mysqli_fetch_assoc($result)) {
    if (($row['OrderID'] == $searchTerm) || ($row['FullName'] == $searchTerm)) {
        $matchedOrderIDs[] = $row['OrderID'];
    }
}

// Redirect to search results if any matching orders found
if (!empty($matchedOrderIDs)) {
    // Serialize the array of matched order IDs
    $serializedOrderIDs = serialize($matchedOrderIDs);
    
    // Redirect to a search results page passing the serialized array
    header("Location:searchOrder.php?matchedOrderIDs=$serializedOrderIDs");
            exit();
        }
    }
    header("Location:searchOrder.php?error=No order found!");
    exit();
