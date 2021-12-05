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

  <style>
    .descriptive {
      background-color: white;
      width: 685px;
      padding: 20px;
      margin: 20px;
      display: inline-block;
      border: 2px solid black;
      border-radius: 10px;
      margin-left: 42px;
      font-size: 20px;
    }

    .predictive {
      background-color: white;
      width: 685px;
      padding: 20px;
      margin: 20px;
      display: inline-block;
      border: 2px solid black;
      border-radius: 10px;
      font-size: 20px;

    }

    .prescriptive {
      background-color: white;
      width: auto;
      padding: 20px;
      margin: 20px;
      display: inline-block;
      border: 2px solid black;
      border-radius: 10px;
      font-size: 20px;
      margin-right: 40px;
      margin-left: 50px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
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
    <div id="piechart" style="width: 800px; height: 420px; margin-left: 25px;"></div>
    <div id="curve_chart" style="width: 800px; height: 420px; margin-right: 25px;"></div>
  </div>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });

    // Draw the pie chart for Sarah's pizza when Charts is loaded.
    google.charts.setOnLoadCallback(drawPieChart);

    // Draw the pie chart for the Anthony's pizza when Charts is loaded.
    google.charts.setOnLoadCallback(drawLineChart);

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
          position: 'bottom',
          backgroundcolor: 'red',
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);


    }
  </script>

  <div class="descriptive">Descriptive
    <br><br>
<?php

$asc_topic_string_count = "";
$asc_topic_string_key = "";
$desc_topic_string_count = "";
$desc_topic_string_key = "";
//$asc_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_research FROM research WHERE upload_status="posted" GROUP BY topic ASC');
$asc_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_research FROM research GROUP BY topic ORDER BY COUNT(*) ASC');
$asc_topic->execute();
while ($asc_topic_rows = $asc_topic->fetch()) {
  $asc_topic_string_count .= $asc_topic_rows['number_of_research'] . ",";
  $asc_topic_string_key .= $asc_topic_rows['topic'] . ",";
}
//$desc_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_research FROM research WHERE upload_status="posted" GROUP BY topic ASC');
$desc_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_research FROM research GROUP BY topic ORDER BY COUNT(*) DESC');
$desc_topic->execute();
while ($desc_topic_rows = $desc_topic->fetch()) {
  $desc_topic_string_count .= $desc_topic_rows['number_of_research'] . ",";
  $desc_topic_string_key .= $desc_topic_rows['topic'] . ",";
}

$asc_topic_array_count = explode(",",rtrim($asc_topic_string_count, ", "));
$asc_topic_array_key = explode(",",rtrim($asc_topic_string_key, ", "));
$desc_topic_array_count = explode(",",rtrim($desc_topic_string_count, ", "));
$desc_topic_array_key = explode(",",rtrim($desc_topic_string_key, ", "));
$asc_count = 0;
$desc_count = 0;
for ($i=0; $i < count($asc_topic_array_count); $i++) { 
    if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
        $asc_count++;
    }
}

$asc_output_key = "";
$asc_output_count = "";
if ($asc_count > 1) {
    for ($i=0; $i < $asc_count; $i++) { 
        if ($i == ($asc_count-2)) {
            $asc_output_key .= $asc_topic_array_key[$i]." and ";
        }else{
            $asc_output_key .= $asc_topic_array_key[$i].", ";
        }
        
    }
    $asc_output_count = $asc_topic_array_count[0];
}else{
    $asc_output_key = $asc_topic_array_key[0];
    $asc_output_count = $asc_topic_array_count[0];
}

for ($i=0; $i < count($desc_topic_array_count); $i++) { 
    if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
        $desc_count++;
    }
}

$desc_output_key = "";
$desc_output_count = "";
if ($desc_count > 1) {
    for ($i=0; $i < $desc_count; $i++) { 
        $desc_output_key .= $desc_topic_array_key[$i].", ";
    }
    $desc_output_count = $desc_topic_array_count[0];
}else{
    $desc_output_key = $desc_topic_array_key[0];
    $desc_output_count = $desc_topic_array_count[0];
}
echo "The ".rtrim($desc_output_key, ", ")." have the highest number of uploaded topics with ".$desc_output_count." number of uploads while the ".rtrim($asc_output_key, ", ")." have the lowest number of uploaded topics with ".$asc_output_count." number of uploads.";
?>
  </div>
  <div class="predictive">Predictive
    <br><br>

    Based on the graphs above, the Highest_var have a total of total_ups in the past 7 days. if the uploads on the highest_var will not change, the study that will be uploaded might become saturated and have too similar conclusion.
  </div>
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
  <div class="prescriptive">Prescriptive
    <br><br>

    The current highest uploaded topic is the highest_var with a total of total_ups upload. to develop a new and unique study, we recommend developing a study about lowest_var3, lowest_var2, or lowest_var1
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