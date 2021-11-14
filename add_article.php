<?php
?>
<!-- START DATE 8/28/2021 -->
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
  <link rel="stylesheet" type="text/css" href="css/add_article.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <!-- NAVBAR -->
  <div class="navbar">
    <a href="#"><img style="height: 25px;" src="images/libraryLogo.png"></a>
    <a style="margin-top: 5px;" href="index.php">HOME</a>
    <a style="margin-top: 5px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 5px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>


  <!-- Form -->
  <br>
  <form action="insert.php" method="post" enctype="multipart/form-data">
    <span class="row">
      <span class="col-25">
        <label>Title:</label>
      </span>
      <span class="col-75">
        <input type="text" name="title">
      </span>
      <span class="col-25">
        <label>Authors:</label>
      </span>
      <span class="col-75">
        <input type="text" name="author" placeholder="Ex. Pineda, Dizon, Ramos, Reyes">
      </span>
    </span>
    <div class="inline">
      <label class="test" for="name">Publication Date:</label>
      <span></span>
      <input class="test2" type="text" id="name" name="publication_month" placeholder="Month (ex. Jan, Feb, March)" />
      <input class="test2" type="text" id="address" name="publication_day" placeholder="Day (ex. 10, 22, 29)" />
      <input class="test2" type="text" id="address" name="publication_year" placeholder="Year (ex. 2021, 2022, 2023)" />
    </div>
    <span class=" row">

      <span class="col-25">
        <label>Institution:</label>
      </span>
      <span class="col-75">
        <input type="text" name="institution">
      </span>
      <span class="col-25">
        <label>Affiliation:</label>
      </span>
      <span class="col-75">
        <input type="text" name="affiliation">
      </span>
      <span class="col-25">
        <label>Degree Level:</label>
      </span>
      <span class="col-75">
        <select name="degree_level" id="degree">
          <option value="" selected disabled hidden>Select degree level</option>
          <option value="Professional Certificates">Professional Certificates</option>
          <option value="Undergraduate Degrees">Undergraduate Degrees</option>
          <option value="Transfer Degrees">Transfer Degrees</option>
          <option value="Associate Degrees">Associate Degrees</option>
          <option value="Bachelor Degrees">Bachelor Degrees</option>
          <option value="Graduate Degrees">Graduate Degrees</option>
          <option value="Master Degrees">Master Degrees</option>
          <option value="Doctoral Degrees">Doctoral Degrees</option>
          <option value="Professional Degrees">Professional Degrees</option>
          <option value="Others">Others</option>
        </select>
      </span>
      <span class="col-25">
        <label>Research Type:</label>
      </span>
      <span class="col-75">
        <input type="text" name="research_type" value="Thesis" readonly>
      </span>
      <span class="col-25">
        <label>Abstract:</label>
      </span>
      <span class="col-75">
        <textarea type="text" name="abstract" rows="7" cols="50"></textarea>
      </span>
      <span class="col-25">
        <label>Citation:</label>
      </span>
      <span class="col-75">
        <input type="text" name="citation">
      </span>
      <span class="col-25">
        <label>Keywords:</label>
      </span>
      <span class="col-75">
        <input type="text" name="keywords">
      </span>
      <span class="col-25">
        <label>Publisher:</label>
      </span>
      <span class="col-75">
        <input type="text" name="publisher">
      </span>
      <span class="col-25">
        <label>Permission Type:</label>
      </span>
      <span class="col-75">
        <input type="radio" id="view_only" name="permission" value="View Only">
        <label>View Only</label>
        <input style="margin-left: 20px;" type="radio" id="download_only" name="permission" value="Download Only">
        <label>Download Only</label>
        <input style="margin-left: 20px;" type="radio" id="view_download" name="permission" value="View and Download">
        <label>View and Download</label><br>
      </span>
    </span>
    </span>
    <div class="file-upload">
      <input class="file-upload__input" type="file" name="myfile" accept="application/pdf" id="myFile" multiple>
      <button class="file-upload__button" type="button">Choose File(s)</button>
      <span class="file-upload__label"></span>
      <script type="text/javascript" src="js/custom.js"></script>
    </div>
    <button class="submit" type="submit" name="submit">Submit</button>
  </form>
  </div>
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