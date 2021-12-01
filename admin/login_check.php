<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stat = $dbh->prepare('select * from user where email_address=? and email_password=?');
        $stat->bindParam(1, $email);
        $stat->bindParam(2, $password);
        $stat->execute();
        $row = $stat->fetch();
        if (!empty($row)) {
            $id = $row['user_id'];
            $_SESSION['user_id'] = $id;
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
    }
}
