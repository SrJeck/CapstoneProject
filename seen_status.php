<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$user_id = $_SESSION['user_id'];
$seen_status = $_POST["seen"];
$approved = $dbh->prepare("update notification set seen_status=? where user_id=?");
$approved->bindParam(1, $seen_status);
$approved->bindParam(2, $user_id);
$approved->execute();
$notif = "";

$notification = $dbh->prepare('select * from notification where user_id=? ORDER BY notification_date DESC');
    $notification->bindParam(1, $user_id);
    $notification->execute();
    while ($notifications = $notification->fetch()) {
        $thesis = $dbh->prepare('select * from research where id=? ');
        $thesis->bindParam(1, $notifications['thesis_id']);
        $thesis->execute();
        $thesis_title = $thesis->fetch();
        $notif .= '
          <!-- Fold this div and try deleting evrything inbetween -->
            <div class="sec test">
                <div class="profCont">
                    <img class="profile"  src="images/chatboticon.png">
                </div>
                <div class="txt">' . $notifications['status'] . '</div>
                <div class="txt">' . $thesis_title['title'] . '</div>
                <div class="txt">' . $notifications['reason'] . '</div>
                <div class="txt">' . $notifications['notification_date'] . '</div>
                <hr class="section">
            </div><br>
';
    }

    echo $notif;
?>