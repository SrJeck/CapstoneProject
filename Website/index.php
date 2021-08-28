<?php
?>
<!-- START DATE 8/28/2021 -->
<html>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body>
  <!-- NAVBAR -->
  <div class="navbar">
    <a><i style="font-size: 28px" class="fa fa-bars"></i></a>
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
            <input type="text" class="form-control form-input" placeholder="Enter your search here"> <span class="left-pan"><i class="fa fa-microphone"></i></span> <button class="button">Search</button>
          </div>
        </div>
    </div>
   </div>
     <!-- INTRODUCTION -->
<h2 style="margin-left: 320px;">What's New?</h2>
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
</body>
</html>

