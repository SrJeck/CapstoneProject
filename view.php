<?php
$dbh = new PDO("mysql:host=localhost;dbname=research", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";
$stat = $dbh->prepare('select * from research where id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:' . $row['file_type']);
echo $row['file_upload'];