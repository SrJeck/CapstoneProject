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
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
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


  <<<<<<< HEAD=======>>>>>>> 90f4f375e660633abf225576b890bd1942767c9f

    <img class="profilepencil" src="images/profile.png">

    <div class="container">
      <form action="registration_insert.php" method="post" enctype="multipart/form-data">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" placeholder="First name">

        <label for="middleName">Middle Name (Optional):</label>
        <input type="text" id="middleName" name="middleName" placeholder="Middle name">

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" placeholder="Last name">
        <<<<<<< HEAD <label for="phoneNum">Phone Number:</label>
          <input type="text" id="phoneNum" name="phoneNumber" placeholder="Email or Username">

          =======

          <label for="phoneNum">Phone Number:</label>
          <input type="text" id="phoneNum" name="phoneNumber" placeholder="Email or Username">

          >>>>>>> 90f4f375e660633abf225576b890bd1942767c9f
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" placeholder="Address">

          <label for="birthday">Birthday:</label></br>
          <<<<<<< HEAD <input type="date" id="birthday" name="birthday"></br>

            <label for="sex">Sex:</label></br>
              <label for="male"><input type="radio" id="male" name="sex" value="Male">Male</label><br>
              <label for="female"><input type="radio" id="female" name="sex" value="Female">Female</label><br>

            <label for="degree">Degree:</label>
            <select name="degree" id="degree">
              <option value="" disabled selected>Choose option</option>
              =======
              <input type="date" id="birthday" name="birthday"></br>

              <label for="sex">Sex:</label></br>
                <label for="male"><input type="radio" id="male" name="sex" value="Male">Male</label><br>
                <label for="female"><input type="radio" id="female" name="sex" value="Female">Female</label><br>

              <label for="degree">Degree:</label>
              <select name="degree" id="degree">
                <option value="" disabled selected>Choose option</option>
                >>>>>>> 90f4f375e660633abf225576b890bd1942767c9f
                <option value="Undergraduate Degree">Undergraduate Degree</option>
                <option value="Transfer Degree">Transfer Degree</option>
                <option value="Associate Degree">Associate Degree</option>
                <option value="Bachelor Degree">Bachelor Degree</option>
                <option value="Graduate Degree">Graduate Degree</option>
                <option value="Master Degree">Master Degree</option>
                <option value="Doctoral Degree">Doctoral Degree</option>
                <option value="Professional Degree">Professional Degree</option>
                <option value="Specialist Degree">Specialist Degree</option>
                <<<<<<< HEAD </select>
                  =======
              </select>
              >>>>>>> 90f4f375e660633abf225576b890bd1942767c9f

              <label for="email">Email:</label>
              <input type="text" id="email" name="email" placeholder="Email">

              <label for="pass">Password:</label>
              <input type="text" id="pass" name="pass" placeholder="Password">

              <label for="confirmPass">Confirm Password:</label>
              <input type="text" id="confirmPass" name="confirmPass" placeholder="Confirm Password">

              <button class="submit" type="submit" value="Submit"> Submit</button>
              <button class="login" type="login" value="Login"> Login</button>
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