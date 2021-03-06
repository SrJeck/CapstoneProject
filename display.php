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
<!DOCTYPE html>
<html>

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
  <link rel="stylesheet" type="text/css" href="css/notification.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
    .number {
      height: 26px;
      width: 24px;
      left: 85%;
  </style>
  }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  
  $notif = "";
  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
  $total_count = 0;
  $unseen_count = $dbh->prepare('select COUNT(*) as unseen_count from notification where seen_status="unseen" and user_id=?');
  $unseen_count->bindParam(1, $id);
  $unseen_count->execute();
  $unseened_count = $unseen_count->fetch();
  $total_count =$total_count + $unseened_count['unseen_count'];
  $unseen_count2 = $dbh->prepare('select * from inquiry where user_id=? and seen_status="unseen"');
  $unseen_count2->bindParam(1, $id);
  $unseen_count2->execute();
  while ($unseened_count2 = $unseen_count2->fetch()) {
    if (!empty($unseened_count2['reply']) ) {
        $total_count =$total_count + 1;
    }
  }

  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
  <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
  <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
  <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
  <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
  <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
  <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
  <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
  <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
  <a style="float: right;" >
  <div class="notBtn" href="#" onclick="seeNotif()">
          <div class="number" > <span class="numero">' . $total_count . '</span> </div>
          <i style="font-size:24px;height: 25px;"  class="fa fatest">&#xf0f3;</i>
      <div class="box" id="dialog" id="showdialog"  id="box" style="display:none">
              <div class="display">
              <div class="cont">
                  <!-- Fold this div and try deleting evrything inbetween -->
                  <div class="sec test">
                          <div class="txt"></div>
                  </div>
          </div> 
          </div>
      </div>
  </div>
  </a>

</div>

  ';
  } else {
    echo '<div class="navbar">
  <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
  <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
  <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
  <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
  <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
  <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
  <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  }

  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
  $id = $_GET['id'];


  $view_count = $dbh->prepare('select visit_count from research where id=?');
  $view_count->bindParam(1, $id);
  $view_count->execute();
  $viewed_count = $view_count->fetch();

  $increment = (int)$viewed_count['visit_count'] + 1;
  $update_count = $dbh->prepare('update research set visit_count=? where id=?');
  $update_count->bindParam(1, $increment, PDO::PARAM_INT);
  $update_count->bindParam(2, $id);
  $update_count->execute();


  $stat = $dbh->prepare('select * from research where id=?');
  $stat->bindParam(1, $id);
  $stat->execute();
  $row = $stat->fetch();
  ?>
  <script>
    $("#showdialog").click(function() {
      $(".box").show();
    });
    $(".box .close").click(function() {
      $(this).parent().hide()
    })
  </script>

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
          <table>
            <tr>
              <td><strong>APA</strong> </td>
              <td><?php echo  $row['author']  ?>.<span> (</span><?php echo  $row['publication_year']  ?><span>). </span><span><?php echo  $row['title']  ?>.</span> <?php echo  $row['publisher']  ?></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <a href="add_bookmark.php?id=<?php echo $id; ?>" class="view btn-lg">
    <span class="fa fa-bookmark-o"> Bookmark</span>
  </a>
  <!-- Button trigger modal -->
  <button type="button" class="view btn-primary" data-toggle="modal" data-target="#exampleModal">
    <span class="fa fa-quote-right"> Cite</span>
  </button>

  <?php
  if ($row['permission'] == "Download Only") {

    echo "<a class='view btn-lg' target='_blank' href='download.php?id=" . $row['id'] . "'><span class='fa fa-file-pdf-o'> Download PDF </span></a>";
  } else if ($row['permission'] == "View Only") {

    echo "<a class='view btn-lg' target='_blank' href='view.php?id=" . $row['id'] . "'><span class='fa fa-file-pdf-o'> View PDF </span></a>";
  } else if ($row['permission'] == "View and Download") {

    echo "<a class='view btn-lg' target='_blank' href='download.php?id=" . $row['id'] . "'><span class='fa fa-file-pdf-o'> Download PDF </span></a>";
    echo "<a class='view btn-lg' target='_blank' href='view.php?id=" . $row['id'] . "'><span class='fa fa-file-pdf-o'> View PDF </span></a>";
  }
  ?>
  <?php

  echo "
    <div class='row'>
        <br><br><h1 style='margin-left: 50px;max-width: 1100px'>" . $row['title'] . "</h1><p style='margin-left: 50px;'>" . "<strong>Authors:  </strong>" . $row['author'] . "</p><p style='margin-left: 50px;'>" . "<strong>Published Online: </strong>" . $row['publication_day'] . ' ' . $row['publication_month'] . ' ' . $row['publication_year'] . "<p style='margin-left: 50px;'>" . "<strong>Keywords:  </strong>" . $row['keywords'] . "</p>
        
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
        <form class="example" name="frmSearch" method="post" action="research.php" style="margin:auto;max-width:300px">
          <input type="text" name="search" placeholder="Search ThesisQuo" value="<?php if (isset($_POST["search"])) {
                                                                                  }  ?>" name="search2">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>

      </div>
    </div>


    <div id="right">
      <div class="right-content">
        <div class="right-content-header"></div>
        <!-- <div id="full-text"><?php echo "<iframe ' type='application/pdf' src='data:" . $row['file_type'] . ";base64," . base64_encode($row['file_upload']) . "' height='150%' width='100%'></iframe>" ?></div> -->
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

        </table>
      </div>
    </div>
  </div>
</body>

</html>