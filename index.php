<?php
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 8/31/2021 -->
<html>
  <head>
    <script type ="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <!-- ChatBot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.convform.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
  </head>
<body>
  <!-- SIDEBAR -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">HOME</a>
    <a href="#">JOURNALS</a>
    <a href="#">ANALYTICS</a>
    <a href="#">PLAGIARISM CHECKER</a>
  </div>

  <!-- NAVBAR -->
  <div class="navbar">
    <a onclick="openNav()"><i onclick="openNav()" style="font-size: 28px" class="fa fa-bars" id="mySidebar"></i></a>
    <a href="#"><img style="height: 25px;" src="images/libraryLogo.png"></a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>

  <!-- HEADER IMAGE -->
  <img class="bg" src="images/bookreadbackground.JPG">

  <!-- SEARCH BAR CONTAINER -->
  <div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div>
            <div class="form"> 
            <select style="font-size:13px" class="topic" name="cars" id="cars">
              <option value="" selected disabled hidden>Topic</option>
              <option style="font-size:17px" value="volvo">Education</option>
              <option style="font-size:17px" value="saab">Technology</option>
              <option style="font-size:17px" value="opel">Research</option>
              <option style="font-size:17px" value="audi">Analysis</option>
              <option style="font-size:17px" value="audi">Database</option>
            </select>
            <input type="text" id="speechToText" class="form-control form-input" placeholder="Enter your search here"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button">Search</button>
          </div>
        </div>
    </div>
   </div>

  <!-- INTRODUCTION -->
    <h2 style="margin-left: 320px;">Whats's New?</h2>
    <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor. 
    Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt. 
    Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi. 
    Phasellus sit amet dolor elementum, varius mauris in, commodo mauris. In eu nunc justo.
    </p>

  <!-- IMAGES -->
  <div class="images">
    <img class="book" src="images/book.JPG">
    <button class="btn">Education</button>
    <img class="chip" src="images/chip.JPG">
    <button class="btn2">Technology</button>
    <img class="business" src="images/business.JPG">
    <button class="btn3">Business</button>
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
        <option value="DigitalMarketing">Digital Marketing ?</option>
      </select>

      <div data-conv-fork="category">
        <div data-conv-case="WebDevelopment">
          <input type="text" name="domainName" data-conv-question="Please, tell me your domain name">    
        </div>
        <div data-conv-case="DigitalMarketing" data-conv-fork="first-question2">
          <input type="text" name="companyName" data-conv-question="Please, enter your company name"> 
        </div>
      </div>

      <input type="text" name="name" data-conv-question="Please, Enter your name">

      <input type="text" data-conv-question="Hi {name}, <br> It's a pleasure to meet you." data-no-answer="true">

      <input data-conv-question="Enter your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" name="email" required placeholder="What's your e-mail?">

      <select data-conv-question="Please Conform">
        <option value="Yes">Conform</option>
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

