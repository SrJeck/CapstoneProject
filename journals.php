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
    <a style="margin-top: 5px;" href="index.php">HOME</a>
    <a style="margin-top: 5px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 5px;" href="#">ANALYTICS</a>
    <a style="margin-top: 5px;" href="plagiarismchecker.php">PLAGIARISM CHECKER</a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>

  <!-- HEADER IMAGE -->
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
            <input type="text" id="speechToText" class="form-control form-input" placeholder="Enter your search here"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button">Search</button>
          </div>
        </div>
    </div>
   </div>


   <?php

//Enter your host configuration here in my case it is root

$conn = mysqli_connect('localhost', 'root', '');

if (!$conn){

    die("Database conn Failed" . mysqli_error($conn));

}

//Enter yoour database name here in my case i am using pagination.

$select_db = mysqli_select_db($conn, 'journal');

if (!$select_db){
    die("Database Selection Failed" . mysqli_error($conn));

}
/*************************************************************/

$recordperpage = 3;
if(isset($_GET['page']) & !empty($_GET['page'])){

$currentpage = $_GET['page'];
}else{

$currentpage = 1;
}
$recordSkip = ($currentpage * $recordperpage) - $recordperpage;
$query1 = "SELECT * FROM `research`";
$totalpageCounted = mysqli_query($conn, $query1);
$totalresult = mysqli_num_rows($totalpageCounted);

$lastpage = ceil($totalresult/$recordperpage);
$recordSkippage = 1; $nextpage = $currentpage + 1;
$previouspage = $currentpage - 1;
//It will select only required pages from database
$query2 = "SELECT * FROM `research` LIMIT $recordSkip, $recordperpage";
$res = mysqli_query($conn, $query2);
?>

<center>
<div class="container">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

 <div class="row">
 <table class="table ">

 <tbody>
 <?php

    while($r = mysqli_fetch_assoc($res)){
 ?>
  <tr>
     <td><i class='far fa-file-alt' style="font-size: 100px; "></i><p style="margin-left: 90px; margin-top: -90px;"><?php echo $r['Research_Type']; ?></p><p style="margin-left: 90px; "><?php echo $r['Title']; ?></p><p style="margin-left: 90px; "><p style="margin-left: 90px; "><?php echo $r['Author']; ?></p><p style="margin-left: 90px; "><?php echo $r['Publication_Date']; ?></p></td>
  </tr>

    <?php } ?>

   </tbody>

  </table>

 </div> 
 
  
 <nav aria-label="Page navigation">
  <ul class="pagination" style="list-style-type: none; white-space:nowrap; ">
   <?php if($currentpage != $recordSkippage){ ?>     <li class="page-item">
      <a class="page-link" href="?page=<?php echo $recordSkippage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($currentpage >= 5){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?page=<?php echo $currentpage ?>"><?php echo $currentpage ?></a></li>
    <?php if($currentpage != $lastpage){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $lastpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
     </li>
     <?php } ?>
    </ul>
   </nav>
  </div>
  </center>
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

