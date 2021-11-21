<?php

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
  <div class="navbar">
    <a href="#"><img style="height: 25px;" src="images/libraryLogo.png"></a>
    <a style="margin-top: 5px;" href="#">HOME</a>
    <a style="margin-top: 5px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 5px;" href="#">ANALYTICS</a>
    <a style="margin-top: 5px;" href="plagiarismchecker.php">PLAGIARISM CHECKER</a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">HOME</a>
    <a href="journals.php">JOURNALS</a>
    <a href="#">ANALYTICS</a>
    <a href="#">PLAGIARISM CHECKER</a>
  </div>
  <span style="font-size:35px;cursor:pointer;display: block;background-color:#751518;color:white;" onclick="openNav()">&#9776;</span>


  <!-- Form -->
  <br>
  <form action="insert.php" method="post">
    <label>Title:</label><input type="text" name="title"><br>
    <label>Authors:</label><input type="text" name="author"><br>
    <label>Research Type:</label><input type="text" name="research_type"><br>
    <label>Institution:</label><input type="text" name="institution"><br>
    <label>Publication Date:</label><input type="date" name="publication_date"><br>
    <label>Publisher:</label><input type="text" name="publisher"><br>
    <label>Upload File:</label><input type="file" name="file_upload"><br>
    <button type="submit" name="submit">Submit</button>
  </form>


  <!-- ChatBot -->
  <div class="chat_icon">
    <img style="height: 80px;" src="images/chatboticon.png">
  </div>

  <div class="chat_box">
    <div class="my-conv-form-wrapper">
      <form action="" method="GET" class="hidden">

        <select data-conv-question="Hello! How can I help you" name="category">
          <option value="WebDevelopment">Website Development ?</option>
          <option value="ThesisQuoForum">Digital Marketing ?</option>
        </select>

        <div data-conv-fork="category">
          <div data-conv-case="WebDevelopment">
            <input type="text" name="domainName" data-conv-question="Please, tell me your domain name">
          </div>
          <div data-conv-case="ThesisQuoForum" data-conv-fork="first-question2">
            <input type="text" name="companyName" data-conv-question="Please, enter your company name">
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
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>

</html>