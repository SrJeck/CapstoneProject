<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();


?>
<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>

<head>
  <title>Analytics</title>
  <script type="text/javascript" src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/analytics.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</head>

<body>
  <!-- NAVBAR -->
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 5px;" href="users.php">USERS</a>
    <a style="margin-top: 5px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 5px;" href="analytics.php">ANALYTICS</a>
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    </div>';
  }
  ?>
  <?php
  $conn = mysqli_connect("localhost", "root", "", "journal");
  $query = "SELECT COUNT(*) as count from user";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $users = $row['count'] . '<br>';
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='technology'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $output = $row['count'] . '<br>';
  }
  $query = "SELECT COUNT(topic) as count from research WHERE topic='education'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $output2 = $row['count'] . '<br>';
  }
  $query = "SELECT COUNT(topic) as count from research WHERE topic='research'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $output3 =  $row['count'];
  }
  $query = "SELECT COUNT(topic) as count from research WHERE topic='analysis'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $output4 =  $row['count'];
  }
  $query = "SELECT COUNT(topic) as count from research WHERE topic='database'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $database =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='agriculture'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $agriculture =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='health'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $health =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='politcs'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $politcs =  $row['count'];
  }
  $query = "SELECT COUNT(topic) as count from research WHERE topic='psychology'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $psychology =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='business'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $business =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='marketing and advertising'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $market =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='mechanical'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $mechanical =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='ethics'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $ethics =  $row['count'];
  }

  $query = "SELECT COUNT(topic) as count from research WHERE topic='others'";
  $query_result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $others =  $row['count'];
  }
  $sql = "SELECT * from journal";
  $result = mysqli_query($conn, $sql);

  ?>
  <br><br><br>
  <h1 style="margin-left: 30px;">Analytics Overview</h1>

  <div class="flex-container">
    <div id="piechart" style="width: 800px; height: 420px; float:left"></div>
    <div id="curve_chart" style="width: 800px; height: 420px; float:right"></div>
  </div>
  
  <div id="columnchart_material" style="width: 100%; height: 420px; float:right"></div>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart', 'bar']
    });

    // Draw the pie chart for Sarah's pizza when Charts is loaded.
    google.charts.setOnLoadCallback(drawPieChart);

    // Draw the pie chart for the Anthony's pizza when Charts is loaded.
    google.charts.setOnLoadCallback(drawLineChart);

    // Draw the pie chart for the Anthony's pizza when Charts is loaded.
    google.charts.setOnLoadCallback(drawBarChart);

    function drawPieChart() {

      var pie_data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        <?php

        $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

        $stat = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_research FROM research GROUP BY topic');
        $stat->execute();
        while ($rows = $stat->fetch()) {
          echo "['" . $rows['topic'] . "', " . $rows['number_of_research'] . "],";
        }
        ?>
      ]);

      var pie_options = {
        title: 'Topics',
        is3D: true
      };

      var pie_chart = new google.visualization.PieChart(document.getElementById('piechart'));

      pie_chart.draw(pie_data, pie_options);




    }

    function drawLineChart() {


      var data = google.visualization.arrayToDataTable([
        <?php

        $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
        //collect and store all years
        $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year');
        $fetch_year->execute();
        $year_rows = "";
        while ($fetched_year = $fetch_year->fetch()) {
          $year_rows = $year_rows . $fetched_year['publication_year'] . ',';
        }

        //collect and store all topic
        $fetch_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_topic FROM research GROUP BY topic');
        $fetch_topic->execute();
        $topic_rows = "";
        $first_row = "['Year'";
        while ($fetched_topic = $fetch_topic->fetch()) {
          $topic_rows = $topic_rows . $fetched_topic['topic'] . ',';
          $first_row  = $first_row . ",'" . $fetched_topic['topic'] . "'";
        }
        echo $first_row . ']';



        $new_topic_rows = substr_replace($topic_rows, "", -1);
        $new_year_rows = substr_replace($year_rows, "", -1);
        $topic_arr = explode(",", $new_topic_rows);
        $year_arr = explode(",", $new_year_rows);

        $topic_length = count($topic_arr);
        $year_length = count($year_arr);
        $year_topic_count = "";
        for ($i = 0; $i < $year_length; $i++) {
          $year_topic_count = ",['" . $year_arr[$i] . "'";
          for ($j = 0; $j < $topic_length; $j++) {
            $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
            $fetch_count->bindParam(1, $topic_arr[$j]);
            $fetch_count->bindParam(2, $year_arr[$i]);
            $fetch_count->execute();
            $fetched_count = $fetch_count->fetch();
            $year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];
          }
          echo $year_topic_count . "]";
          $year_topic_count = "";
        }
        ?>
      ]);

      var options = {
        title: 'Upload Per Year',
        curveType: 'none',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);


    }

    function drawBarChart() {
      var data = google.visualization.arrayToDataTable([
          ['Year','Total Uploads'],

          <?php
          $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
          $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_topic FROM research GROUP BY publication_year ASC');
          $fetch_year->execute();
          while ($fetched_year = $fetch_year->fetch()) {
            echo "['".$fetched_year['publication_year']."',".$fetched_year['number_of_topic']."],";
          }
          ?>
        ]);
        var options = {
          chart: {
            title: 'Total Upload Per Year',
          }
        };



        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
  </script>


  <br><br>

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
  <h1 style="margin-left: 30px; ">Topics Overview</h1>
  <div class="main-part">
    <div class="cpanel">
      <div class="icon-part">
        <i class="fa fa-users" aria-hidden="true"></i><br>
        <small>Active Users</small>
        <p><?php
            echo $users;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-green">
      <div class="icon-part">
        <i class="fa fa-book" aria-hidden="true"></i><br>
        <small>Education</small>
        <p><?php
            echo $output2;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-orange">
      <div class="icon-part">
        <i class="fa fa-search" aria-hidden="true"></i><br>
        <small>Research</small>
        <p><?php
            echo $output3;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-tech">
      <div class="icon-part">
        <i class="fas fa-laptop-code" aria-hidden="true"></i><br>
        <small>Technology</small>
        <p> <?php
            echo $output;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-mint-green">
      <div class="icon-part">
        <i class="fa fa-bar-chart" aria-hidden="true"></i><br>
        <small>Analysis</small>
        <p> <?php
            echo $output4;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-db">
      <div class="icon-part">
        <i class="fa fa-database" aria-hidden="true"></i><br>
        <small>Database</small>
        <p><?php
            echo $database;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-blue">
      <div class="icon-part">
        <i class="fas fa-seedling" aria-hidden="true"></i><br>
        <small>Agriculture</small>
        <p><?php
            echo $agriculture;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-red">
      <div class="icon-part">
        <i class="fa fa-medkit" aria-hidden="true"></i><br>
        <small>Health</small>
        <p><?php
            echo $health;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-pol">
      <div class="icon-part">
        <i class="fas fa-vote-yea" aria-hidden="true"></i><br>
        <small>Politics</small>
        <p><?php
            echo $politcs;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-skyblue">
      <div class="icon-part">
        <i class="fas fa-brain" aria-hidden="true"></i><br>
        <small>Psychology</small>
        <p><?php
            echo $psychology;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-business">
      <div class="icon-part">
        <i class="fa fa-building" aria-hidden="true"></i><br>
        <small>Business</small>
        <p><?php
            echo $business;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-market">
      <div class="icon-part">
        <i class="fa fa-poll" aria-hidden="true"></i><br>
        <small>Marketing and Advertising</small>
        <p><?php
            echo $market;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-mech">
      <div class="icon-part">
        <i class="fa fa-wrench" aria-hidden="true"></i><br>
        <small>Mechanical</small>
        <p><?php
            echo $mechanical;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-ethics">
      <div class="icon-part">
        <i class="fa fa-balance-scale" aria-hidden="true"></i><br>
        <small>Ethics</small>
        <p><?php
            echo $ethics;
            ?></p>
      </div>
    </div>
    <div class="cpanel cpanel-others">
      <div class="icon-part">
        <i class="fas fa-globe" aria-hidden="true"></i><br>
        <small>Others</small>
        <p><?php
            echo $others;
            ?></p>
      </div>
    </div>
  </div>
  <br><br>
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