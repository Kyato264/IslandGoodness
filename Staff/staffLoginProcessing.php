<?php
session_start();
include("../dbConn.php");

if (isset($_POST["uname"]) && isset($_POST["psw"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["uname"]);
    $pass = validate($_POST["psw"]);

    if (empty($uname)) {
        header("Location: staffLogin.php?error=Username is required");
        exit();
    } else if (empty($pass) || ($pass != $pass) ) {
        header("Location: staffLogin.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM staff WHERE UserName = '$uname' AND UserPassword = '$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['UserName'] === $uname && $row['UserPassword'] === $pass){
                $_SESSION['UserName'] = $row['UserName'];
                $_SESSION['Position'] = $row['Position'];
                $_SESSION['StaffID'] = $row['StaffID'];
                header("Location: staffHome.php");
                exit();
            } 
        } else {
            header("Location: staffLogin.php?error=Invalid User name or password");
            exit();
        }
    }
} else {
    header("Location: staffLogin.php");
    exit();
}