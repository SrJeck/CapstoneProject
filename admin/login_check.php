<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stat = $dbh->prepare('select * from admin where email=? and password=?');
        $stat->bindParam(1, $email);
        $stat->bindParam(2, $password);
        $stat->execute();
        $row = $stat->fetch();
        if (!empty($row)) {
            $id = $row['admin_id'];
            $_SESSION['admin_id'] = $id;
            header("Location: profile.php");
        } else {
            header("Location: index.php");
        }
    }
}
