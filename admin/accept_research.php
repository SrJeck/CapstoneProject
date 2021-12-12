<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];
$id = $_GET['id'];
$status = "posted";
  $stat = $dbh->prepare("update research set admin_id=?,upload_status=? where id=?");
      $stat->bindParam(1, $admin_id);
      $stat->bindParam(2, $status);
      $stat->bindParam(3, $id);
      $stat->execute();
      header("Location: admin.php");
  
?>