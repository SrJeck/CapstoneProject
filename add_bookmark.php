<?php
session_start();

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

$stat = $dbh->prepare('select * from bookmark where user_id=? and id=?');
$stat->bindParam(1, $user_id);
$stat->bindParam(2, $id);
$stat->execute();
$row = $stat->fetch();


if (empty($row)) {
    $stmt = $dbh->prepare("insert into bookmark values(?,?)");
    $stmt->bindParam(1, $user_id);
    $stmt->bindParam(2, $id);
    $stmt->execute();
    header("Location: display.php?id=" . $id);
}
