<?php
$conn = mysqli_connect('localhost', 'root', '', 'journal');

if(isset($_POST['submit'])){

    if(!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['publication_date']) && !empty($_POST['research_type']) && !empty($_POST['institution'])  && !empty($_POST['publisher'])){
     
      $title = $_POST['title']; 
      $author = $_POST['author']; 
      $publication_date = $_POST['publication_date']; 
      $research_type = $_POST['research_type']; 
      $file_upload = $_POST['file_upload']; 
      $institution = $_POST['institution']; 
      $publisher = $_POST['publisher']; 

      $upload_dir = '/images';

      $query = "insert into research(title,author,publication_date,research_type,file_upload,institution,publisher) values('$title','$author','$publication_date','$research_type','$file_upload','$institution','$publisher')";

      $run = mysqli_query($conn,$query) or die(mysqli_error());

      if($run){
      }
      else{
        echo "Form not Submitted";
      }
    }
    else{
      echo "All fields are required";
    }
  }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
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
    <a style="margin-top: 5px;" href="#">PLAGIARISM CHECKER</a>
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


<button class="scanbutton">Scan for Plagiarism</button>
<button class="filebutton">Upload a file</button>

<div class="check"><div>

<div style="display: flex; margin-top: 80px;">
<p class="text1">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor. Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt. Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi. Phasellus sit amet dolor elementum, varius mauris in, commodo mauris. In eu nunc justo.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor. Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt. Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi. Phasellus sit amet dolor elementum, varius mauris in, commodo mauris. In eu nunc justo.
</p>
<p class="text2">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor. Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt. Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi. Phasellus sit amet dolor elementum, <b style="color:red;">varius mauris in, commodo mauris. In eu nunc justo.
Lorem ipsum dolor sit amet,</b> consectetur adipiscing elit. Nullam maximus sagittis sapien eget porttitor. Curabitur nec lorem luctus, ultrices libero et, fringilla dui. Nam porttitor sapien eget sollicitudin tincidunt. Etiam tortor risus, lobortis vitae turpis a, imperdiet congue libero. Etiam et nulla sed magna viverra pretium id at nisi. Phasellus sit amet dolor elementum, varius mauris in, commodo mauris.  In eu nunc justo.
</p>
</div>
<!--<input type="file" id="myPdf" /><br>
<center><canvas id="pdfViewer" ></canvas></center>
<script type="text/javascript" src="script.js"></script>-->
<h3 style="margin-left: 35px;">Results:<h3>

<div class="circle" style="display: flex; ">
<div class="unique">90%</div><p style="font-weight:bold; margin-top:20px">UNIQUE</p>
<div class="plagiarized">10%</div><p style="font-weight:bold; margin-top:20px">Plagiarized</p>
<div class="checked">100%</div><p style="font-weight:bold;">COMPLETED: 100% CHECKED</p>
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

