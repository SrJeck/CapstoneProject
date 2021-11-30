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
$href = 'research.php';

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
  <title>Research</title>

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
  <style>
    .grid-container {
      display: grid;
      grid-column-gap: 100px;
      grid-template-columns: auto auto auto;
      padding: 10px;
    }

    .grid-item {
      border: 1px solid #e7e7e7;
      border-radius: 6px;
      background-color: white;
      box-shadow: 6px 6px 8px 0 #f2eff2;
      padding: 10px;
      font-size: 30px;
      text-align: left;
      width: 40%;
    }


    .sorted {
      font-size: 20px;
      font-family: Arial, Helvetica, sans-serif;
      color: #585858;
    }

    .sortby {
      width: 153;
      height: 35;
      padding: 6px 12px;
      box-shadow: 0 2px 0 rgb(0 0 0 / 8%);
      font-size: 14px;
      border-radius: 5px;
    }

    .selecttopic {
      width: 153;
      height: 35;
      padding: 6px 12px;
      box-shadow: 0 2px 0 rgb(0 0 0 / 8%);
      font-size: 14px;
      border-radius: 5px;
    }

    .apply {
      background-color: #157572;
      border: none;
      color: white;
      padding: 10px 18px;
      text-align: right;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  }
  ?>

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

    <center>

      <form name="frmSearch" method="post" action="research.php">
        <div class="container">
          <div class="row height d-flex justify-content-center align-items-center">
            <div>
              <div class="form">
                <input type="text" id="speechToText" class="form-control form-input" name="search[title]" placeholder="Search ThesisQuo" value="<?php echo $title; ?>"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button" name="go">Search</button>
              </div>
            </div>
          </div>
        </div>
        <div class="grid-container">
          <div class="grid-item">
            <h3 class="sorted">Sorted By</h3>
            <select class="sortby">
              <option selected="selected" value="relevance">Relevance</option>
              <option value="DateAsc">Newest-Oldest</option>
              <option value="DateDesc">Oldest-Newest</option>
              <option value="title">Title</option>
              <option value="author">Author</option>
            </select>
            <hr>
            <h3 class="sorted">Topic</h3>
            <select name="topic" id="topic" class="selecttopic">
              <option value="" selected disabled hidden>Select topic</option>
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
            <hr>
            <h3 class="sorted">Publication Date</h3>
            <p style="font-size: 14px;">From:</p>
            <input type="text" class="fromDate" value="2019"><br>
            <p style="font-size: 14px;">To:</p>
            <input type="text" class="toDate" value="2021">
            <br><br>
            <button type="submit" class="apply">Apply Filters</button>
            <br><br>
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