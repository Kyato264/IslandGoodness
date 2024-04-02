<?php

include("dbConn.php");

if (isset($_POST['fname']) && 
    isset($_POST['lname']) && 
    isset($_POST['email']) &&
    isset($_POST['phoneNo']) &&    
    isset($_POST['psw'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = validate($_POST["fname"]);
    $lname = validate($_POST["lname"]);
    $email = validate($_POST["email"]);
    $phoneNo = validate($_POST["phoneNo"]);
    $pass = validate($_POST["psw"]);
    $pass2 = validate($_POST['repsw']);

    if (empty($fname)) {
        header("Location: signup.php?error=First name is required");
        exit();
    } else if (empty($lname)) {
        header("Location: signup.php?error=Last name is required");
        exit();
    } else if (empty($pass) || ($pass != $pass2) || empty($pass2)) {
        header("Location: signup.php?error=Valid password is required");
        exit();
    } else if (empty($email)) {
        header("Location: signup.php?error=Email is required");
        exit();
    } else if (empty($phoneNo)) {
        header("Location: signup.php?error=Phone number is required");
        exit();
    }

    function is_valid_password($pass) {
        // Minimum length of 8 characters
        $min_length = 8;
    
        // Check if the password meets the minimum length requirement
        if (strlen($pass) < $min_length) {
            header("Location: signup.php?error=Password must be at least 8 characters");
            exit();
        }
    
        // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
        if (!preg_match('/[A-Z]/', $pass)) {
            header("Location: signup.php?error=Password must contain at least one uppercase letter");
            exit();
        }

        if (!preg_match('/[a-z]/', $pass)) {
            header("Location: signup.php?error=Password must contain at least one lowercase letter");
            exit();
        }

        if (!preg_match('/[0-9]/', $pass)) {
            header("Location: signup.php?error=Password must contain at least one number");
            exit();
        }

        if (!preg_match('/[^A-Za-z0-9]/', $pass)) {
            header("Location: signup.php?error=Password must contain at least one special character");
            exit();
        }
    }

    is_valid_password($pass);

    $user_check_query = "SELECT * FROM customer WHERE Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);


    if ($user['Email'] == $email) {
        header("Location: signup.php?error=User already exists");
        exit();
    }

    $sql = "INSERT INTO customer (FirstName, LastName, Email, PhoneNo, Password) VALUES ('$fname', '$lname', '$email', '$phoneNo', '$pass')";
    mysqli_query($conn, $sql);
    header("Location: login.php?pass=New user created!");
    exit();
}

?>