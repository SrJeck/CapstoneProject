<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = $_GET["id"];
$stat = $dbh->prepare('select * from research where id=?');
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 11/16/2021 -->

<html>

<head>
  <title>Edit Upload</title>
  <script type="text/javascript" src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/addarticle.css">
  <link rel="stylesheet" type="text/css" href="css/notification.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    .number {
      height: 26px;
      width: 24px;
    }

    #dialog {

      top: 65px;
    }

    .txt {
      width: 370px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php

  $notif = "";
  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

  $unseen_count = $dbh->prepare('select COUNT(*) as unseen_count from notification where seen_status="unseen" and user_id=?');
  $unseen_count->bindParam(1, $id);
  $unseen_count->execute();
  $unseened_count = $unseen_count->fetch();

  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
    <div class="tooltip">
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <span class="tooltiptext">Logout</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <span class="tooltiptext">Profile</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
    <span class="tooltiptext">Bookmark</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
    <span class="tooltiptext">Add Article</span>
    </div>
    <div class="tooltip">
    <span class="tooltiptext">Notification</span>
    <a style="float: right;">
    <div class="notBtn" href="#" onclick="seeNotif()">
            <div class="number" > ' . $unseened_count['unseen_count'] . ' </div>
            <i style="font-size:24px;height: 25px;" id="showdialog" class="fa fatest">&#xf0f3;</i>
        <div class="box" id="dialog" id="box" style="display:none">
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
</div>

    ';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    </div>';
  }
  ?>


  <!-- Form -->
  <div class="container">
    <form id="add_article_form" action="update_upload.php" method="post" enctype="multipart/form-data">
      <input id="thesis_id" name="thesis_id" value="<?php echo $id ?>" style="display:none">

      <h3>Add Article</h3><br>
      <fieldset>
        <label>Abstract:</label>
        <textarea type="text" name="abstract" id="abstract" rows="7" cols="50" required><?php echo $row['abstract'] ?></textarea>
      </fieldset>
      <fieldset>
        <label>Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $row['title'] ?>" required>
      </fieldset>
      <fieldset>
        <label>Authors:</label>
        <input type="text" name="author" id="author" value="<?php echo $row['author'] ?>" required>
      </fieldset>

      <fieldset>
        <label>Institution:</label>
        <input type="text" name="institution" id="institution" value="<?php echo $row['institution'] ?>" required>
      </fieldset>
      <fieldset>
        <label>Degree Level:</label>
        <select name="degree_level" id="degree_level" required>
          <option value="<?php echo $row['degree_level'] ?>" selected disabled hidden><?php echo $row['degree_level'] ?> </option>
          <option value="Professional Certificates">Professional Certificates</option>
          <option value="Undergraduate Degrees">Undergraduate Degrees</option>
          <option value="Transfer Degrees">Transfer Degrees</option>
          <option value="Associate Degrees">Associate Degrees</option>
          <option value="Bachelor Degrees">Bachelor Degrees</option>
          <option value="Graduate Degrees">Graduate Degrees</option>
          <option value="Master Degrees">Master Degrees</option>
          <option value="Doctoral Degrees">Doctoral Degrees</option>
          <option value="Professional Degrees">Professional Degrees</option>
          <option value="Others">Others</option>
        </select>
      </fieldset>
      <fieldset>
        <label>Topic:</label>
        <select name="topic" id="topic" required>
          <option value="<?php echo $row['topic'] ?>" selected disabled hidden><?php echo $row['topic'] ?></option>
          <option value="Education">Education</option>
          <option value="Technology">Technology</option>
          <option value="Research">Research</option>
          <option value="Analysis">Analysis</option>
          <option value="Database">Database</option>
          <option value="Agriculture">Agriculture</option>
          <option value="Health">Health</option>
          <option value="Politics">Politics</option>
          <option value="Psychology">Psychology</option>
          <option value="Business">Business</option>
          <option value="Marketing and Advertising">Marketing and Advertising</option>
          <option value="Mechanical">Mechanical</option>
          <option value="Ethics">Ethics</option>
          <option value="Others">Others</option>
        </select>
      </fieldset>
      <fieldset>
        <label>Research Type:</label>
        <select name="research_type" id="research_type" required>
          <option value="<?php echo $row['research_type'] ?>" selected disabled hidden><?php echo $row['research_type'] ?></option>
          <option value="Capstone Project">Capstone Project</option>
          <option value="Undergraduate Thesis">Undergraduate Thesis</option>
          <option value="Master’s Thesis">Master’s Thesis</option>
          <option value="Dissertation">Dissertation</option>
          <option value="Practice Based">Practice Based</option>
        </select>
      </fieldset>
      <fieldset>
        <label>Keywords:</label>
        <input type="text" value="<?php echo $row['keywords'] ?>" id="keywords" name="keywords">
      </fieldset>
      <fieldset>
        <label>Publisher:</label>
        <input type="text" name="publisher" id="publisher" value="<?php echo $row['publisher'] ?>" required>
      </fieldset>
      <fieldset>
        <label>Permission Type:</label>
        <br>
        <input type="radio" id="view_only" name="permission" value="View Only">
        <label>View Only</label>
        <input style="margin-left: 20px;" type="radio" id="download_only" name="permission" value="Download Only">
        <label>Download Only</label>
        <input style="margin-left: 20px;" type="radio" id="view_download" name="permission" value="View and Download">
        <label>View and Download</label><br>
      </fieldset>

      <fieldset>
        <button style="background-color: rgb(21, 117, 114)" class="submit" type="submit" name="submit" id="sendNewSms">Update</button>
      </fieldset>
    </form>


  </div>
</body>


</html>