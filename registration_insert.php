<?php
        $dbh = new PDO("mysql:host=localhost;dbname=research","root","");
        if (isset($_POST['submit'])) {
            if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['phoneNum']) && !empty($_POST['address'])  && !empty($_POST['birthday']) && !empty($_POST['sex'])  && !empty($_POST['degree_level']) && !empty($_POST['email'])  && !empty($_POST['password'])){
            $fName = $_POST['firstName'];
            $mName = "";
            if (!empty($_POST['middleName'])) {
                $mName = $_POST['middleName'];
            }
            $lName = $_POST['lastName'];
            $phoneNum = $_POST['phoneNum'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $degree = $_POST['degree_level'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $status = "offline";

            // echo $fName;
            // echo $mName;
            // echo $lName;
            // echo $phoneNum;
            // echo $address;
            // echo $birthday;
            // echo $sex;
            // echo $degree;
            // echo $email;
            // echo $password;
            $stat = $dbh->prepare('select * from user where email=?');
            $stat->bindParam(1, $email);
            $stat->execute();
            $row = $stat->fetch();
            if (empty($row)) {
                $stmt = $dbh->prepare("insert into user values('',?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1,$fName);
                $stmt->bindParam(2,$mName);
                $stmt->bindParam(3,$lName);
                $stmt->bindParam(4,$phoneNum);
                $stmt->bindParam(5,$address);
                $stmt->bindParam(6,$sex);
                $stmt->bindParam(7,$birthday);
                $stmt->bindParam(8,$email);
                $stmt->bindParam(9,$password);
                $stmt->bindParam(10,$degree);
                $stmt->bindParam(11,$status);
                $stmt->execute();
                header("Location: login.php");
                echo "success";  
            }else{
                header("Location: registration.php");
                echo "failed";  
            }
            }
        }
        
?>