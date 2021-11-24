<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=research","root","");

$id = $_SESSION['user_id'];
$stat = $dbh->prepare('select * from user where user_id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
$mName = "";
$lName = "";
$phoneNum = "";
$degree = "";
$houseNo = "";
$street = "";
$barangay = "";
$municipality = "";
$province = "";
$address = "";

if (isset($_POST['submit'])) {

  $fName = empty($_POST['firstName']) ? $row['firstName'] : $_POST['firstName'];
  $mName = empty($_POST['middleName']) ? $row['middleName'] : $_POST['middleName'];
  $lName = empty($_POST['lastName']) ? $row['lastName'] : $_POST['lastName'];
  $phoneNum = empty($_POST['contactNum']) ? $row['contactNumber'] : $_POST['contactNum'];
  
  
  $stat = $dbh->prepare("update user set firstName=?,middleName=?,lastName=?,phoneNum=?,degree_status=?,homeAddress=? where id=?");
      $stat->bindParam(1, $fName);
      $stat->bindParam(2, $mName);
      $stat->bindParam(3, $lName);
      $stat->bindParam(4, $phoneNum);
      $stat->bindParam(5, $id);
      $stat->execute();
      header("Location: profile.php");
  }
?>
