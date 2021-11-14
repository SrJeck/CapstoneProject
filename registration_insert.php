<?php
        $dbh = new PDO("mysql:host=localhost;dbname=journal","root","");
        if (isset($_POST['submit'])) {
            if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['phoneNum']) && !empty($_POST['address'])  && !empty($_POST['birthday']) && !empty($_POST['sex'])  && !empty($_POST['degree']) && !empty($_POST['email'])  && !empty($_POST['password'])){
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
            $degree = $_POST['degree'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $stmt = $dbh->prepare("insert into user values('',?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1,$fName);
            $stmt->bindParam(2,$mName);
            $stmt->bindParam(3,$lName);
            $stmt->bindParam(4,$phoneNum);
            $stmt->bindParam(5,$address);
            $stmt->bindParam(6,$birthday);
            $stmt->bindParam(7,$sex);
            $stmt->bindParam(8,$degree);
            $stmt->bindParam(9,$email);
            $stmt->bindParam(9,$password);
            $stmt->execute();
            header("Location: login.php");
            }
        }
?>