<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];

if (!empty($_POST['select'])) {
  $user_id = $_POST['user'];
  $select = $_POST['select'];
  $thesis_id = $_POST['thesis'];
  if ($select == "Approve") {
      $status = "Posted";
      $approved = $dbh->prepare("update research set admin_id=?,upload_status=? where id=?");
      $approved->bindParam(1, $admin_id);
      $approved->bindParam(2, $status);
      $approved->bindParam(3, $thesis_id);
      $approved->execute();
      header("Location: pending_research.php");
  }else{
    if (!empty($_POST['reason'])) {
      $reason = $_POST['reason'];
      $seen_stat = "unseen";
      $rejected = $dbh->prepare("insert into notification values(?,?,?,?,?,?)");
      $rejected->bindParam(1, $user_id);
      $rejected->bindParam(2, $admin_id);
      $rejected->bindParam(3, $thesis_id);
      $rejected->bindParam(4, $select);
      $rejected->bindParam(5, $reason);
      $rejected->bindParam(6, $seen_stat);
      $rejected->execute();
      header("Location: pending_research.php");
    }
  }
  
  
}


  
