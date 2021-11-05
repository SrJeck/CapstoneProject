<?php
$conn = mysqli_connect('localhost', 'root', '', 'journal');

if (isset($_POST['submit'])) {

  if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['publication_date']) && !empty($_POST['research_type']) && !empty($_POST['institution'])  && !empty($_POST['publisher'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];
    $research_type = $_POST['research_type'];
    $type = $_FILES['file-upload']['type'];
    $file_upload = file_get_contents($_FILES['file-upload']['tmp_name']);
    $institution = $_POST['institution'];
    $publisher = $_POST['publisher'];

    $upload_dir = '/images';

    $query = "insert into research(title,author,publication_date,research_type,mime,file_upload,institution,publisher) values('$title','$author','$publication_date','$research_type','$type','$file_upload','$institution','$publisher')";

    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if ($run) {
      echo "Form Submitted Successfully";
    } else {
      echo "Form not Submitted";
    }
  } else {
    echo "All fields are required";
  }
}

?>

<?php
$stat = $dbh->prepare('select * from myblob');
$stat->execute();
while ($row = $stat->fetch()) {
  echo "<li><a href='view.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></li>";
}

?>