<?php
        $dbh = new PDO("mysql:host=localhost;dbname=journal","root","");
        if (isset($_POST['btn'])) {
            if(!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['research_type']) && !empty($_POST['institution'])  && !empty($_POST['publisher'])){
            $name = $_FILES['myfile']['name'];
            $type = $_FILES['myfile']['type'];
            $title = $_POST['title']; 
            $author = $_POST['author']; 
            $publication_date = date("Y-n-d"); 
            $research_type = $_POST['research_type'];
            $institution = $_POST['institution']; 
            $publisher = $_POST['publisher'];
            $data = file_get_contents($_FILES['myfile']['tmp_name']);
            $stmt = $dbh->prepare("insert into research values('',?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1,$title);
            $stmt->bindParam(2,$author);
            $stmt->bindParam(3,$publication_date);
            $stmt->bindParam(4,$research_type);
            $stmt->bindParam(5,$name);
            $stmt->bindParam(6,$data);
            $stmt->bindParam(7,$type);
            $stmt->bindParam(8,$institution);
            $stmt->bindParam(9,$publisher);
            $stmt->execute();
            header("Location: plagscan.php");
            }
        }
?>