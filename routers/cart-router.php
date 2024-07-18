<?php

include '../includes/connect.php';
session_start();

if (isset($_POST['id'])) {
    $itemId = $_POST['id'];
    $userId = $_SESSION['user_id'];

    $checkQuery = "SELECT * FROM cart WHERE item_id = ? AND user_id = ?";
    $stmt = $con->prepare($checkQuery);
    $stmt->bind_param("ii", $itemId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE item_id = ? AND user_id = ?";
        $stmt = $con->prepare($updateQuery);
        $stmt->bind_param("ii", $itemId, $userId);
        $stmt->execute();
        
        $_SESSION['icons']="./icons/success.png";
		$_SESSION['status']="success";
		$_SESSION['status_code']="Item Added To Cart";
		header("location: ../index.php");
		exit();
    } else {
        $insertQuery = "INSERT INTO cart (user_id, item_id, quantity) VALUES (?, ?, 1)";
        $stmt = $con->prepare($insertQuery);
        $stmt->bind_param("ii", $userId, $itemId);
        $stmt->execute();

        $_SESSION['icons']="./icons/success.png";
		$_SESSION['status']="success";
		$_SESSION['status_code']="Item Added To Cart";
		header("location: ../index.php");
		exit();
    }

    $_SESSION['icons']="./icons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="Error Adding Item To Cart";
    header("location: ../index.php");
    exit();
}


?>