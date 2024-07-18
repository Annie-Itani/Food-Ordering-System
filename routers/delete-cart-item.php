<?php
include '../includes/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if itemId is set in GET
if (isset($_GET['item_id'])) {
    $itemId = $_GET['item_id'];

    $deleteQuery = "DELETE FROM cart WHERE item_id = ? AND user_id = ?";

    if ($stmt = mysqli_prepare($con, $deleteQuery)) {
        mysqli_stmt_bind_param($stmt, "ii", $itemId, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['icons']="./icons/success.png";
            $_SESSION['status']="success";
            $_SESSION['status_code']="Item Deleted From Cart";
            header("location: ../cart.php");
            exit();
        } else {
            $_SESSION['icons']="./icons/error.png";
            $_SESSION['status']="error";
            $_SESSION['status_code']="Error Deleting Item";
            header("location: ../cart.php");
            exit();
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['icons']="./icons/error.png";
		$_SESSION['status']="error";
		$_SESSION['status_code']="Error Deleting Item";
		header("location: ../cart.php");
		exit();
    }
} else {
    $_SESSION['icons']="./icons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="ID Not Provided";
    header("location: ../cart.php");
    exit();
}
?>
