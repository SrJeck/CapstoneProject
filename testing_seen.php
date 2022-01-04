<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

$user_id = $_SESSION['user_id'];
//$seen_status = $_POST["seen"];
$approved = $dbh->prepare("update notification set seen_status=? where user_id=?");
$approved->bindParam(1, $seen_status);
$approved->bindParam(2, $user_id);
$approved->execute();


$arr = array();
$notif = "";

$notification = $dbh->prepare('select * from notification where user_id=? ORDER BY notification_id DESC');
    $notification->bindParam(1, $user_id);
    $notification->execute();
    while ($notifications = $notification->fetch()) {
        array_push($arr,$notifications['notification_date']." ".$notifications['notification_id']." notification");
    }

        $inquiry = $dbh->prepare('select * from inquiry where user_id=? ORDER BY inquiry_id DESC');
        $inquiry->bindParam(1, $user_id);
        $inquiry->execute();
        while ($inquirys = $inquiry->fetch()) {
            if (!empty($inquirys['reply'])) {
                array_push($arr,$inquirys['reply_date']." ".$inquirys['inquiry_id']." inquiry");
            }
        }

        rsort($arr);
        for ($i=0; $i < count($arr); $i++) { 
           //echo $arr[$i]."<br>";
           $new_arr = explode(" ",$arr[$i]);
            if ($new_arr[2] == "inquiry") {
                $inquiry2 = $dbh->prepare('select * from inquiry where inquiry_id=?');
                $inquiry2->bindParam(1, $new_arr[1]);
                $inquiry2->execute();
                $inquirys2 = $inquiry2->fetch();
                    if (!empty($inquirys2['reply'])) {
                        $approved2 = $dbh->prepare("update inquiry set seen_status=? where inquiry_id=?");
                        $approved2->bindParam(1, $seen_status);
                        $approved2->bindParam(2, $inquirys2['inquiry_id']);
                        $approved2->execute();
                        $notif .= '
                      <!-- Fold this div and try deleting evrything inbetween -->
                        <div class="sec test">
                            <div class="profCont">
                                <img class="profile"  src="images/chatboticon.png">
                            </div>
                            <div class="txt">Reply</div>
                            <div class="txt">' . $inquirys2['subject'] . '</div>
                            <div class="txt">' . $inquirys2['reply'] . '</div>
                            <div class="txt">' . $inquirys2['reply_date'] . '</div>
                            <hr class="section">
                        </div><br>
                        ';
                    }
            }else{
                $notification2 = $dbh->prepare('select * from notification where notification_id=?');
                $notification2->bindParam(1, $new_arr[1]);
                $notification2->execute();
                $notifications2 = $notification2->fetch();
                    $thesis2 = $dbh->prepare('select * from research where id=? ');
                    $thesis2->bindParam(1, $notifications2['thesis_id']);
                    $thesis2->execute();
                    $thesis_title2 = $thesis2->fetch();
                    $notif .= '
                      <!-- Fold this div and try deleting evrything inbetween -->
                        <div class="sec test">
                            <div class="profCont">
                                <img class="profile"  src="images/chatboticon.png">
                            </div>
                            <div class="txt">' . $notifications2['status'] . '</div>
                            <div class="txt">' . $thesis_title2['title'] . '</div>
                            <div class="txt">' . $notifications2['reason'] . '</div>
                            <div class="txt">' . $notifications2['notification_date'] . '</div>
                            <hr class="section">
                        </div><br>
                        ';
            }
        }

    echo $notif;
?>