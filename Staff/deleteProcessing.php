<?php
    include("../dbConn.php");

    session_start();

    $name = $_POST['name'];

    if(empty($name)) {
        header("Location: updateMenu.php?error=Please enter a valid name");
        exit();
    }

    $user_check_query = "SELECT * FROM fooditem WHERE Name='$name' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $item = mysqli_fetch_assoc($result);

    if($item['Name'] != $name) {
        header("Location: updateMenu.php?error=No item of that name found");
        exit();
    }

    $sql = "DELETE FROM fooditem
            WHERE Name = '$name'";
    mysqli_query($conn, $sql);
    header("Location: updateMenu.php?pass=Item deleted");
    exit();