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
  <link rel="stylesheet" type="text/css" href="css/add_article.css">
  <link rel="stylesheet" type="text/css" href="css/notification.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
<a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
<a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
<a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
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

?>


  <!-- Form -->
  <br>
  <form id="add_article_form" action="update_upload.php" method="post" enctype="multipart/form-data">
    <input id="thesis_id" name="thesis_id" value="<?php echo $id ?>" style="display:none">
    <span class="row">
      <span class="col-25">
        <label>Abstract:</label>
      </span>
      <span class="col-75">
        <textarea type="text" name="abstract" id="abstract" rows="7" cols="50" required><?php echo $row['abstract'] ?></textarea>
        <!-- <button class='scanbutton' onclick='plagScan()' id='sub-btn'>Scan For Plagiarism</button><br> -->
      </span>
      <span class="col-25">
        <label>Title:</label>
      </span>
      <span class="col-75">
        <input type="text" name="title" id="title" value="<?php echo $row['title'] ?>" required>
      </span>
      <span class="col-25">
        <label>Authors:</label>
      </span>
      <span class="col-75">
        <input type="text" name="author" id="author" value="<?php echo $row['author'] ?>" required>
      </span>
    </span>
    <span class=" row">
      <span class="col-25">
        <label>Institution:</label>
      </span>
      <span class="col-75">
        <input type="text" name="institution" id="institution" value="<?php echo $row['institution'] ?>" required>
      </span>
      <span class="col-25">
        <label>Degree Level:</label>
      </span>
      <span class="col-75">
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
      </span>
      <span class="col-25">
        <label>Topic:</label>
      </span>
      <span class="col-75">
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
      </span>
      <span class="col-25">
        <label>Research Type:</label>
      </span>
      <span class="col-75">
        <input type="text" id="research_type" name="research_type" value="<?php echo $row['research_type'] ?>" readonly>
      </span>

      <span class="col-25">
        <label>Keywords:</label>
      </span>
      <span class="col-75">
        <input type="text" value="<?php echo $row['keywords'] ?>" id="keywords" name="keywords">
      </span>
      <span class="col-25">
        <label>Publisher:</label>
      </span>
      <span class="col-75">
        <input type="text" name="publisher" id="publisher" value="<?php echo $row['publisher'] ?>" required>
      </span>
      <span class="col-25">
        <label>Permission Type:</label>
      </span>
      <span class="col-75">
        <input type="radio" id="view_only" name="permission" value="View Only">
        <label>View Only</label>
        <input style="margin-left: 20px;" type="radio" id="download_only" name="permission" value="Download Only">
        <label>Download Only</label>
        <input style="margin-left: 20px;" type="radio" id="view_download" name="permission" value="View and Download">
        <label>View and Download</label><br>
      </span>
    </span>
    </span>
    <div class="file-upload">
      <input class="file-upload__input" type="file" name="myfile" accept="application/pdf" id="myFile" multiple>
      <button class="file-upload__button" type="button">Choose File(s)</button>
      <span class="file-upload__label"></span>
      <script type="text/javascript" src="js/custom.js"></script>
    </div>

    <button class="submit" type="submit" name="submit" id="sendNewSms">Update</button>
  </form>
  </div>
</body>


</html>