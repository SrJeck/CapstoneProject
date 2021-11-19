<?php
        $dbh = new PDO("mysql:host=localhost;dbname=research","root","");
        if (isset($_POST['submit'])) {
            if(!empty($_POST['email']) && !empty($_POST['password'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $stat = $dbh->prepare('select * from user where email=? and password=?');
                $stat->bindParam(1, $email);
                $stat->bindParam(2, $password);
                $stat->execute();
                $row = $stat->fetch();
                if (!empty($row)) {
                    header("Location: profile.php?user_id=".$row['user_id']);
                }else{
                    header("Location: login.php");
                }

            }
        }
?>