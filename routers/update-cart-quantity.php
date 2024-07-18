<?php
include '../includes/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['item_id']) && isset($_GET['quantity'])) {
    $itemId = $_GET['item_id'];
    $quantity = $_GET['quantity'];

    $updateQuery = "UPDATE cart SET quantity = $quantity WHERE item_id = $itemId AND user_id = $user_id";
    
    if(mysqli_query($con, $updateQuery)) {
        $_SESSION['icons']="./icons/success.png";
		$_SESSION['status']="success";
		$_SESSION['status_code']="Item Quantity Updated";
        header("Location: ../cart.php");
        exit();
    } else {
        echo "Error updating quantity: " . mysqli_error($con);

        $_SESSION['icons']="./icons/error.png";
		$_SESSION['status']="error";
		$_SESSION['status_code']="Error Updating Cart.";
        header("Location: ../cart.php");
        exit();
    }
} else {
    echo "Item ID or quantity not provided";
}
?>
