<!-- Search and Pagination -->
<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$title = "";
$author = "";
$topic = "";
$publication_day = "";
$publication_day = "";
$publication_year = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
  foreach ($_POST["search"] as $k => $v) {
    if (!empty($v)) {

      $queryCases = array("title", "author", "topic", "publication_day", "publication_day", "publication_year");
      if (in_array($k, $queryCases)) {
        if (!empty($queryCondition)) {
          $queryCondition .= " OR ";
        } else {
          $queryCondition .= " WHERE ";
        }
      }
      switch ($k) {
        case "title":
          $title = $v;
          $queryCondition .= "title LIKE '%" . $v . "%'"  . "OR author LIKE'%" . $v . "%'"  . "OR topic LIKE'%" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM research " . $queryCondition;
$href = 'journals.php';

$perPage = 3;
$page = 1;
if (isset($_POST['page'])) {
  $page = $_POST['page'];
}
$start = ($page - 1) * $perPage;
if ($start < 0) $start = 0;

$query =  $sql . $orderby .  " limit " . $start . "," . $perPage;
$result = $db_handle->runQuery($query);

if (!empty($result)) {
  $result["perpage"] = showperpage($sql, $perPage, $href);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/display.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
  }
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  }
  $dbh = new PDO("mysql:host=localhost;dbname=research", "root", "");
  $id = $_GET['id'];
  $stat = $dbh->prepare('select * from research where id=?');
  $stat->bindParam(1, $id);
  $stat->execute();
  $row = $stat->fetch();
  ?>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Cite</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width:100%">
            <tr>
              <td><strong>APA</strong> </td>
              <td><?php echo  $row['author']  ?><span> (</span><?php echo  $row['publication_year']  ?><span>) </span>"<?php echo  $row['title'] ?>" <?php echo  $row['publisher']  ?></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="view btn-lg">
    <span class="fa fa-bookmark-o"> Bookmark</span>
  </a>
  <!-- Button trigger modal -->
  <button type="button" class="view btn-primary" data-toggle="modal" data-target="#exampleModal">
    <span class="fa fa-quote-right"> Cite</span>
  </button>
  <a href="#" class="view btn-lg">
    <span class="fa fa-print" onclick="window.print()"> Print</span>
  </a>
  <?php echo "<a class='view btn-lg' target='_blank' href='view.php?id=" . $row['id'] . "'><span class='fa fa-file-pdf-o'> View PDF </span></a>" ?>

  <?php

  echo "
    <div class='row'>
        <br><br><h1 style='margin-left: 50px;max-width: 1100px'>" . $row['title'] . "</h1><p style='margin-left: 50px;'>" . "<strong>Authors:  </strong>" . $row['author'] . "</p><p style='margin-left: 50px;'>" . "<strong>Published Online: </strong>" . $row['publication_day'] . ' ' . $row['publication_month'] . ' ' . $row['publication_year'] . "</p>
        
        </div>";
  ?>

  <div id="outer">

    <div id="left">
      <div class="left-content">
        <div class="left-content-header">Jump to:</div><br>
        <a href="#full-text">
          <p>Full text</p>
        </a>
        <a href="#abstract">
          <p>Abstract</p>
        </a>
        <a href="#details">
          <p>Details</p>
        </a>
      </div>
    </div>
    <div id="center">
      <div class="center-content">
        <form class="example" name="frmSearch" method="post" action="journals.php" style="margin:auto;max-width:300px">
          <input type="text" name="search[title]" placeholder="Search ThesisQuo" value="<?php echo $title; ?>" name="search2">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>

      </div>
    </div>


    <div id="right">
      <div class="right-content">
        <div class="right-content-header"></div>
        <div id="full-text"><?php echo "<iframe ' type='application/pdf' src='data:" . $row['file_type'] . ";base64," . base64_encode($row['file_upload']) . "' height='150%' width='100%'></iframe>" ?></div>
        <div id="abstract"><?php echo "<h3 style='font-family: Arial, Helvetica, sans-serif;'>Abstract</h3><p style='font-size: 1.1em;'>" . $row['abstract'] . "</p><h3>Keywords</h3><p style='font-size: 1.1em;'>" . $row['keywords'] . "</p><li>" ?>
        </div>
        <h3>Details</h3>
        <table id="details">
          <tr>
            <td>Title</td>
            <td><?php echo  $row['title']  ?></td>
          </tr>
          <tr>
            <td>Author</td>
            <td><?php echo  $row['author']  ?></td>
          </tr>
          <tr>
            <td>Publication year</td>
            <td><?php echo  $row['publication_year']  ?></td>
          </tr>
          <tr>
            <td>Publication date</td>
            <td><?php echo  $row['publication_month']  ?> <?php echo  $row['publication_year']  ?></td>
          </tr>
          <tr>
            <td>Publisher</td>
            <td><?php echo  $row['publisher']  ?></td>
          </tr>
          <tr>
            <td>Topic</td>
            <td><?php echo  $row['topic']  ?></td>
          </tr>
          <tr>
            <td>Research Type</td>
            <td><?php echo  $row['research_type']  ?></td>
          </tr>
          <tr>
            <td>Citation</td>
            <td><?php echo  $row['citation']  ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>

</html>