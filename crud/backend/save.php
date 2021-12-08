<?php
include 'database.php';

if (count($_POST) > 0) {
	if ($_POST['type'] == 1) {
		$name = $_POST['firstName'];
		$email = $_POST['email_address'];
		$phone = $_POST['contactNumber'];
		$city = $_POST['homeAddress'];
		$sql = "INSERT INTO `user`( `firstName`, `email_address`,`contactNumber`,`homeAddress`) 
		VALUES ('$name','$email','$phone','$city')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if (count($_POST) > 0) {
	if ($_POST['type'] == 2) {
		$user_id = $_POST['user_id'];
		$firstName = $_POST['firstName'];
		$email_address = $_POST['email_address'];
		$contactNumber = $_POST['contactNumber'];
		$homeAddress = $_POST['homeAddress'];
		$sql = "UPDATE user SET firstName='$firstName',email_address='$email_address',contactNumber='$contactNumber',homeAddress='$homeAddress' WHERE user_id=$user_id";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if (count($_POST) > 0) {
	if ($_POST['type'] == 3) {
		$user_id = $_POST['user_id'];
		$sql = "DELETE FROM `user` WHERE user_id=$user_id ";
		if (mysqli_query($conn, $sql)) {
			echo $user_id;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if (count($_POST) > 0) {
	if ($_POST['type'] == 4) {
		$user_id = $_POST['user_id'];
		$sql = "DELETE FROM user WHERE user_id in ($user_id)";
		if (mysqli_query($conn, $sql)) {
			echo $user_id;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
