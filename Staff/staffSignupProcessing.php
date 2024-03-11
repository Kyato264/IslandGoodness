<?php

include("../dbConn.php");

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["uname"]);
    $pass = validate($_POST["psw"]);
    $pass2 = validate($_POST['repsw']);
    $position = validate($_POST['position']);

    if (empty($uname)) {
        header("Location: staffSignup.php?error=Username is required");
        exit();
    } else if (empty($pass) || ($pass != $pass2) || empty($pass2)) {
        header("Location: staffSignup.php?error=Valid password is required");
        exit();
    } else if (empty($position)) {
        header("Location: staffSignup.php?error=Please select a position");
        exit();
    }

    $user_check_query = "SELECT * FROM staff WHERE username='$uname' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);


    if ($user['username'] == $uname) {
        header("Location: staffSignup.php?error=User already exists");
        exit();
    }

    $sql = "INSERT INTO staff (UserName, UserPassword, Position) VALUES ('$uname', '$pass', '$position')";
    mysqli_query($conn, $sql);
    header("Location: staffLogin.php?pass=New User Created");
    exit();
}

?>