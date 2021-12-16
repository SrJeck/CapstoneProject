<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal","root","");

if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $author = $_POST['author'];
  $institution = $_POST['institution'];
  $degree_level = $_POST['degree_level'];
  $topic = $_POST['topic'];
  $research_type = $_POST['research_type'];
  $abstract = $_POST['abstract'];
  $keywords = $_POST['keywords'];
  $publisher = $_POST['publisher'];
  $permission = $_POST['permission'];
  $id = $_POST['thesis_id'];
  
  
  $stat = $dbh->prepare("update research set title=?,author=?,institution=?,degree_level=?,topic=?,research_type=?,abstract=?,keywords=?,publisher=?,permission=? where id=?");
      $stat->bindParam(1, $title);
      $stat->bindParam(2, $author);
      $stat->bindParam(3, $institution);
      $stat->bindParam(4, $degree_level);
      $stat->bindParam(5, $topic);
      $stat->bindParam(6, $research_type);
      $stat->bindParam(7, $abstract);
      $stat->bindParam(8, $keywords);
      $stat->bindParam(9, $publisher);
      $stat->bindParam(10, $permission);
      $stat->bindParam(11, $id);
      $stat->execute();
      header("Location: profile.php");
      
  }
?>
