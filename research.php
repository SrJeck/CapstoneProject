<?php
session_start();
?>
<html>

<head>
  <title>Search Research</title>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/journals.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

  <script type="text/javascript" src="script.js"></script>

  <style>
    .grid-container {
      display: grid;
      grid-column-gap: 100px;
      grid-template-columns: auto auto auto;
      padding: 10px;
    }

    .grid-item {
      border: 1px solid #e7e7e7;
      border-radius: 6px;
      background-color: white;
      box-shadow: 6px 6px 8px 0 #f2eff2;
      padding: 10px;
      font-size: 30px;
      text-align: left;
      width: 40%;
    }


    .sorted {
      font-size: 20px;
      font-family: Arial, Helvetica, sans-serif;
      color: #585858;
    }

    .sortby {
      width: 153;
      height: 35;
      padding: 6px 12px;
      box-shadow: 0 2px 0 rgb(0 0 0 / 8%);
      font-size: 14px;
      border-radius: 5px;
    }

    .selecttopic {
      width: 153;
      height: 35;
      padding: 6px 12px;
      box-shadow: 0 2px 0 rgb(0 0 0 / 8%);
      font-size: 14px;
      border-radius: 5px;
    }

    .apply {
      background-color: #157572;
      border: none;
      color: white;
      padding: 10px 18px;
      text-align: right;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="index.php">HOME</a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a style="float: right;" href="bookmark.php"><img style="height: 25px;" src="images/bookmark.png"></a>
    <a style="float: right;" href="add_article.php"><img style="height: 25px;" src="images/plussign.png"></a>

    </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="index.php">HOME</a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  }
  ?>

  <!-- BANNER IMAGE -->
  <br>
  <div id="index">
    <div class="slideshow-container">

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban3.png" style="width:100%; height: 430px;">
      </div>

      <div class="mySlides fade">
        <img src="images/Ban1.png" style="width:100%; height: 430px;">
      </div>


      <div class="mySlides fade">
        <img src="images/Ban2.png" style="width:100%; height: 430px;">
      </div>

    </div>
    <br>


    <div style="text-align:center">
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
      <span style="display: none;" class="dot"></span>
    </div>
    <script>
      var slideIndex = 0;
      showSlides();

      function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
          slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 3000); // Change image every 3 seconds
      }
    </script>

    <form name="frmSearch" method="post">
      <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
          <div>
            <div class="form">
              <input type="text" id="speechToText" class="form-control form-input" name="search" placeholder="Search ThesisQuo" value="<?php if (isset($_POST["search"])) {
                                                                                                                                          echo $_POST["search"];
                                                                                                                                        }  ?>"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button" name="go">Search</button>
            </div>
          </div>
        </div>
      </div>
      <div class="grid-container">
        <div class="grid-item">
          <h3 class="sorted">Sorted By</h3>
          <select class="sortby" name="sort">
            <option selected="selected" value="" selected disabled hidden>Relevance</option>
            <option value="DESC">Newest-Oldest</option>
            <option value="ASC">Oldest-Newest</option>
          </select>
          <hr>
          <h3 class="sorted">Topic</h3>
          <select name="topic" id="topic" class="selecttopic">
            <option value="" selected disabled hidden>Select topic</option>
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
            <option value="Marketing">Marketing</option>
            <option value="Mechanical">Mechanical</option>
            <option value="Ethics">Ethics</option>
            <option value="Others">Others</option>
          </select>
          <hr>
          <h3 class="sorted">Publication Date</h3>
          <p style="font-size: 14px;">From:</p>
          <input type="text" name="yearFrom" placeholder="Year" class="fromDate" value="<?php if (isset($_POST["yearFrom"])) {
                                                                                          echo $_POST["yearFrom"];
                                                                                        } ?>"><br>
          <p style="font-size: 14px;">To:</p>
          <input type="text" name="yearTo" placeholder="Year" class="toDate" value="<?php if (isset($_POST["yearTo"])) {
                                                                                      echo $_POST["yearTo"];
                                                                                    } ?>">
          <br><br>
          <button type="submit" class="apply">Apply Filters</button>
          <br><br>
        </div>
      </div>


    </form>
    <?php
    if (!empty($_POST["topic"])) {
      $topic = $_POST["topic"];
      $topic2 = $_POST["topic"];
    }
    if (!empty($_POST["yearFrom"])) {
      $yearFrom = $_POST["yearFrom"];
      $yearFrom2 = $_POST["yearFrom"];
    }




    $query = "";
    $sort = " ORDER BY publication_year DESC";
    $yearTo = date("Y");
    $between = "";
    $table = "</table>";
    $query2 = "";
    $sort2 = " ORDER BY publication_year DESC";
    $yearTo2 = date("Y");
    $between2 = "";
    $counted = 0;
    $limit = "3";
    $test = "<table class='formview'>
";
    if (!empty($_POST["search"])) {
      $query = "SELECT COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%" . $_POST["search"] . "%') OR (upload_status IN ('posted') AND title LIKE '%" . $_POST["search"] . "%') OR (upload_status IN ('posted') AND author LIKE '%" . $_POST["search"] . "%')";
      $query2 = "SELECT *FROM research  WHERE (upload_status IN ('posted') AND topic LIKE '%" . $_POST["search"] . "%') OR (upload_status IN ('posted') AND title LIKE '%" . $_POST["search"] . "%') OR (upload_status IN ('posted') AND author LIKE '%" . $_POST["search"] . "%')";

      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    // if (empty($_POST["search"]) && empty($_POST["topic"]) && empty($_POST["sort"]) && empty($_POST["yearFrom"]) && empty($_POST["yearTo"])) {
    //   $test = "<span class='noFound'>Please enter a query in the search box above. </span>";
    //   unset($_SESSION['search_session1']);
    //   unset($_SESSION['search_session2']);
    // }
    if (!empty($_POST["topic"])) {
      $query = "SELECT COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%" . $_POST["topic"] . "%')";
      $query2 = "SELECT * FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%" . $_POST["topic"] . "%')";
      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    if (isset($_POST["uploader"])) {
      $query = "select COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') and user_id like '%" . $_POST["uploader"] . "%')";
      $query2 = "select * FROM research WHERE (upload_status IN ('posted') AND user_id LIKE '%" . $_POST["uploader"] . "%')";
      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    if (isset($_POST["Education"])) {
      $query = "SELECT COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Education%')";
      $query2 = "SELECT * FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Education%')";
      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    if (isset($_POST["Technology"])) {
      $query = "SELECT COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Technology%')";
      $query2 = "SELECT * FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Technology%')";
      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    if (isset($_POST["Business"])) {
      $query = "SELECT COUNT(*) AS counted FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Business%')";
      $query2 = "SELECT * FROM research WHERE (upload_status IN ('posted') AND topic LIKE '%Business%')";
      $_SESSION['search_session1'] = $query;
      $_SESSION['search_session2'] = $query2;
    }
    if (!empty($_POST["yearFrom"])) {
      if (!empty($_POST["yearTo"])) {
        $yearTo = $_POST["yearTo"];
        $between = " AND publication_year BETWEEN " . $yearFrom  . " AND " . $yearTo;
        $sort = " ORDER BY publication_year ASC";
        $yearTo2 = $_POST["yearTo"];
        $sort2 = " ORDER BY publication_year ASC";
        $between2 = " AND  publication_year BETWEEN " . $yearFrom . " AND " . $yearTo2;
      } else {
        if ($yearFrom == $yearTo) {
          $between = " AND  publication_year ='" . $yearFrom . "'";
          $sort = " ORDER BY publication_year ASC";
          $between2 = " AND  publication_year ='" . $yearFrom2 . "'";
          $sort2 = " ORDER BY publication_year ASC";
        } else {
          $between = " AND  publication_year BETWEEN " . $yearFrom . " AND " . $yearTo;
          $sort = " ORDER BY publication_year ASC";
          $between2 = " AND  publication_year BETWEEN " . $yearFrom . " AND " . $yearTo2;
          $sort2 = " ORDER BY publication_year ASC";
        }
      }
    }

    if (!empty($_POST["sort"])) {
      $sort = " ORDER BY publication_year " . $_POST["sort"];
      $sort2 = " ORDER BY publication_year " . $_POST["sort"];
    }

    $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

    if (isset($_SESSION['search_session1'])) {
      $fetching = $dbh->prepare($_SESSION['search_session1'] . $between . $sort);
      $fetching->execute();
      $fetched = $fetching->fetch();
      $counted = $fetched['counted'];
      if ($counted == 0) {
        $test .= "<tr><td colspan='4' style='text-align:center'>No Results</td></tr>";
      }
    }
    $num = 0;
    $prevNum = 0;
    for ($i = 0; $i < $counted; $i += 3) {
      if (isset($_SESSION['search_session2'])) {
        $fetching2 = $dbh->prepare($_SESSION['search_session2'] . $between2 . $sort2 . " LIMIT ?,?");
      }
      $fetching2->bindParam(1, $i, PDO::PARAM_INT);
      $fetching2->bindParam(2, $limit, PDO::PARAM_INT);
      $fetching2->execute();
      $num++;
      while ($fetched2 = $fetching2->fetch()) {
        $fetch_uploader = $dbh->prepare("select * from user where user_id=?");
        $fetch_uploader->bindParam(1, $fetched2['user_id']);
        $fetch_uploader->execute();
        $fetched_uploader = $fetch_uploader->fetch();

        $abstract = $dbh->prepare('select abstract from research where id=?');
        $abstract->bindParam(1, $fetched2['id']);
        $abstract->execute();
        $display_abstract = $abstract->fetch();
        if ($num > 1) {
          $test .= "<tr class='displayRow page$num' style='display:none'>
          <td> <br>
          <a class='displayResearch' target='_blank' href='display.php?id=" . $fetched2['id'] . "'><i style='font-size:80px' class='fa'>&#xf0f6;</i>
          <div id='firstRow' >
          <p class='rowtopic' >" . $fetched2['topic'] . "</p>
          <form action='' method='POST'>
          <button class='namebtn' type='submit' name='uploader' value='" . $fetched_uploader['user_id'] . "'> <i class='fas fa-user-alt'></i> " . $fetched_uploader['firstName'] . " " . $fetched_uploader['lastName'] . "</button>
          </form>
          <a class='view' href='view.php?id=" . $fetched2['id'] . "'><i class='fa fa-eye'></i> View</a>
          <a class='abstract' href='abstract.php?id=" . $fetched2['id'] . "'><i class='fa fa-book'></i> <span id='myBtn'> Abstract<span></a>
          <a class='fullArticle' href='display.php?id=" . $fetched2['id'] . "'><i class='fas fa-book-open'></i> Full Article</a>
          </div>
          <p style='margin-left: 90px; margin-top: -5%; '>" . $fetched2['title'] . "</p>
          <p style='margin-left: 90px; '>
              <p style='margin-left: 90px; '>" . $fetched2['author'] . "</p>
              

              <p style='margin-left: 90px; '>" . $fetched2['publication_day'] . ' ' . $fetched2['publication_month'] . ' ' . $fetched2['publication_year'] . "</p>
              <hr style='border: 1px solid black;' width='1200px;'>
      </a>
  </td>       
    </tr>  
    <!-- The Modal -->

    <div id='myModal' class='modal'>
  
      <!-- Modal content -->
      <div class='modal-content'>
        <span class='close'>&times;</span>
        <p>" . $display_abstract['abstract'] . "</p>
      
      </div>
  
    </div>    
   ";
        } else if ($num == 1) {

          $test .= "<tr  class='displayRow page$num'  style='display:block' > 
                    <td> <br>
                    <a class='displayResearch' target='_blank' href='display.php?id=" . $fetched2['id'] . "'><i style='font-size:80px' class='fa'>&#xf0f6;</i>
                    <div id='firstRow' >
                    <p class='rowtopic' >" . $fetched2['topic'] . "</p>
                    <form action='' method='POST'>
                    <button class='namebtn' type='submit' name='uploader' value='" . $fetched_uploader['user_id'] . "'> <i class='fas fa-user-alt'></i> " . $fetched_uploader['firstName'] . " " . $fetched_uploader['lastName'] . "</button>
                    </form>
                    <a class='view'  href='view.php?id=" . $fetched2['id'] . "'><i class='fa fa-eye'></i> View</a>
                    <a class='abstract'  ><i class='fa fa-book'></i><span id='myBtn'> Abstract<span></a>
                    <a class='fullArticle' href='display.php?id=" . $fetched2['id'] . "'><i class='fas fa-book-open'></i> Full Article</a>
                    </div>
                    <p style='margin-left: 90px; margin-top: -5%; '>" . $fetched2['title'] . "</p>
                    <p style='margin-left: 90px; '>
                        <p style='margin-left: 90px; '>" . $fetched2['author'] . "</p>
                        

                        <p style='margin-left: 90px; '>" . $fetched2['publication_day'] . ' ' . $fetched2['publication_month'] . ' ' . $fetched2['publication_year'] . "</p>
                        <hr style='border: 1px solid black;' width='1200px;'>
                </a>
            </td>
    </tr>
    <!-- The Modal -->

  <div id='myModal' class='modal'>

    <!-- Modal content -->
    <div class='modal-content'>
      <span class='close'>&times;</span>
      <p>" . $display_abstract['abstract'] . "</p>
    
    </div>

  </div>    
    ";
        } elseif ($num % 3 == 0) {
          $test .= "<tr  class='displayRow page$num' >
          <td> <br>
          <a class='displayResearch' target='_blank' href='display.php?id=" . $fetched2['id'] . "'><i style='font-size:80px' class='fa'>&#xf0f6;</i>
          <div id='firstRow' >
          <p class='rowtopic' >" . $fetched2['topic'] . "</p>
          <form action='' method='POST'>
          <button class='namebtn' type='submit' name='uploader' value='" . $fetched_uploader['user_id'] . "'> <i class='fas fa-user-alt'></i> " . $fetched_uploader['firstName'] . " " . $fetched_uploader['lastName'] . "</button>
          </form>
          <a class='view' href='view.php?id=" . $fetched2['id'] . "'><i class='fa fa-eye'></i> View</a>
          <a class='abstract' href='abstract.php?id=" . $fetched2['id'] . "'><i class='fa fa-book'></i> <span id='myBtn'> Abstract<span></a>
          <a class='fullArticle' href='display.php?id=" . $fetched2['id'] . "'><i class='fas fa-book-open'></i> Full Article</a>
          </div>
          <p style='margin-left: 90px; margin-top: -5%; '>" . $fetched2['title'] . "</p>
          <p style='margin-left: 90px; '>
              <p style='margin-left: 90px; '>" . $fetched2['author'] . "</p>
              

              <p style='margin-left: 90px; '>" . $fetched2['publication_day'] . ' ' . $fetched2['publication_month'] . ' ' . $fetched2['publication_year'] . "</p>
              <hr style='border: 1px solid black;' width='1200px;'>
      </a>
  </td>
    </tr>
    <!-- The Modal -->

  <div id='myModal' class='modal'>

    <!-- Modal content -->
    <div class='modal-content'>
      <span class='close'>&times;</span>
      <p>" . $display_abstract['abstract'] . "</p>
    
    </div>

  </div>    
    </table>";
        }
      }
    }

    // if (isset($_SESSION['search_session1'])) {
    //     echo $_SESSION['search_session1'].$between.$sort."<br>";
    // }
    // if (isset($_SESSION['search_session2'])) {
    //     echo $_SESSION['search_session2'].$between2.$sort2."<br>";
    // }

    echo $test;
    for ($i = 0; $i < $num; $i++) {
      $new_num = $i + 1;
      if ($new_num > 5) {
        echo  "<span class='a'><button class='btn$new_num b' style='display:none' type='button' onclick='pageDisplay($new_num,$num)'>$new_num</button></span>";
      } else {
        echo "<span class='a'> <button class='btn$new_num b' style='display:block' type='button' onclick='pageDisplay($new_num,$num)'>$new_num</button></span>";
      }
    }
    ?>
    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>
</body>

</html>