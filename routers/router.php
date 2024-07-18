<?php
include '../includes/connect.php';
$success = false;

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch the row using username only first
$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' and role='Administrator' AND not deleted;");

while ($row = mysqli_fetch_array($result)) {
	// Retrieve the original password from the database first
	$originalPassword = $row['password'];

	// Compare the hashes recieved from the form and the password retrieved from the database
	$passwordMatches  = password_verify($password, $originalPassword);


	if ($passwordMatches) {
		$success = true;
	} else {
		$success = false;
	}
	$user_id = $row['id'];
	$name = $row['name'];
	$role = $row['role'];
}
if ($success == true) {
	session_start();
	$_SESSION['admin_sid'] = session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;



	header("location: ../admin-page.php");
} else {

	$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' and role='Customer' AND not deleted;");
	while ($row = mysqli_fetch_array($result)) {
		
		// Retrieve the original password from the database first
		$originalPassword = $row['password'];

		// Compare the hashes recieved from the form and the password retrieved from the database
		$passwordMatches  = password_verify($password, $originalPassword);

		if ($passwordMatches) {
			$success = true;
		} else {
			$success = false;
		}

		$user_id = $row['id'];
		$name = $row['name'];
		$role = $row['role'];
	}
	if ($success == true) {
		session_start();
		$_SESSION['customer_sid'] = session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;

		$_SESSION['icons'] = "./icons/success.png";
		$_SESSION['status'] = "success";
		$_SESSION['status_code'] = "Loggedin Successfull";
		header("location: ../index.php");
		exit();
	} else {
		$_SESSION['icons'] = "./icons/error.png";
		$_SESSION['status'] = "error";
		$_SESSION['status_code'] = "Loggedin Failed";
		header("location: ../login.php");
		exit();
	}
}