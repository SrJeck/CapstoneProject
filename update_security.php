<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=research","root","");

$id = $_SESSION['user_id'];
$oldPass = $dbh->prepare('select email_password from user where user_id=?');
$oldPass->bindParam(1, $id);
$oldPass->execute();
$oldPassRow = $oldPass->fetch();


if (isset($_POST['submit'])) {
  
     if(!empty($_POST['oldPass']) && !empty($_POST['newPass']) && !empty($_POST['confirmPass'])){
      
      $oldPass = $_POST['oldPass'];
      $newPass = $_POST['newPass'];
      $confirmPass = $_POST['confirmPass'];

      if ($oldPassRow["email_password"] == $oldPass) {
        if ($newPass == $confirmPass) {
          $stat = $dbh->prepare('UPDATE user SET email_password=? WHERE id=?');
          $stat->bindParam(1, $newPass);
          $stat->bindParam(2, $id);
          $stat->execute();
          header("Location: editprofile.php?user_id=".$id);
        }else{
          header("Location: editprofile.php?user_id=".$id);
        }
      }else{
        header("Location: editprofile.php?user_id=".$id);
      }

    }else{
      header("Location: editprofile.php?user_id=".$id);
    }
  }
?>
