<?php
session_start();
$admin_id = $_SESSION['admin_id'];
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

if (!empty($_POST['reply'])) {
    
$inquiry_id = $_POST['inquiry_id'];
$replay = $_POST['reply'];
$curr_date = date("Y-n-d");
$stat = $dbh->prepare("update inquiry set admin_id=?,reply=?,reply_date=? where inquiry_id=?");
$stat->bindParam(1, $admin_id);
$stat->bindParam(2, $replay);
$stat->bindParam(3, $curr_date);
$stat->bindParam(4, $inquiry_id);
$stat->execute();
header("Location: inquiries.php");
}

?>