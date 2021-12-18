<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";


$download_count = $dbh->prepare('select download_count from research where id=?');
$download_count->bindParam(1, $id);
$download_count->execute();
$downloaded_count = $download_count->fetch();

$increment = (int)$downloaded_count['download_count'] + 1;
$update_count = $dbh->prepare('update research set download_count=? where id=?');
$update_count->bindParam(1,$increment , PDO::PARAM_INT);
$update_count->bindParam(2, $id);
$update_count->execute();


$stat = $dbh->prepare('select * from research where id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();


$base64 = base64_encode($row['file_upload']);
$binary = base64_decode($base64);
file_put_contents($row['file_name'], $binary);
header('Content-type:' . $row['file_type']);
header('Content-Disposition: attachment; filename="' . $row['file_name'] . '"');
echo $binary;
