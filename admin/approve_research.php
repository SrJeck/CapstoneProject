<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];

$status = "Posted";
$approved = $dbh->prepare("update research set admin_id=?,upload_status=? where thesis_id=?");
$approved->bindParam(1, $status);
$approved->bindParam(2, $status);
$approved->bindParam(3, $thesis_id);
$approved->execute();
header("Location: pending_research.php");
?>