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
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
  <link rel="stylesheet" href="css/test.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/analytics.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <img style="height: 40px; margin-left: 10px;" src="images/TQ.png">
      <span class="logo_name"><img style="height: 40px; " src="images/Logo.png"></span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="users.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Users</span>
        </a>
      </li>
      <li>
        <a href="research.php">
          <i class='bx bx-book-alt'></i>
          <span class="links_name">Research</span>
        </a>
      </li>
      <li>
        <a href="pending_research.php">
          <i class='far fa-file-alt'></i>
          <span class="links_name">Pending Research</span>
        </a>
      </li>
      <li>
        <a href="profile.php">
          <i class='far fa-id-card'></i>
          <span class="links_name">Profile</span>
        </a>
      </li>
      <li>
        <a href="settings.php">
          <i class='bx bx-cog'></i>
          <span class="links_name">Settings</span>
        </a>
      </li>
      <li class="log_out">
        <a href="logout.php">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="sales-boxes">
        <div class="recent-sales box">
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
          <h1 style="margin-left: 30px;">Analytics Overview</h1>

          <div class="flex-container">
            <div id="piechart" style="width: 45%; height: 420px; float:left"></div>
            <div id="curve_chart" style="width: 45%; height: 420px; float:right"></div>
          </div>
          <div class="flex-container">
            <div id="chart_div" style="width: 45%; height: 420px;"></div>
            <div id="columnchart_material" style="width: 45%; height: 420px; float:right; font-size:12px;"></div>
          </div>
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

            // Draw the pie chart for the Anthony's pizza when Charts is loaded.
            google.charts.setOnLoadCallback(drawChart);

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
                ['Year', 'Upload Per Year'],

                <?php
                $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
                $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_topic FROM research GROUP BY publication_year ASC');
                $fetch_year->execute();
                while ($fetched_year = $fetch_year->fetch()) {
                  echo "['" . $fetched_year['publication_year'] . "'," . $fetched_year['number_of_topic'] . "],";
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

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Year', 'Registered'],
                <?php
                $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
                $fetch_year = $dbh->prepare('SELECT registration_year, COUNT(*) AS number_of_user FROM user GROUP BY registration_year ASC');
                $fetch_year->execute();
                while ($fetched_year = $fetch_year->fetch()) {
                  echo "['" . $fetched_year['registration_year'] . "'," . $fetched_year['number_of_user'] . "],";
                }
                ?>
              ]);

              var options = {
                title: 'Total Registeration Per Year',
                hAxis: {
                  title: 'Year',
                  titleTextStyle: {
                    color: '#333'
                  }
                },
                vAxis: {
                  minValue: 0
                }
              };

              var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
              chart.draw(data, options);
            }
          </script>


          <!-- <h1 style="margin-left: 30px; ">Overview</h1> -->
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
        </div>
      </div>
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>

</body>

</html>