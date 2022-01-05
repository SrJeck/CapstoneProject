<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$id = $_POST['banner'];

$stat = $dbh->prepare("update banner set select_status='selected' where banner_id=?");
$stat->bindParam(1, $id);
$stat->execute();
$stat2 = $dbh->prepare("update banner set select_status='unselected' where banner_id!=?");
$stat2->bindParam(1, $id);
$stat2->execute();

?>