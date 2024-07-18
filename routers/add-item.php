<?php
include '../includes/connect.php';

$name = $_POST['name'];
$price = $_POST['price'];
$sql = "INSERT INTO items (name, price) VALUES ('$name', $price)";
$con->query($sql);

$_SESSION['icons']="./icons/success.png";
$_SESSION['status']="success";
$_SESSION['status_code']="Item Added.";

header("location: ../admin-page.php");
exit();
?>