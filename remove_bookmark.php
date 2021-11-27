<?php
session_start();

$user_id = $_SESSION['user_id'];
$thesis_id = $_GET['thesis_id'];
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
//$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

$stat = $dbh->prepare('select * from bookmark where user_id=? and thesis_id=?');
$stat->bindParam(1, $user_id);
$stat->bindParam(2, $thesis_id);
$stat->execute();
$row = $stat->fetch();


if (!empty($row)) {
    $stmt = $dbh->prepare("delete from bookmark where thesis_id=?");
    $stmt->bindParam(1, $thesis_id);
    $stmt->execute();
    header("Location: bookmark.php");
}
