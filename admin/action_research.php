<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];

if (!empty($_POST['select'])) {
  $user_id = $_POST['user'];
  $select = $_POST['select'];
  $thesis_id = $_POST['thesis'];
  if ($select == "Approve") {
    $selecting = $dbh->prepare("select * notification where thesis_id=? and status='Approved'");
    $selecting->bindParam(1, $thesis_id);
    $selecting->execute();
    $selected = $selecting->fetch();
    if (empty($selected)) {
      $status = "Posted";
      $approved = $dbh->prepare("update research set admin_id=?,upload_status=? where id=?");
      $approved->bindParam(1, $admin_id);
      $approved->bindParam(2, $status);
      $approved->bindParam(3, $thesis_id);
      $approved->execute();
      
      $reason = "Congratulations";
      $seen_stat = "unseen";
      $accepted = $dbh->prepare("insert into notification values(?,?,?,?,?,?)");
      $accepted->bindParam(1, $user_id);
      $accepted->bindParam(2, $admin_id);
      $accepted->bindParam(3, $thesis_id);
      $accepted->bindParam(4, $select);
      $accepted->bindParam(5, $reason);
      $accepted->bindParam(6, $seen_stat);
      $accepted->execute();
      header("Location: pending_research.php");
    }
  }else{
    $selecting = $dbh->prepare("select * notification where thesis_id=? and status='Rejected'");
    $selecting->bindParam(1, $thesis_id);
    $selecting->execute();
    $selected = $selecting->fetch();
    if (empty($selected)) {
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
    }else{
      if (!empty($_POST['reason'])) {
        $reason = $_POST['reason'];
        $seen_stat = "unseen";
        $rejected = $dbh->prepare("update notification set reason=?,seen_status=? where thesis_id=?");
        $rejected->bindParam(1, $reason);
        $rejected->bindParam(2, $seen_stat);        
        $rejected->bindParam(3, $thesis_id);
        $rejected->execute();
        header("Location: pending_research.php");
      }
    }
    
  }
  
  
}


  
