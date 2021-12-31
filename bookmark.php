<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

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
$sql = "SELECT * from research " . $queryCondition;
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
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>

<head>
  <title>Bookmark</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bookmark.css">
  <link rel="stylesheet" type="text/css" href="css/notification.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

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
  <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
  <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
  <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
  <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  }
  ?>
  <!-- <script>
    $("#showdialog").click(function() {
      $(".box").show();
    });
    $(".box .close").click(function() {
      $(this).parent().hide()
    })
  </script> -->

  <!-- BANNER IMAGE -->
  <br>
  <div id="index">
    <div class="slideshow-container">

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban3.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px;">
      </div>


      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px;">
      </div>

    </div>
    <br>


    <div style="text-align:center">
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
    </div>
    <script>
      var slideIndex = 0;
      showSlides();

      function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
          slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 3000); // Change image every 3 seconds
      }
    </script>

    <!-- SEARCH BAR CONTAINER -->
    <form name="frmSearch" method="post" action="research.php">
      <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
          <div>
            <div class="form">
              <input type="text" id="speechToText" class="form-control form-input" name="search" placeholder="Search ThesisQuo" value="<?php if (isset($_POST["search"])) {
                                                                                                                                        }  ?>"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button" name="go">Search</button>
            </div>
          </div>
        </div>
      </div>
    </form>


    <?php
    $stat = $dbh->prepare('select * from bookmark where user_id=?');
    $stat->bindParam(1, $id);
    $stat->execute();
    while ($rows = $stat->fetch()) {
      $thesis_id = $rows['id'];
      $new_stat = $dbh->prepare('select * from research where id=?');
      $new_stat->bindParam(1, $thesis_id);
      $new_stat->execute();
      $thesis = $new_stat->fetch();
      if (!empty($thesis)) {
        echo '
                <table class="formview">
                      <tr class="displayRow">
                        <td> <br>
                          <a class="displayResearch" target="_blank" href="display.php?id=' . $thesis['id'] . '"><i style="font-size:80px" class="fa">&#xf0f6</i>
                            <p style="margin-left: 90px; margin-top: -90px;">' . $thesis['topic'] .  '</p>
                            <p style="margin-left: 90px; ">' . $thesis["title"] . '</p>
                            <p style="margin-left: 90px; ">
                              <p style="margin-left: 90px; ">' . $thesis["author"] . '</p>
                              <p style="margin-left: 90px; ">' . $thesis['publication_day'] . ' ' . $thesis['publication_month'] . ' ' . $thesis['publication_year'] . '</p>
                              <hr style="border: 1px solid black;">
                          </a>
                        </td>
                        <td>
                        <a href="remove_bookmark.php?id=' . $thesis['id'] . '" class="view btn-lg"><i class="fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                 </table>
        ';
      }
    }
    ?>
    <br><br>

    <!-- ChatBot -->
    <div class="chat_icon">
      <img style="height: 80px;" src="images/chatboticon.png">
    </div>

    <div class="chat_box">
      <div class="my-conv-form-wrapper">
        <form action="" method="GET" class="hidden">

          <select data-conv-question="Hello! How can I help you" name="category">
            <option value="WebDevelopment">Website Development ?</option>
            <option value="ThesisQuoForum">Thesis Quo Forum</option>
          </select>

          <div data-conv-fork="category">
            <div data-conv-case="WebDevelopment">
              <input type="text" name="domainName" data-conv-question="Please, tell me your domain name">
            </div>
            <div data-conv-case="ThesisQuoForum" data-conv-fork="first-question2">
              <input type="text" name="companyName" data-conv-question="Please, enter your institution name">
            </div>
          </div>

          <input type="text" name="name" data-conv-question="Please, Enter your name">

          <input type="text" data-conv-question="Hi {name}, <br> It's a pleasure to meet you." data-no-answer="true">

          <input data-conv-question="Enter your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" name="email" required placeholder="What's your e-mail?">

          <select data-conv-question="Please Confirm">
            <option value="Yes">Confirm</option>
          </select>

        </form>
      </div>
    </div>
    <!-- ChatBot end -->

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