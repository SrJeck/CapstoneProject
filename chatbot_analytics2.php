<?php

session_start();

$user_id = $_SESSION['user_id'];
$order = $_POST['order'];
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

$topic_array1 = array();
$count_array1 = array();
$final_topic_array1 = array();
$output1 = "";
$stat1 = $dbh->prepare('select topic,count(*) as topic_count from research group by topic order by topic_count'.$order);
$stat1->execute();
while ($row1 = $stat1->fetch()) {
    array_push($topic_array1,$row1['topic']);
    array_push($count_array1,$row1['topic_count']);
}

for ($i=0; $i < count($count_array1); $i++) { 
    if ($count_array1[0] == $count_array1[$i]) {
        array_push($final_topic_array1,$topic_array1[$i]);
    }
}


if (count($final_topic_array1) > 1) {
    for ($i=0; $i < count($final_topic_array1); $i++) { 
        if ($i == (count($final_topic_array1)-2)) {
            $output1 .= $final_topic_array1[$i] . " and ";
        }else if ($i  != (count($final_topic_array1)-2)) {
            $output1 .= $final_topic_array1[$i] . ", ";
        }
    }
}else{
    $output1 .= $final_topic_array1[0];
}
echo rtrim($output1,", ");
?>