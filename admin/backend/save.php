<?php
include 'database.php';

if (count($_POST) > 0) {
	if ($_POST['type'] == 1) {
		$name = $_POST['title'];
		$email = $_POST['author'];
		$phone = $_POST['publication_year'];
		$city = $_POST['topic'];
		$sql = "INSERT INTO `research`( `title`, `author`,`publication_year`,`topic`) 
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
		$id = $_POST['id'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$publication_year = $_POST['publication_year'];
		$topic = $_POST['topic'];
		$sql = "UPDATE `research` SET `title`='$title',`author`='$author',`publication_year`='$publication_year',`topic`='$topic' WHERE id=$id";
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
		$id = $_POST['id'];
		$sql = "DELETE FROM `research` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if (count($_POST) > 0) {
	if ($_POST['type'] == 4) {
		$id = $_POST['id'];
		$sql = "DELETE FROM research WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
