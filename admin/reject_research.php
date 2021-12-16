<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];
$id = $_GET['id'];


  $stat = $dbh->prepare("delete from research WHERE id=?");
      $stat->bindParam(1, $id);
      $stat->execute();
      header("Location: test.php");
