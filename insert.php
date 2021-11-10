<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['publication_date']) && !empty($_POST['research_type'])) {
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publication_date = $_POST['publication_date'];
        $research_type = $_POST['research_type'];
        $institution = $_POST['institution'];
        $publisher = $_POST['publisher'];
        $volume = $_POST['volume'];
        $issue = $_POST['issue'];
        $pages = $_POST['pages'];
        $books = $_POST['books'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt = $dbh->prepare("insert into research values('',?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $author);
        $stmt->bindParam(3, $publication_date);
        $stmt->bindParam(4, $research_type);
        $stmt->bindParam(5, $name);
        $stmt->bindParam(6, $data);
        $stmt->bindParam(7, $type);
        $stmt->bindParam(8, $institution);
        $stmt->bindParam(9, $publisher);
        $stmt->bindParam(10, $volume);
        $stmt->bindParam(11, $issue);
        $stmt->bindParam(12, $pages);
        $stmt->bindParam(13, $books);
        $stmt->execute();
        header("Location: plagscan.php");
    }
}
?>

<?php
// $stat = $dbh->prepare('select * from research');
// $stat->execute();
// while ($row = $stat->fetch()) {
//   echo "<li><a href='view.php?id=".$row['id']."'>".$row['title']."</a></li>";
// }
?>