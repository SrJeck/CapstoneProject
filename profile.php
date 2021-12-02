<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>

<head>
  <title>Profile</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/profilestyle.css">
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
    <a href="index.php"><img style=" height: 25px;" src="images/Logo.png"></a>
    <a style="margin-top: 5px;" href="index.php">HOME</a>
    <a style="margin-top: 5px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 5px;" href="analytics.php">ANALYTICS</a>
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>


  <div class="side">
    <a href="editprofile.php"><i class="fa fa-pencil"> <b>Edit Profile </b> &#xf105;</i></a>
    <a href="security.php"><i class='fas fa-user-shield' style="bold:none;"> Password</i></a>
    <a href="add_article.php"><i class='fa fa-plus'><b> Add Article</b></i></a>

  </div>
  <img class="profilepencil" src="images/profilepencil.png">

  <div class="editform">
    <form action="/action_page.php" id="editform">

      <table>


        <!-- populate table from mysql database -->
        <?php

        $stat = $dbh->prepare('select * from user where user_id=?');
        $stat->bindParam(1, $id);
        $stat->execute();
        $row = $stat->fetch();
        ?>

        <tr class="displayRow">
          <td>
            <div class="name">
              <label for="">First Name</label>
              <p class="fname"><?php echo $row['firstName']; ?></p>
              <label for="">Middle Name</label>
              <p class="mname"><?php echo $row['middleName']; ?></p>
              <label for="">Last Name</label>
              <p class="lname"><?php echo $row['lastName']; ?></p>
            </div>
            <div class="emailrow">
              <label>Email</label>
              <p class="email"><?php echo $row['email_address']; ?></p>
            </div>
            <div class="addressrow">
              <label class="labeladdress">Address</label>
              <p class="address"><?php echo $row['homeAddress']; ?></p>
            </div>
            <div class="displayrow2">
              <label for="">Contact Number</label>
              <p class="pnumber"><?php echo $row['contactNumber']; ?></p>
              <label class="labelsex">Sex</label>
              <p class="sex"><?php echo $row['sex']; ?></p>
            </div>
            <div class="displayrow3">
              <label>Degree Status</label>
              <p class="degree_status"><?php echo $row['degree_status']; ?></p>
              <label class="labelbirthday">Birthday</label>
              <p class="birthday"><?php echo $row['birthday']; ?></p>
            </div>
          </td>
        </tr>
      </table>
    </form>
    <div class="vl"></div>

  </div>
  <div class="table">
    <table>
      <thead>
        <t>
          <th class="th">Title</th>
          <th class="th">Topic</th>
          <th class="th">Author</th>
          <th class="th">Duplicate Title Count</th>
          <th class="th">Year</th>
          <th class="th">Status</th>
          </tr>
      </thead>

      <?php



      $new_stat = $dbh->prepare('select * from research where user_id=?');
      $new_stat->bindParam(1, $id);
      $new_stat->execute();
      while ($new_row = $new_stat->fetch()) {
        $title = $new_row["title"];
        $dupli_count = $dbh->prepare('select count(*) as total_count from research where title=?');
        $dupli_count->bindParam(1, $title);
        $dupli_count->execute();
        $total_count = $dupli_count->fetch();
        $count = 0;
        if ($total_count["total_count"] > 1) {
          $count = $total_count["total_count"];
        }
        echo '<tbody><tr >
        <td class="td">' . $new_row["title"] . '</td>
        <td class="td">' . $new_row["topic"] . '</td>
        <td class="td">' . $new_row["author"] . '</td>
        <td class="td">' . $count . '</td>
        <td class="td">' . $new_row["publication_year"] . '</td>
        <td class="td">' . $new_row["upload_status"] . '</td>
      </tr></tbody>';
      }


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