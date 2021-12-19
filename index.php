<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 11/16/2021 -->


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
  <link rel="stylesheet" type="text/css" href="css/style.css">
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

  <!-- MOBILE SIDEBAR -->
  <!-- <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">HOME</a>
    <a href="research.php">RESEARCH</a>
    <a href="analytics.php">ANALYTICS</a>
  </div>
  <span style="font-size:35px;cursor:pointer;display: block;background-color:#751518;color:white;" onclick="openNav()">&#9776;</span> -->

  <!-- BANNER IMAGE -->
  <br>
  <div id="index">
    <div class="slideshow-container">

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px; ">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px; ">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban3.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px; ">
      </div>


      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px; ">
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

    <!-- INTRODUCTION -->
    <h2 class="new">Whats's New?</h2>
    <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor.
      Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt.
      Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi.
      Phasellus sit amet dolor elementum, varius mauris in, commodo mauris. In eu nunc justo.
    </p>
    <!-- 3 IMAGES -->
    <div class="images">
      <form action="research.php" method="POST">
        <img class="book" src="images/book.JPG">
        <button class="btn" type="submit" name="Education">Education</button>
        <img class="chip" src="images/chip.JPG">
        <button class="btn2" type="submit" name="Technology">Technology</button>
        <img class="business" src="images/business.JPG">
        <button class="btn3" type="submit" name="Business">Business</button>
      </form>
    </div>

    <!-- ChatBot -->
    <div class="chat_icon">
      <img style="height: 80px;" src="images/chatboticon.png">
    </div>

    <div class="chat_box">
      <div class="my-conv-form-wrapper">
        <form action="" method="GET" class="hidden">

          <select data-conv-question="Hello! How can I help you" name="category">
            <option value="1">How to Upload Study?</option>
            <option value="2">What study would you recommend for me to read?</option>
            <option value="3">What study topic can i develop?</option>
          </select>
          <!-- What study topic can i develop? -->
          <div data-conv-fork="category">

            <div data-conv-case="3" data-conv-fork="first-question2">
              <select data-conv-question="What do you want to develop?" name="category">
                <option value="1">Uniqie Study</option>
                <option value="2">More Resources Available</option>
              </select>
            </div>
            <div data-conv-case="1" data-conv-fork="first-question2">
              <select data-conv-question="Select the option" name="category">
                <option value="1">Show overall Lowest number of uploaded topic</option>
              </select>
            </div>

            <div data-conv-case="2" data-conv-fork="first-question2">
              <select data-conv-question="Select the option" name="category">
                <option value="1">Show overall Highest number of uploaded topic</option>
              </select>
            </div>

            <div data-conv-fork="first-question3">
              <select data-conv-question="Do you have any specific question for me?" name="category">
                <option value="Yess">Yes</option>
                <option value="Noo">No</option>
              </select>
            </div>
            <div data-conv-case="Yess" data-conv-fork="first-question3">
              <input type="text" name="name" data-conv-question="Send your Question to this email thesisquo.helpdesk@gmail.com">
            </div>
          </div>
          <select data-conv-case="Noo" data-conv-question="Thank you for talking me">
            <option value="Yes">Reset</option>
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
<!-- Below is the script for mobile side navigation-->

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>

</html>