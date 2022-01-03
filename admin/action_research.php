<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$admin_id = $_SESSION['admin_id'];

if (!empty($_POST['select'])) {
  $user_id = $_POST['user'];
  $select = $_POST['select'];
  $thesis_id = $_POST['thesis'];
  $seen_stat = "unseen";
  if ($select == "Approve") {
    
      $status = "Posted";
      $approved = $dbh->prepare("update research set admin_id=?,upload_status=? where id=?");
      $approved->bindParam(1, $admin_id);
      $approved->bindParam(2, $status);
      $approved->bindParam(3, $thesis_id);
      $approved->execute();
      
      $notifs = $dbh->prepare("select * from notifications where thesis_id=? and status='Approve'");
      $notifs->bindParam(1, $thesis_id);
      $notifs->execute();
      $notif =$notifs->fetch();
      if (empty($notif)) {
        $reason = "Congratulations";
        $accepted = $dbh->prepare("insert into notification values('',?,?,?,?,?,?,'')");
        $accepted->bindParam(1, $user_id);
        $accepted->bindParam(2, $admin_id);
        $accepted->bindParam(3, $thesis_id);
        $accepted->bindParam(4, $select);
        $accepted->bindParam(5, $reason);
        $accepted->bindParam(6, $seen_stat);
        $accepted->execute();
        header("Location: pending_research.php");
      }
      header("Location: pending_research.php");
    
  }else{
      $notifs = $dbh->prepare("select * from notification where thesis_id=? and status='Reject'");
      $notifs->bindParam(1, $thesis_id);
      $notifs->execute();
      $notif =$notifs->fetch();
      if (empty($notif)) {
        if (!empty($_POST['reason'])) {
          $reason = $_POST['reason'];
          $rejected = $dbh->prepare("insert into notification values('',?,?,?,?,?,?,'')");
          $rejected->bindParam(1, $user_id);
          $rejected->bindParam(2, $admin_id);
          $rejected->bindParam(3, $thesis_id);
          $rejected->bindParam(4, $select);
          $rejected->bindParam(5, $reason);
          $rejected->bindParam(6, $seen_stat);
          $rejected->execute();
        }
      }else{
        $notif_id = $notif['notification_id'];
        if (!empty($_POST['reason'])) {
          $reason = $_POST['reason'];
          $curr_date = date("Y-n-d");
          $rejected = $dbh->prepare("update notification set admin_id=?,reason=?,seen_status=?,notification_date=? where notification_id=?");
          $rejected->bindParam(1, $admin_id);
          $rejected->bindParam(2, $reason);
          $rejected->bindParam(3, $seen_stat);
          $rejected->bindParam(4, $curr_date);
          $rejected->bindParam(5, $notif_id);
          $rejected->execute();
        }
      }
    header("Location: pending_research.php");
  }
}
header("Location: pending_research.php");

  
