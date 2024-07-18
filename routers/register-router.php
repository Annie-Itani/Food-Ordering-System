<?php
include '../includes/connect.php';

$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];

// Hash the password before registering
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

function number($length)
{
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

$sql = "INSERT INTO users (name, username, password, contact) VALUES ('$name', '$username', '$hashedPassword', $phone)";
if ($con->query($sql) == true) {
    $user_id =  $con->insert_id;
    $sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
    if ($con->query($sql) == true) {
        $wallet_id =  $con->insert_id;
        $cc_number = number(16);
        $cvv_number = number(3);
        $sql = "INSERT INTO wallet_details(wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
        $con->query($sql);
    }

    $_SESSION['icons'] = "./icons/success.png";
    $_SESSION['status'] = "success";
    $_SESSION['status_code'] = "Registered Successfull. Please Login";
    header("location: ../register.php");
    exit();
} else {
    $_SESSION['icons'] = "./icons/success.png";
    $_SESSION['status'] = "error";
    $_SESSION['status_message'] = "Registration Failed. Please try again.";
    header("location: ../register.php");
    exit();
}
