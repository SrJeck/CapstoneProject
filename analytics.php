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
  <title>Analytics</title>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <link rel="stylesheet" href="css/analytics.css">
  <link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <div class="icons">
    <div class="notification">
    <div class="tooltip">
    <span class="tooltiptext">Notification</span>
        <a href="#">
            <div class="notBtn" href="#" onclick="seeNotif()">
                <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
                <div class="number" onclick="myFunction()">' . $total_count . '</div>
                <i onclick="myFunction()" style="font-size:24px" class="fa fatest">&#xf0f3;</i>

                <div class="box" id="box" style="display:none">
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
</div>

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
  <!-- <script>
    function myFunction() {
      var xDiv = document.getElementById('box');
      if (xDiv.style.height == '')
        xDiv.style.height = '60vh';
      else
        xDiv.style.height = ''
    }
  </script> -->
  <?php

  $topic_list = array("technology", "education", "research", "analysis", "database", "agriculture", "health", "politics", "business", "marketing", "mechanical", "ethics", "others");
  $count_list = array();
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

  $query = "SELECT COUNT(topic) as count from research WHERE topic='politics'";
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
  $sql = "SELECT * from research";
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

        for ($i = 0; $i < count($topic_list); $i++) {
          $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
          $topic->bindParam(1, $topic_list[$i]);
          $topic->execute();
          $topic_rows = $topic->fetch();
          array_push($count_list, $topic_rows['number_of_research']);
          echo "['" . $topic_list[$i] . "', " . $topic_rows['number_of_research'] . "],";
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
        $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year ASC');
        $fetch_year->execute();
        $year_rows = "";
        while ($fetched_year = $fetch_year->fetch()) {
          $year_rows = $year_rows . $fetched_year['publication_year'] . ',';
        }

        //collect and store all topic
        $topic_rows = "";
        $first_row = "['Year'";
        for ($i = 0; $i < count($topic_list); $i++) {
          $fetch_topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
          $fetch_topic->bindParam(1, $topic_list[$i]);
          $fetch_topic->execute();
          $fetched_topic = $fetch_topic->fetch();
          $topic_rows .= $topic_list[$i] . ',';
          $first_row  .= ",'" . $topic_list[$i] . "'";
        }
        echo $first_row . ']';



        $new_topic_rows = substr_replace($topic_rows, "", -1);
        $new_year_rows = substr_replace($year_rows, "", -1);
        $topic_arr = explode(",", $new_topic_rows);
        $year_arr = explode(",", $new_year_rows);

        $topic_length = count($topic_list);
        $year_length = count($year_arr);
        $year_topic_count = "";
        for ($i = 0; $i < $year_length; $i++) {
          $year_topic_count = ",['" . $year_arr[$i] . "'";
          for ($j = 0; $j < $topic_length; $j++) {
            $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
            $fetch_count->bindParam(1, $topic_list[$j]);
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

  <div class="descriptive">
    <p style="font-weight: bold;">Descriptive</p>
    <?php

    $topic_string = "";
    for ($i = 0; $i < count($topic_list); $i++) {
      $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
      $topic->bindParam(1, $topic_list[$i]);
      $topic->execute();
      $topic_rows = $topic->fetch();
      $topic_string .= $topic_rows['number_of_research'] . " : " . $topic_list[$i] . ", ";
    }


    $asc_topic_array = explode(", ", rtrim($topic_string, ", "));
    $desc_topic_array = explode(", ", rtrim($topic_string, ", "));

    $asc_topic_array_count = array();
    $asc_topic_array_key = array();
    $desc_topic_array_count = array();
    $desc_topic_array_key = array();
    sort($asc_topic_array);
    rsort($desc_topic_array);
    for ($i = 0; $i < count($asc_topic_array); $i++) {
      $splitter = explode(" : ", $asc_topic_array[$i]);
      array_push($asc_topic_array_count, $splitter[0]);
      array_push($asc_topic_array_key, $splitter[1]);
    }
    for ($i = 0; $i < count($desc_topic_array); $i++) {
      $splitter = explode(" : ", $desc_topic_array[$i]);
      array_push($desc_topic_array_count, $splitter[0]);
      array_push($desc_topic_array_key, $splitter[1]);
    }
    $asc_count = 0;
    $desc_count = 0;
    for ($i = 0; $i < count($asc_topic_array_count); $i++) {
      if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
        $asc_count++;
      }
    }
    for ($i = 0; $i < count($desc_topic_array_count); $i++) {
      if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
        $desc_count++;
      }
    }

    $des_topic1 = "";
    $des_topic2 = "";
    $des_topic3 = "";
    $des_topic4 = "";
    $asc_output_key = "";
    $asc_output_count = "";
    if ($asc_count > 1) {
      for ($i = 0; $i < $asc_count; $i++) {
        if ($i == ($asc_count - 2)) {
          $asc_output_key .= $asc_topic_array_key[$i] . " and ";
        } else {
          $asc_output_key .= $asc_topic_array_key[$i] . ", ";
        }
      }
      if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
      } else {
        $asc_output_count = $asc_topic_array_count[0];
      }
      $des_topic1 = "topics";
      $des_topic3 = "are";
    } else {
      $asc_output_key = $asc_topic_array_key[0];
      if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
      } else {
        $asc_output_count = $asc_topic_array_count[0];
      }
      $des_topic1 = "topic";
      $des_topic3 = "is";
    }


    $desc_output_key = "";
    $desc_output_count = "";
    if ($desc_count > 1) {
      for ($i = 0; $i < $desc_count; $i++) {
        if ($i == ($asc_count - 2)) {
          $desc_output_key .= $desc_topic_array_key[$i] . " and ";
        } else {
          $desc_output_key .= $desc_topic_array_key[$i] . ", ";
        }
      }
      $desc_output_count = $desc_topic_array_count[0];
      $des_topic2 = "topics";
      $des_topic4 = "are";
    } else {
      $desc_output_key = $desc_topic_array_key[0];
      $desc_output_count = $desc_topic_array_count[0];
      $des_topic2 = "topic";
      $des_topic4 = "is";
    }
    echo "The " . rtrim($desc_output_key, ", ") . " have the highest number of uploaded " . $des_topic2 . " with " . $desc_output_count . " number of uploads while the " . rtrim($asc_output_key, ", ") . " have the lowest number of uploaded " . $des_topic1 . " with " . $asc_output_count . " number of uploads.";

    ?>
    <br>
    <p style="font-weight: bold;">Predictive</p>
    <?php

    $topic_string = "";
    for ($i = 0; $i < count($topic_list); $i++) {
      $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
      $topic->bindParam(1, $topic_list[$i]);
      $topic->execute();
      $topic_rows = $topic->fetch();
      $topic_string .= $topic_rows['number_of_research'] . " : " . $topic_list[$i] . ", ";
    }


    $asc_topic_array = explode(", ", rtrim($topic_string, ", "));
    $desc_topic_array = explode(", ", rtrim($topic_string, ", "));

    $asc_topic_array_count = array();
    $asc_topic_array_key = array();
    $asc_topic_array_key2 = array();
    $desc_topic_array_count = array();
    $desc_topic_array_key = array();
    $desc_topic_array_key2 = array();
    sort($asc_topic_array);
    rsort($desc_topic_array);
    for ($i = 0; $i < count($asc_topic_array); $i++) {
      $splitter = explode(" : ", $asc_topic_array[$i]);
      array_push($asc_topic_array_count, $splitter[0]);
      array_push($asc_topic_array_key, $splitter[1]);
    }
    for ($i = 0; $i < count($desc_topic_array); $i++) {
      $splitter = explode(" : ", $desc_topic_array[$i]);
      array_push($desc_topic_array_count, $splitter[0]);
      array_push($desc_topic_array_key, $splitter[1]);
    }
    $asc_count = 0;
    $desc_count = 0;
    for ($i = 0; $i < count($asc_topic_array_count); $i++) {
      if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
        $asc_count++;
      }
    }
    for ($i = 0; $i < count($desc_topic_array_count); $i++) {
      if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
        $desc_count++;
      }
    }

    $asc_output_key = "";
    $asc_output_count = "";
    if ($asc_count > 1) {
      for ($i = 0; $i < $asc_count; $i++) {
        if ($i == ($asc_count - 2)) {
          $asc_output_key .= $asc_topic_array_key[$i] . " and ";
        } else {
          $asc_output_key .= $asc_topic_array_key[$i] . ", ";
        }
        array_push($asc_topic_array_key2, $asc_topic_array_key[$i]);
      }
      if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
      } else {
        $asc_output_count = $asc_topic_array_count[0];
      }
    } else {
      array_push($asc_topic_array_key2, $asc_topic_array_key[0]);
      $asc_output_key = $asc_topic_array_key[0];
      if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
      } else {
        $asc_output_count = $asc_topic_array_count[0];
      }
    }


    $desc_output_key = "";
    $desc_output_count = "";
    if ($desc_count > 1) {
      for ($i = 0; $i < $desc_count; $i++) {
        if ($i == ($asc_count - 2)) {
          $desc_output_key .= $desc_topic_array_key[$i] . " and ";
        } else {
          $desc_output_key .= $desc_topic_array_key[$i] . ", ";
        }
        array_push($desc_topic_array_key2, $desc_topic_array_key[$i]);
      }
      $desc_output_count = $desc_topic_array_count[0];
    } else {
      array_push($desc_topic_array_key2, $desc_topic_array_key[0]);
      $desc_output_key = $desc_topic_array_key[0];
      $desc_output_count = $desc_topic_array_count[0];
    }





    $asc_string = "";
    $asc_count = 0;
    $desc_string = "";
    $desc_count = 0;
    $asc_string_array = array();
    $desc_string_array = array();
    $topic_string_array = array();
    for ($i = 0; $i < count($topic_list); $i++) {
      $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
      $topic->bindParam(1, $topic_list[$i]);
      $topic->execute();
      $topic_rows = $topic->fetch();
      $topic_string .= $topic_rows['number_of_research'] . " : " . $topic_list[$i] . ", ";
    }


    $string_output = "";
    $desc_string_output = "";
    //collect and store all years
    $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year DESC');
    $fetch_year->execute();
    $year_rows = "";
    while ($fetched_year = $fetch_year->fetch()) {
      $year_rows .= $fetched_year['publication_year'] . ',';
    }

    $year_arr = explode(",", substr_replace($year_rows, "", -1));

    $topic_length = count($topic_list);
    $year_length = count($year_arr);

    for ($i = 0; $i < $year_length; $i++) {
      $string_output .= $year_arr[$i] . " - ";
      for ($j = 0; $j < $topic_length; $j++) {
        $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
        $fetch_count->bindParam(1, $topic_list[$j]);
        $fetch_count->bindParam(2, $year_arr[$i]);
        $fetch_count->execute();
        $fetched_count = $fetch_count->fetch();
        $string_output .= $fetched_count['number_count'] . " : " . $topic_list[$j] . ", ";
      }
      $string_output .= " / ";
    }
    $string_output2 = explode(" / ", substr($string_output, 0, -3));
    for ($i = 0; $i < count($string_output2); $i++) {
      $string_output3 = explode(" - ", $string_output2[$i]);
      $string_holder = $string_output3[1];
      $asc_string .=  $string_output3[0] . " - ";
      $desc_string .= $string_output3[0] . " - ";
      $string_output4 = explode(", ", substr_replace($string_output3[1], "", -2));
      $string_output5 = explode(", ", substr_replace($string_output3[1], "", -2));
      sort($string_output4);
      rsort($string_output5);
      for ($j = 0; $j < count($string_output4); $j++) {
        $string_holder1 = $string_output4[0];
        $string_holder2 = $string_output4[$j];
        if ($string_holder1[0] == $string_holder2[0]) {
          $asc_string .= $string_output4[$j] . ", ";
          //array_push($asc_string_array,$string_output4[$j]);
        }
      }
      for ($j = 0; $j < count($string_output5); $j++) {
        $string_holder1 = $string_output5[0];
        $string_holder2 = $string_output5[$j];
        if ($string_holder1[0] == $string_holder2[0]) {
          $desc_string .= $string_output5[$j] . ", ";
          //array_push($desc_string_array,$string_output5[$j]);
        }
      }
      $asc_string .= " / ";
      $desc_string .= " / ";
    }
    $asc_string_output2 = explode(" / ", substr_replace($asc_string, "", -4));
    $desc_string_output2 = explode(" / ", substr_replace($desc_string, "", -4));
    $desc_counter = 0;
    $desc_counter_output  = "";
    $desc_counter_output2 = array();
    $desc_counter_output3 = array();
    $desc_counter_output4 = array();
    $desc_counter_output5 = array();
    for ($i = 0; $i < count($desc_topic_array_key2); $i++) {
      for ($j = 0; $j < count($desc_string_output2); $j++) {
        if (strpos($desc_string_output2[$j],$desc_topic_array_key2[$i]) > -1) {
          $desc_counter++;
        } else {
          $desc_counter = 0;
          break;
        }
      }
      if ($desc_counter > 0) {
        array_push($desc_counter_output4, $desc_topic_array_key2[$i]);
        array_push($desc_counter_output2, $desc_topic_array_key2[$i] . " for the last " . $desc_counter . " years");
      } else {
        array_push($desc_counter_output5, $desc_topic_array_key2[$i]);
        array_push($desc_counter_output3, $desc_topic_array_key2[$i] . " for only few years");
      }
    }

    $sentence_output1 = "";
    $sentence_output2 = "";
    $sentence_output3 = "";
    $sentence_output4 = "";
    $sentence_output5 = "";
    $sentence_changer = "";
    $sentence_array1 = array();
    $sentence_array2 = array();
    $desc_final_array = explode(",", substr_replace($desc_counter_output, "", -1));
    if (count($desc_final_array) > 1) {
      for ($i = 0; $i < count($desc_final_array); $i++) {
        $desc_final_array2 = explode(" : ", $desc_final_array[$i]);
        if ($i == (count($desc_final_array) - 2)) {
          $sentence_output1 .= $desc_final_array2[0] . " and ";
        } else {
          $sentence_output1 .= $desc_final_array2[0] . ", ";
        }
      }
    } else {
      $desc_final_array2 = explode(" : ", $desc_final_array[0]);
      $sentence_output1 .= $desc_final_array2[0];
    }
    sort($count_list);
    $end_pos = (count($count_list) - 1);

    $sentence_topic1 = "";
    $sentence_topic2 = "";
    if (count($desc_final_array) > 1) {
      $sentence_topic1 = "topics";
      $sentence_topic2 = "are";
    } else {
      $sentence_topic1 = "topic";
      $sentence_topic2 = "is";
    }
    if (count($desc_counter_output2) > 1 && count($desc_counter_output3) == 0) {
      for ($i = 0; $i < count($desc_counter_output2); $i++) {
        if ($i == (count($desc_counter_output2) - 2)) {
          $sentence_output1 .= $desc_counter_output2[$i] . " and ";
        } else {
          $sentence_output1 .= $desc_counter_output2[$i] . ", ";
        }
      }
    } else if (count($desc_counter_output2) > 1 && count($desc_counter_output3) > 1) {
      for ($i = 0; $i < count($desc_counter_output2); $i++) {
        $sentence_output1 .= $desc_counter_output2[$i] . ", ";
      }
    } else if (count($desc_counter_output2) == 1 && count($desc_counter_output3) == 0) {
      $sentence_output1 .= $desc_counter_output2[0];
    } else if (count($desc_counter_output2) == 1 && count($desc_counter_output3) > 0) {
      $sentence_output1 .= $desc_counter_output2[0] . ", ";
    }

    if (count($desc_counter_output3) > 1) {
      for ($i = 0; $i < count($desc_counter_output3); $i++) {
        if ($i == (count($desc_counter_output3) - 2)) {
          $sentence_output2 .= $desc_counter_output3[$i] . " and ";
        } else {
          $sentence_output2 .= $desc_counter_output3[$i] . ", ";
        }
      }
    } else {
      $sentence_output2 .= $desc_counter_output3[count($desc_counter_output3) - 1];
    }

    if (count($desc_counter_output4) > 1 && count($desc_counter_output5) == 0) {
      for ($i = 0; $i < count($desc_counter_output4); $i++) {
        if ($i == (count($desc_counter_output4) - 2)) {
          $sentence_output3 .= $desc_counter_output4[$i] . " and ";
        } else {
          $sentence_output3 .= $desc_counter_output4[$i] . ", ";
        }
      }
    } else if (count($desc_counter_output4) > 1 && count($desc_counter_output5) > 1) {
      for ($i = 0; $i < count($desc_counter_output4); $i++) {
        $sentence_output3 .= $desc_counter_output4[$i] . ", ";
      }
    } else if (count($desc_counter_output4) == 1 && count($desc_counter_output5) == 0) {
      $sentence_output3 .= $desc_counter_output4[0];
    } else if (count($desc_counter_output4) == 1 && count($desc_counter_output5) > 0) {
      $sentence_output3 .= $desc_counter_output4[0] . ", ";
    }

    if (count($desc_counter_output5) > 1 && count($desc_counter_output4) > 0) {
      $sentence_output4 .= " but not for ";
      for ($i = 0; $i < count($desc_counter_output5); $i++) {
        if ($i == (count($desc_counter_output5) - 2)) {
          $sentence_output4 .= $desc_counter_output5[$i] . " and ";
        } else {
          $sentence_output4 .= $desc_counter_output5[$i] . ", ";
        }
      }
    } else if (count($desc_counter_output5) == 1 && count($desc_counter_output4) > 0) {
      $sentence_output4 .= $desc_counter_output5[0];
    }
    if (count($desc_counter_output5) == 0 && count($desc_counter_output4) > 0) {
      $sentence_changer = " not";
    }

    if (empty($sentence_output3)) {
      if (count($desc_counter_output5) > 0) {
        for ($i = 0; $i < count($desc_counter_output5); $i++) {
          if ($i == (count($desc_counter_output5) - 2)) {
            $sentence_output5 .= $desc_counter_output5[$i] . " and ";
          } else {
            $sentence_output5 .= $desc_counter_output5[$i] . ", ";
          }
        }
      } else {
        $sentence_output5 .= $desc_counter_output5[count($desc_counter_output5) - 1];
      }
      if (count($desc_counter_output5) == 0 && count($desc_counter_output4) > 0) {
        $sentence_changer = " not";
      }
    }

    echo "Based on the graphs above, the most common " . $sentence_topic1 . " with total of " . $count_list[$end_pos] . " " . $sentence_topic2 . " " . rtrim($sentence_output1, ", ") . rtrim($sentence_output2, ", ") . ". if the uploads on the " . $sentence_topic1 . " " . $sentence_output3 . $sentence_output5 . " will" . $sentence_changer . " change, the study that will be uploaded might" . $sentence_changer . " become saturated and have too similar conclusion" . $sentence_output4;

    ?>
  </div>
  <!-- <div class="predictive">Predictive

  </div> -->
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
  <div class="prescriptive">
    <p style="font-weight: bold;"> Prescriptive</p>
    <br><br>

    <?php

    $asc_string_key_output = "";
    $desc_string_key_output = "";

    $final_asc_string_array = array();
    $final_desc_string_array  = array();
    $final_asc_string_key = "";
    $final_desc_string_key  = "";
    $final_asc_count = 0;
    $final_desc_count  = 0;
    $asc_string_array_output = explode(" ", substr($asc_string_output2[0], strpos($asc_string_output2[0], " - ") + 3));
    $desc_string_array_output = explode(" ", substr($desc_string_output2[0], strpos($desc_string_output2[0], " - ") + 3));
    for ($i = 0; $i < count($asc_string_array_output); $i++) {
      if (ctype_alpha(rtrim($asc_string_array_output[$i], ","))) {
        array_push($final_asc_string_array, rtrim($asc_string_array_output[$i], ","));
      }
      if (ctype_digit(rtrim($asc_string_array_output[$i], ","))) {
        $final_asc_count = rtrim($asc_string_array_output[$i], ",");
      }
    }
    for ($i = 0; $i < count($desc_string_array_output); $i++) {
      if (ctype_alpha(rtrim($desc_string_array_output[$i], ","))) {
        array_push($final_desc_string_array, rtrim($desc_string_array_output[$i], ","));
      }
      if (ctype_digit(rtrim($desc_string_array_output[$i], ","))) {
        $final_desc_count = rtrim($desc_string_array_output[$i], ",");
      }
    }
    if (count($final_asc_string_array) > 1) {
      for ($i = 0; $i < count($final_asc_string_array); $i++) {
        if ($i == (count($final_asc_string_array) - 2)) {
          $final_asc_string_key .= $final_asc_string_array[$i] . " and ";
        } else {
          $final_asc_string_key .= $final_asc_string_array[$i] . ", ";
        }
      }
    } else {
      $final_asc_string_key = $final_asc_string_array[0];
    }
    if (count($final_desc_string_array) > 1) {
      for ($i = 0; $i < count($final_desc_string_array); $i++) {
        if ($i == (count($final_desc_string_array) - 2)) {
          $final_desc_string_key .= $final_desc_string_array[$i] . " and ";
        } else {
          $final_desc_string_key .= $final_desc_string_array[$i] . ", ";
        }
      }
    } else {
      $final_desc_string_key = $final_desc_string_array[0];
    }
    //echo rtrim($asc_output_key, ", ")."<br>";
    //echo rtrim($desc_output_key, ", ")."<br>";
    //echo $final_asc_string_key."<br>";
    //echo $final_desc_string_key;
    $pres_topic1 = "";
    $pres_topic2 = "";
    $pres_topic3 = "";
    $pres_topic4 = "";
    if (count($final_desc_string_array) > 1) {
      $pres_topic1 = "topics";
      $pres_topic3 = "are";
    } else {
      $pres_topic1 = "topic";
      $pres_topic3 = "is";
    }
    if (count($final_asc_string_array) > 1) {
      $pres_topic2 = "topics";
      $pres_topic4 = "are";
    } else {
      $pres_topic2 = "topic";
      $pres_topic4 = "is";
    }
    echo "The current highest uploaded " . $pres_topic1 . " this year " . $pres_topic3 . " " . rtrim($final_desc_string_key, ", ") . " with " . $final_desc_count . " upload and the current highest uploaded " . $des_topic2 . " in total " . $des_topic4 . " " . rtrim($desc_output_key, ", ") . " with " . $desc_output_count . " upload. to develop a new and unique study, we recommend developing a study about the lowest uploaded " . $pres_topic2 . " this year which " . $pres_topic4 . " " . rtrim($final_asc_string_key, ", ")  . " or the lowest uploaded " . $des_topic1 . " in total which " . $des_topic3 . " " . rtrim($asc_output_key, ", ");
    ?>
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