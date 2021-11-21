<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "research") or die(mysqli_error());
$query = "SELECT COUNT(topic) as count FROM research WHERE topic='technology'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output = $row['count'] . '<br>';
}
$query = "SELECT COUNT(topic) as count FROM research WHERE topic='education'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output2 = $row['count'] . '<br>';
}
$query = "SELECT COUNT(topic) as count FROM research WHERE topic='research'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output3 =  $row['count'];
}
$query = "SELECT COUNT(topic) as count FROM research WHERE topic='analysis'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output4 =  $row['count'];
}

$sql = "SELECT * FROM research";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <style>
        table,
        tr,
        td {
            text-align: center;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>


    <div class="wrapper">
        <div class="counter col_fourth">
            <i class="fa fa-code fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="300" data-speed="1500"></h2>
            <p class="count-text ">Technology</p>
            <p class="count-text ">
                <?php
                echo $output;
                ?>
            </p>

        </div>

        <div class="counter col_fourth">
            <i class="fa fa-coffee fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"></h2>
            <p class="count-text ">Education</p>
            <p class="count-text ">
                <?php
                echo $output2;
                ?>
            </p>
        </div>

        <div class="counter col_fourth">
            <i class="fa fa-lightbulb-o fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="11900" data-speed="1500"></h2>
            <p class="count-text ">Research</p>
            <p class="count-text ">
                <?php
                echo $output3;
                ?>
            </p>
        </div>

        <div class="counter col_fourth end">
            <i class="fa fa-bug fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="157" data-speed="1500"></h2>
            <p class="count-text">Analysis</p>
            <p class="count-text ">
                <?php
                echo $output4;
                ?>
            </p>
        </div>
    </div>

</body>

</html>