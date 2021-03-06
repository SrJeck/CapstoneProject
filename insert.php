<?php

session_start();
$user_id = $_SESSION['user_id'];
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['author'])) {
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publication_month = $_POST['publication_month'];
        $publication_day = $_POST['publication_day'];
        $publication_year = $_POST['publication_year'];
        $institution = $_POST['institution'];
        $degree_level = $_POST['degree_level'];
        $topic = $_POST['topic'];
        $research_type = $_POST['research_type'];
        $abstract = $_POST['abstract'];
        $keywords = $_POST['keywords'];
        $publisher = $_POST['publisher'];
        $permission = $_POST['permission'];
        $upload_status = 'Unpublished';
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt = $dbh->prepare("insert into research values('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'')");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $author);
        $stmt->bindParam(3, $publication_month);
        $stmt->bindParam(4, $publication_day);
        $stmt->bindParam(5, $publication_year);
        $stmt->bindParam(6, $name);
        $stmt->bindParam(7, $data);
        $stmt->bindParam(8, $type);
        $stmt->bindParam(9, $institution);
        $stmt->bindParam(10, $degree_level);
        $stmt->bindParam(11, $topic);
        $stmt->bindParam(12, $research_type);
        $stmt->bindParam(13, $abstract);
        $stmt->bindParam(14, $keywords);
        $stmt->bindParam(15, $publisher);
        $stmt->bindParam(16, $permission);
        $stmt->bindParam(17, $upload_status);
        $stmt->bindParam(18, $plagPercent);
        $stmt->bindParam(19, $unPercent);
        $stmt->bindParam(20, $user_id);
        $stmt->execute();
        header("Location: logOrProf.php");
    }
}
