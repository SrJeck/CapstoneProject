<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

?>
<html>

<head>
  <title>Contact Us</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <link rel="stylesheet" href="css/contactus.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    .number {
      height: 26px;
      width: 24px;
    }

    #dialog {
      display: none;
      position: fixed;
      left: 65.7%;
      top: 10px;
      z-index: 1;
    }

    .txt {
      width: 370px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  
  $notif = "";
  $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
  $total_count = 0;
  $unseen_count = $dbh->prepare('select COUNT(*) as unseen_count from notification where seen_status="unseen" and user_id=?');
  $unseen_count->bindParam(1, $id);
  $unseen_count->execute();
  $unseened_count = $unseen_count->fetch();
  $total_count =$total_count + $unseened_count['unseen_count'];
  $unseen_count2 = $dbh->prepare('select * from inquiry where user_id=? and seen_status="unseen"');
  $unseen_count2->bindParam(1, $id);
  $unseen_count2->execute();
  while ($unseened_count2 = $unseen_count2->fetch()) {
    if (!empty($unseened_count2['reply']) ) {
        $total_count =$total_count + 1;
    }
  }




  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a style="margin-top: 6px;" href="contact_us.php">CONTACT US</a>
    <div class="tooltip">
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <span class="tooltiptext">Logout</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <span class="tooltiptext">Profile</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
    <span class="tooltiptext">Bookmark</span>
    </div>
    <div class="tooltip">
    <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>
    <span class="tooltiptext">Add Article</span>
    </div>
    <div class="tooltip">
    <span class="tooltiptext">Notification</span>
    <a style="float: right;">
    <div class="notBtn" href="#" onclick="seeNotif()">
            <div class="number" > ' . $total_count . ' </div>
            <i style="font-size:24px;height: 25px;" id="showdialog" class="fa fatest">&#xf0f3;</i>
        <div class="box" id="dialog" id="box" style="display:none">
                <div class="display">
                <div class="cont">
                    <!-- Fold this div and try deleting evrything inbetween -->
                    <div class="sec test">
                            <div class="txt"></div>
                    </div>
            </div> 
            </div>
        </div>
    </div>
    </a>
    </div>
</div>
';
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
  <script>
    $("#showdialog").click(function() {
      $(".box").show();
    });
    $(".box .close").click(function() {
      $(this).parent().hide()
    })
  </script>
  <section id="contact">
    <div class="contact-box">
      <div class="contact-links">
        <form action="upload_inquiry.php" method="POST">
          <!-- <div class="form-item">
              <input type="text" name="sender" required>
              <label>Name:</label>
            </div> -->
          <div class="form-item">
            <input type="text" name="email" required>
            <label>From Email:</label>
          </div>
          <div class="form-item">
            <input type="text" name="subject" required>
            <label>Subject:</label>
          </div>
          <div class="form-item">
            <textarea class="" name="message" required></textarea>
            <label>Message:</label>
          </div>
          <button class="submit-btn" name='send'>Send</button>
        </form>
      </div>

      <div class="contact-form-wrapper">
        <h2>CONTACT US</h2><br><br><br><br><br>
        <i style="color:white; margin-left:25px" class="fa fa-envelope"></i>
        <h4><em><u><a style="cursor: pointer; text-decoration:none; color:white;" target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=thesisquo.helpdesk@gmail.com">thesisquo.helpdesk@gmail.com</a></u></em>
        </h4>
      </div>
    </div>
  </section>
  <!-- ChatBot -->
  <div class="chat_icon">
    <img style="height: 80px;" src="images/chatboticon.png">
  </div>

  <div class="chat_box">
    <div class="my-conv-form-wrapper">
      <br><br>
      <div class="div-questions">
        <button class="questions" style="display:block" onclick="questionType(1)">How to Upload Study?</button>
        <button class="questions" style="display:block" onclick="questionType(2)">What study would you recommend for me to read?</button>
        <button class="questions" style="display:block" onclick="questionType(3)">What study topic can i develop?</button>
      </div>
      <div class="answer1" id="answer1" style="display:none">You must have an account before you upload your papers, if you are already a member, you may follow these steps:
        <br><br>
        1. Click the add (+) button on the navigation bar to upload your papers
        <br>
        2. Fill out the fields required by the admin to upload paper.
        <br>
        3. Read and Accept the Privacy Policy & Terms and Condition before submitting the paper.
        <br>
        4. Wait for the Plagiarism result if accepted or not.
        <br>
        5. If the paper passed the Plagiarism test, the paper will be upload. if not, the User must revise and re-upload the paper.
        <br><br><br>
      </div>
      <button class="answer1" id="reset" style="display:none" onclick="reset()">Reset</button>
      <select class="answer2 custom-select" style="display:none" name="topic" id="topic" required>
        <option value="" selected disabled hidden>Select topic type</option>
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

      <button class="answer2 select" style="display:none" onclick="selectedTopic()">Select</button>
      <div class="analyticsResult" style="display:none">I Recommend these studies:
      </div>
      <div class="questionbutton">
        <button class="analyticsResult" id="analyticsResultbutton" style="display:none" onclick="analyticsQuestionType(1)">Do you want another question suggestion from other topics?</button>
        <button class="analyticsResult" id="analyticsResultbutton2" style="display:none" onclick="analyticsQuestionType(2)">Do you have any specific question for me?</button>
      </div>
      <button class="analyticsAnswer1" id="no" style="display:none" onclick="analyticsAnswerType('no')">No</button>
      <button class="analyticsAnswer1" id="yes" style="display:none" onclick="analyticsAnswerType('yes')">Yes</button>
      <div class="analyticsAnswer2" style="display:none">Send your Question to this email thesisquo.helpdesk@gmail.com</div>
      <button class="analyticsAnswer2" id="reset" style="display:none" onclick="reset()">Reset</button>
      <div class="answer3" id="answer3" style="display:none">What do you want to develop?</div>
      <button class="answer3" id="opt" style="display:none" onclick="developmentType(1)">Uniqie Study</button>
      <button class="answer3" id="opt" style="display:none" onclick="developmentType(2)">More Resources Available</button>
      <div class="development1" style="display:none">Show overall Lowest number of uploaded topic</div>
      <div class="development2" style="display:none">Show overall Highest number of uploaded topic</div>
      <div class="development" id="specific" style="display:none">Do you have any specific question for me?</div>
      <button class="development" style="display:none" onclick="developmentAnswerType('no')">No</button>
      <button class="development" style="display:none" onclick="developmentAnswerType('yes')">Yes</button>
      <div class="developmentQuestions" id="question2" style="display:none">Send your Question to this email thesisquo.helpdesk@gmail.com</div>
      <button class="developmentQuestions" id="developmentQuestions" style="display:none" onclick="reset()">Ok</button>
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