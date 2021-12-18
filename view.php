<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";

$view_count = $dbh->prepare('select view_count from research where id=?');
$view_count->bindParam(1, $id);
$view_count->execute();
$viewed_count = $view_count->fetch();

$increment = (int)$viewed_count['view_count'] + 1;
$update_count = $dbh->prepare('update research set view_count=? where id=?');
$update_count->bindParam(1,$increment , PDO::PARAM_INT);
$update_count->bindParam(2, $id);
$update_count->execute();

$stat = $dbh->prepare('select * from research where id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:' . $row['file_type']);
echo $row['file_upload'];

