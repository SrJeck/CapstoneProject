<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$user_id = $_SESSION['user_id'];
if (isset($_POST['send'])) {
    if (!empty($_POST['email']) && !empty($_POST['subject'])  && !empty($_POST['message']) ) {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $stmt = $dbh->prepare("insert into inquiry values('',?,'',?,?,?,'')");
        $stmt->bindParam(1,$user_id);
        $stmt->bindParam(2,$subject);
        $stmt->bindParam(3,$message);
        $stmt->bindParam(4,$email);
        $stmt->execute();
        header("Location: contact_us.php");
    }
}
?>