<?php
    include("../dbConn.php");

    session_start();

    $orderID = $_POST['OrderID'];

    $sql="UPDATE orders SET Status = 'completed', CompletedTime = NOW()
        WHERE OrderID = $orderID";
    
    mysqli_query($conn, $sql);
    header("Location: staffHome.php");
    exit();