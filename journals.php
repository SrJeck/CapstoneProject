<?php
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
<html>

<head>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/journals.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
  <!-- NAVBAR -->
  <div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="index.php">HOME</a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>

  <!-- BANNER IMAGE -->
  <div id="index" style="margin-top: 48px;">
    <div class="slideshow-container">

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 400px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 400px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban3.png" style="width:100%; height: 400px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 400px;">
      </div>


      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 400px;">
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

    <center>

      <form name="frmSearch" method="post" action="journals.php">
        <div class="container">
          <div class="row height d-flex justify-content-center align-items-center">
            <div>
              <div class="form">
                <select class="topic" name="topic" id="topic">
                  <option value="" selected disabled hidden>Topic</option>
                  <option style="font-size:17px" value="Education">Education</option>
                  <option style="font-size:17px" value="Technology">Technology</option>
                  <option style="font-size:17px" value="Research">Research</option>
                  <option style="font-size:17px" value="Analysis">Analysis</option>
                  <option style="font-size:17px" value="Database">Database</option>
                </select>
                <input type="text" id="speechToText" class="form-control form-input" name="search[title]" placeholder="Enter your search here" value="<?php echo $title; ?>"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button" name="go">Search</button>
              </div>
            </div>
          </div>
        </div>

        <table class="formview">

          <?php
          if (!empty($result)) {
            foreach ($result as $k => $v) {
              if (is_numeric($k)) {
          ?>
                <tr class="displayRow">

                  <td> <br>
                    <a class="displayResearch" target='_blank' href='display.php?id=<?php echo $result[$k]['id']; ?>'><i style="font-size:80px" class="fa">&#xf0f6;</i>
                      <p style="margin-left: 90px; margin-top: -90px;"><?php echo $result[$k]['topic']; ?></p>
                      <p style="margin-left: 90px; "><?php echo $result[$k]["title"]; ?></p>
                      <p style="margin-left: 90px; ">
                        <p style="margin-left: 90px; "><?php echo $result[$k]["author"]; ?></p>
                        <p style="margin-left: 90px; "><?php echo $result[$k]['publication_day'] . ' ' . $result[$k]['publication_month'] . ' ' . $result[$k]['publication_year']; ?></p>
                        <hr style="border: 1px solid black;">
                    </a>
                  </td>

                </tr>
            <?php
              }
            }
          }
          if (isset($result["perpage"])) {
            ?>
            <tr>
              <td> <?php echo $result["perpage"]; ?></td>
            </tr>
          <?php } ?>
          <?php


          // $databaseHost = 'localhost';   //your db host 
          // $databaseName = 'journal';  //your db name 
          // $databaseUsername = 'root';    //your db username 
          // $databasePassword = ''; //   db password 

          // $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



          // if (mysqli_connect_errno()) {
          //   echo "Failed to connect to MySQL: " . mysqli_connect_error();
          // }
          // $sql = "select count('1') from research";
          // $result = mysqli_query($mysqli, $sql);
          // $row = mysqli_fetch_array($result);
          // echo "<h3>$row[0]</h3>";
          // mysqli_close($mysqli);
          ?>
        </table>
      </form>
      <center>
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