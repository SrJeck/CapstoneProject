<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");
$id = $_SESSION['admin_id'];

$name = $_FILES['myfile']['name'];
$type = $_FILES['myfile']['type'];
$path = $_FILES['myfile']['tmp_name'];
$data = file_get_contents($_FILES['myfile']['tmp_name']);

$test = getimagesize($path);
$width = $test[0];
$height = $test[1];

if ($width > ($height * 2) || $width > $height)
{
$stat = $dbh->prepare("insert into banner values('',?,?,?,?,'')");
$stat->bindParam(1, $name);
$stat->bindParam(2, $type);
$stat->bindParam(3, $data);
$stat->bindParam(4, $id);
$stat->execute();
}



header("Location: settings.php");
?>