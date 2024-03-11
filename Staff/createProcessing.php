<?php
    include("../dbConn.php");

    session_start();

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if(empty($name)) {
        header("Location: updateMenu.php?error=Please enter an item name");
        exit();
    } elseif (empty($description)) {
        header("Location: updateMenu.php?error=Please enter item description");
        exit();
    } elseif (empty($price)) {
        header("Location: updateMenu.php?error=Please enter item price");
        exit();
    }

    $user_check_query = "SELECT * FROM fooditem WHERE Name='$name' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $item = mysqli_fetch_assoc($result);

    if($item['Name'] == $name) {
        header("Location: updateMenu.php?error=Item already exists.");
        exit();
    }

    $sql = "INSERT INTO fooditem (Name, Description, Price) VALUES ('$name', '$description', '$price')";
    mysqli_query($conn, $sql);
    header("Location: updateMenu.php?pass=New item created");
    exit();

