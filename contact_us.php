<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

?>
<html>

<head>
  <title>Home</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <link rel="stylesheet" href="css/contactus.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    .number {
      height: 26px;
      width: 24px;
    }

    #dialog {
      display: none;
      position: fixed;
      left: 65.7%;
      top: 10px;
      z-index: 1;
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
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
    <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
    <a style="float: right;" >
    <div class="notBtn" href="#" onclick="seeNotif()">
            <div class="number" > ' . $unseened_count['unseen_count'] . ' </div>
            <i style="font-size:24px;height: 25px;" class="fa fatest">&#xf0f3;</i>
        <div class="box" id="dialog" id="showdialog" id="box" style="display:none">
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

    </div>';
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
  <script>
    $("#showdialog").click(function() {
      $(".box").show();
    });
    $(".box .close").click(function() {
      $(this).parent().hide()
    })
  </script>
  <section id="contact">
    <div class="contact-box">
      <div class="contact-links">
        <form action="upload_inquiry.php" method="POST">
          <!-- <div class="form-item">
              <input type="text" name="sender" required>
              <label>Name:</label>
            </div> -->
          <div class="form-item">
            <input type="text" name="email" required>
            <label>From Email:</label>
          </div>
          <div class="form-item">
            <input type="text" name="subject" required>
            <label>Subject:</label>
          </div>
          <div class="form-item">
            <textarea class="" name="message" required></textarea>
            <label>Message:</label>
          </div>
          <button class="submit-btn" name='send'>Send</button>
        </form>
      </div>

      <div class="contact-form-wrapper">
        <h2>CONTACT US</h2><br><br><br><br><br>
        <i style="color:white; margin-left:25px" class="fa fa-envelope"></i>
        <h4><em><u><a style="cursor: pointer; text-decoration:none; color:white;" target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=thesisquo.helpdesk@gmail.com">thesisquo.helpdesk@gmail.com</a></u></em>
        </h4>
      </div>
    </div>
  </section>
</body>
<!-- Below is the script for voice recognition and conversion to text-->
<script>
  function record() {
    var recognition = new webkitSpeechRecognition();
    recognition.lang = "en-GB";

    recognition.onresult = function(event) {
      // console.log(event);
      document.getElementById('speechToText').value = event.results[0][0].transcript;
    }
    recognition.start();
  }
</script>

</html>