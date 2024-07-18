<?php

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = mysqli_query($con, "SELECT * FROM wallet where customer_id = $user_id");
$wallet_id = null;
while($row1 = mysqli_fetch_array($sql)){
    $wallet_id = $row1['id'];
}

if($wallet_id) {
    $sql = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
    $balance = null;
    while($row1 = mysqli_fetch_array($sql)){
        $balance = $row1['balance'];
    }

} else {
    echo "Wallet not found for user.";
}
?>
