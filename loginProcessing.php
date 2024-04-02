<?php
session_start();
include("dbConn.php");

if (isset($_POST["email"]) && isset($_POST["psw"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST["email"]);
    $pass = validate($_POST["psw"]);

    if (empty($email)) {
        header("Location: login.php?error=Username is required");
        exit();
    } else if (empty($pass) || ($pass != $pass) ) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE Email = '$email' AND Password = '$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['Email'] === $email && $row['Password'] === $pass){
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['PhoneNo'] = $row['PhoneNo'];
                $_SESSION['LastName'] = $row['LastName'];
                $_SESSION['FirstName'] = $row['FirstName'];
                $_SESSION['CustomerID'] = $row['CustomerID'];
                header("Location: index.php");
                exit();
            } 
        } else {
            header("Location: login.php?error=Invalid User name or password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}