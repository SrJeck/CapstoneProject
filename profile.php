<?php
$dbh = new PDO("mysql:host=localhost;dbname=research", "root", "");
$id = $_GET['user_id'];
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
    <a href="index.php?user_id=<?php echo $id; ?>"><img style=" height: 25px;" src="images/Logo.png"></a>
    <a style="margin-top: 5px;" href="index.php?user_id=<?php echo $id; ?>">HOME</a>
    <a style="margin-top: 5px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 5px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>


  <div class="side">
    <a href="editprofile.php?user_id=<?php echo $id; ?>"><i class="fa fa-pencil"> <b>Edit Profile </b> &#xf105;</i></a>
    <a href="security.php?user_id=<?php echo $id; ?>"><i class='fas fa-user-shield' style="bold:none;"> Password</i></a>
    <a href="add_article.php?user_id=<?php echo $id; ?>"><i class='fa fa-plus'><b> Add Article</b></i></a>

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
              <p class="email"><?php echo $row['email']; ?></p>
            </div>
            <div class="addressrow">
              <label class="labeladdress">Address</label>
              <p class="address"><?php echo $row['address']; ?></p>
            </div>
            <div class="displayrow2">
              <label for="">Contact Number</label>
              <p class="pnumber"><?php echo $row['phoneNumber']; ?></p>
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
  <table class="table">
    <tr class="tr">
      <th class="th"><input type="checkbox"></th>
      <th class="th">Title</th>
      <th class="th">Published By</th>
      <th class="th">Year</th>
    </tr>
    <tr class="tr">
      <td class="td"><input type="checkbox"></th>
      <td class="td">Game of Codes</td>
      <td class="td">Mohammed Morad</td>
      <td class="td">2021</td>
    </tr>
    <tr class="tr">
      <td class="td"><input type="checkbox"></th>
      <td class="td">Game of Codes</td>
      <td class="td">Mohammed Morad</td>
      <td class="td">2020</td>
    </tr>
    <tr class="tr">
      <td class="td"><input type="checkbox"></th>
      <td class="td">Game of Codes</td>
      <td class="td">Mohammed Morad</td>
      <td class="td">2019</td>
    </tr>
    <tr class="tr">
      <td class="td"><input type="checkbox"></th>
      <td class="td">Game of Codes</td>
      <td class="td">Mohammed Morad</td>
      <td class="td">2018 </td>
    </tr>
  </table>

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