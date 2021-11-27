<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>

<head>
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
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  }
  ?>

  <!-- BANNER IMAGE -->
  <img class="bg" src="images/bookreadbackground.JPG">

  <!-- SEARCH BAR CONTAINER -->
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
          <input type="text" id="speechToText" class="form-control form-input" placeholder="Search ThesisQuo"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button">Search</button>
        </div>
      </div>
    </div>
  </div>
  <div>
    <table>
      <?php
      $stat = $dbh->prepare('select * from bookmark where user_id=?');
      $stat->bindParam(1, $id);
      $stat->execute();
      while ($rows = $stat->fetch()) {
        $thesis_id = $rows['id'];
        $new_stat = $dbh->prepare('select * from journal where id=?');
        $new_stat->bindParam(1, $thesis_id);
        $new_stat->execute();
        $thesis = $new_stat->fetch();
        echo '

        <tr  class="bookmarkRow">
        <a class="displayBookmark" target="_blank" href="display.php?id=' . $thesis['id'] . '">
        <td><i style="font-size:80px" class="fa">&#xf0f6;</i></td>
        <td>' . $thesis['title'] . '</td>
        <td>' . $thesis['author'] . '</td>
        <td>' . $thesis['publication_month'] . " " . $thesis['publication_day'] . ", " . $thesis['publication_year'] . '</td>
        <td>' . $thesis['affiliation'] . '</td>
        <td>' . $thesis['degree_level'] . '</td>
        <td>' . $thesis['topic'] . '</td>
        <td>' . $thesis['research_type'] . '</td>
        <td>' . $thesis['publisher'] . '</td></a>
        <td><a href="remove_bookmark.php?thesis_id=' . $thesis['id'] . '" class="view btn-lg">
        <span class="fa fa-bookmark-o"> Remove Bookmark</span>
      </a></td>
        </tr>
        
        ';
      }


      //   <tr class="bookmarkRow">

      //   <td> <br>
      //     <a class="displayBookmark" target="_blank" href="display.php?id='.$thesis['id'].'"><i style="font-size:80px" class="fa">&#xf0f6;</i>
      //       <p style="margin-left: 90px; margin-top: -90px;">' . $thesis['title'] . '</p>
      //       <p style="margin-left: 90px; ">' . $thesis['topic'] . '</p>
      //       <p style="margin-left: 90px; ">
      //         <p style="margin-left: 90px; ">' . $thesis['title'] . '</p>
      //         <p style="margin-left: 90px; ">' . $thesis['author'] . '</p>
      //         <p style="margin-left: 90px; ">' . $thesis['publication_month'] ." " . $thesis['publication_day'] .", " . $thesis['publication_year'] . '</p>
      //         <p style="margin-left: 90px; ">' . $thesis['publisher'] . '</p>
      //         <hr style="border: 1px solid black;">
      //     </a>
      //   </td>
      //   <td><a href="remove_bookmark.php?thesis_id=' . $thesis['id'] . '" class="view btn-lg">
      //   <span class="fa fa-bookmark-o"> Remove Bookmark</span>
      //   </a></td>

      // </tr>

      ?>
    </table>

  </div>


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