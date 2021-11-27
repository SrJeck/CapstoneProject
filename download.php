<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";
$stat = $dbh->prepare('select * from journal where id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();


$base64 = base64_encode($row['file_upload']);
$binary = base64_decode($base64);
file_put_contents($row['file_name'], $binary);
header('Content-type:' . $row['file_type']);
header('Content-Disposition: attachment; filename="' . $row['file_name'] . '"');
echo $binary;
