<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
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
      <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  } else {
    echo '<div class="navbar">
      <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
      <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
      <a style="margin-top: 6px;" href="#">ANALYTICS</a>
      <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
      <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
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