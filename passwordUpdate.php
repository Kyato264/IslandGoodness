<?php
session_start();
include ("dbConn.php");
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$currentPsw = validate($_POST['currentPsw']);
$newPsw = validate($_POST['newPsw']);
$reNewPsw = validate($_POST['reNewPsw']);

if (empty($currentPsw)) {
    header("Location: account.php?error=Please enter your current password");
    exit();
}

if (empty($newPsw)) {
    header("Location: account.php?error=Please enter your new password");
    exit();
}

if (empty($reNewPsw)) {
    header("Location: account.php?error=Please re-enter your new password");
    exit();
}

function is_valid_password($newPsw)
{
    // Minimum length of 8 characters
    $min_length = 8;

    // Check if the password meets the minimum length requirement
    if (strlen($newPsw) < $min_length) {
        header("Location: signup.php?error=New password must be at least 8 characters");
        exit();
    }

    // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
    if (!preg_match('/[A-Z]/', $newPsw)) {
        header("Location: signup.php?error=New password must contain at least one uppercase letter");
        exit();
    }

    if (!preg_match('/[a-z]/', $newPsw)) {
        header("Location: signup.php?error=New Password must contain at least one lowercase letter");
        exit();
    }

    if (!preg_match('/[0-9]/', $newPsw)) {
        header("Location: signup.php?error=New password must contain at least one number");
        exit();
    }

    if (!preg_match('/[^A-Za-z0-9]/', $newPsw)) {
        header("Location: signup.php?error=New password must contain at least one special character");
        exit();
    }
}

is_valid_password($newPsw);

$customerID = $_SESSION['CustomerID'];

$sql = "UPDATE customer 
        SET Password = '$newPsw'
        WHERE CustomerID = $customerID";
mysqli_query($conn, $sql);
header("Location: account.php?pass=Password updated!");
exit();
?>