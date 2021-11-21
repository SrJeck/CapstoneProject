<?php
$con = mysqli_connect("localhost", "root", "", "research");
if ($con) {
  echo "connected";
}
?>
<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['author', 'publication_year'],
        <?php
        $conn = mysqli_connect("localhost", "root", "", "research") or die(mysqli_error());
        $query = "SELECT COUNT(topic) as count FROM research WHERE topic='technology'";
        $query_result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($query_result)) {
          $output = "Number of Technology " . $row['count'] . '<br>';
        }
        $sql = "SELECT * FROM research";
        $fire = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['author'] . "'," . $result['publication_year'] . "],";
        }

        ?>
      ]);

      var options = {
        title: 'title and their contribution'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

</html>