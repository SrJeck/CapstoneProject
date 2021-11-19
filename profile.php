<?php
$dbh = new PDO("mysql:host=localhost;dbname=research","root","");
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
    <a href="index.php"><img style="height: 25px;" src="images/libraryLogo.png"></a>
    <a style="margin-top: 5px;" href="index.php">HOME</a>
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
        <td><i class='far fa-file-alt' style="font-size: 100px; "></i>
        <p style="margin-left: 90px; "><?php echo $row['firstName']; ?></p><p style="margin-left: 90px; ">
        <p style="margin-left: 90px; "><?php echo $row['middleName']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['lastName']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['phoneNumber']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['address']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['sex']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['birthday']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['email']; ?></p>
        <p style="margin-left: 90px; "><?php echo $row['degree_status']; ?></p>
        </td>
    </tr>
</table>
    </form>
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

</html>