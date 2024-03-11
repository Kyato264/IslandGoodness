<?php
    include("../dbConn.php");

    session_start();

    $cname = $_POST['cname'];
    $newName = $_POST['newName'];
    $newDescription = $_POST['newDescription'];
    $newPrice = $_POST['newPrice'];

    if(empty($cname)) {
        header("Location: updateMenu.php?error=Please enter an item name");
        exit();
    }elseif (empty($newName)) {
        header("Location: updateMenu.php?error=Please enter a new item name");
        exit();
    } elseif (empty($newDescription)) {
        header("Location: updateMenu.php?error=Please enter a new item description");
        exit();
    } elseif (empty($newPrice)) {
        header("Location: updateMenu.php?error=Please enter a new item price");
        exit();
    }

    $user_check_query = "SELECT * FROM fooditem WHERE Name='$cname' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $item = mysqli_fetch_assoc($result);

    if($item['Name'] != $cname) {
        header("Location: updateMenu.php?error=No item of that name found");
        exit();
    }

    $sql = "UPDATE fooditem
            SET Name = '$newName', Description = '$newDescription', Price = '$newPrice'
            WHERE Name = '$cname'";
    mysqli_query($conn, $sql);
    header("Location: updateMenu.php?pass=Item updated");
    exit();