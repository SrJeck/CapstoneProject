<?php
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>
  <head>
    <script type ="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
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

  <!-- HEADER IMAGE -->
  <img class="bg" src="images/bookreadbackground.JPG">
  <div class="container">
      <h3 align="center">Live Data Search with Pagination in PHP Mysql using Ajax</h3>
      <br />
      <div class="card">
        <div class="card-header">Dynamic Data</div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
            <input type="submit" name="search" value="Filter"><br><br>
          </div>
          <div class="table-responsive" id="dynamic_content">
            
          </div>
        </div>
      </div>
    </div>
    <script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>
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
            <input type="text" id="speechToText" class="form-control form-input" placeholder="Enter your search here"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button">Search</button>
          </div>
        </div>
    </div>
   </div>

  <!-- INTRODUCTION -->
    <h2 class="new" >Whats's New?</h2>
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

