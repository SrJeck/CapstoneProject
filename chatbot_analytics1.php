<?php

session_start();

$user_id = $_SESSION['user_id'];
$topic = $_POST['topic'];
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

$topic_array1 = array();
$count_array1 = array();
$final_topic_array1 = array();
$topic_array2 = array();
$count_array2 = array();
$final_topic_array2 = array();
$topic_array3 = array();
$title_array3 = array();
$final_topic_array3 = array();
$curr_date = date("Y");
$output1 = "";
$output2 = "";
$output3 = "";

$topic_output1 = "";
$topic_output2 = "";
$topic_output3 = "";
$topic_position1_num = 0;
$topic_position2_num = 0;
$topic_position3_num = 0;
$topic_position1_str = "";
$topic_position2_str = "";
$topic_position3_str = "";

$stat1 = $dbh->prepare('select topic,count(*) as topic_count from research where publication_year=? group by topic order by topic_count DESC');
$stat1->bindParam(1, $curr_date);
$stat1->execute();
while ($row1 = $stat1->fetch()) {
    array_push($topic_array1, $row1['topic']);
    array_push($count_array1, $row1['topic_count']);
}


$stat2 = $dbh->prepare('select topic,count(*) as topic_count from research group by topic order by topic_count DESC');
$stat2->execute();
while ($row2 = $stat2->fetch()) {
    array_push($topic_array2, $row2['topic']);
    array_push($count_array2, $row2['topic_count']);
}

$stat3 = $dbh->prepare('select * from research group by topic order by publication_year DESC limit 5');
$stat3->execute();
while ($row3 = $stat3->fetch()) {
    array_push($topic_array3, $row3['topic']);
    array_push($title_array3, $row3['title']);
}

for ($i = 0; $i < count($count_array1); $i++) {
    if ($count_array1[0] == $count_array1[$i]) {
        array_push($final_topic_array1, $topic_array1[$i]);
    }
}
for ($i = 0; $i < count($count_array2); $i++) {
    if ($count_array2[0] == $count_array2[$i]) {
        array_push($final_topic_array2, $topic_array2[$i]);
    }
}
for ($i = 0; $i < count($topic_array1); $i++) {
    if ($topic == $topic_array1[$i]) {
        $topic_position1_num = ($i + 1);
    }
}
for ($i = 0; $i < count($topic_array2); $i++) {
    if ($topic == $topic_array2[$i]) {
        $topic_position2_num = ($i + 1);
    }
}
for ($i = 0; $i < count($topic_array3); $i++) {
    if ($topic == $topic_array3[$i]) {
        $topic_position3_num = ($i + 1);
    }
}

if ($topic_position1_num == 0) {
    $topic_position1_str = "not";
} else if ($topic_position1_num == 1) {
    $topic_position1_str = $topic_position1_num . "st";
} else if ($topic_position1_num == 2) {
    $topic_position1_str = $topic_position1_num . "nd";
} else if ($topic_position1_num == 3) {
    $topic_position1_str = $topic_position1_num . "rd";
} else {
    $topic_position1_str = $topic_position1_num . "th";
}

if ($topic_position2_num == 0) {
    $topic_position2_str = "not";
} else if ($topic_position2_num == 1) {
    $topic_position2_str = $topic_position2_num . "st";
} else if ($topic_position2_num == 2) {
    $topic_position2_str = $topic_position2_num . "nd";
} else if ($topic_position2_num == 3) {
    $topic_position2_str = $topic_position2_num . "rd";
} else {
    $topic_position2_str = $topic_position2_num . "th";
}

if ($topic_position3_num == 0) {
    $topic_position3_str = "not";
} else if ($topic_position3_num == 1) {
    $topic_position3_str = $topic_position3_num . "st";
} else if ($topic_position3_num == 2) {
    $topic_position3_str = $topic_position3_num . "nd";
} else if ($topic_position3_num == 3) {
    $topic_position3_str = $topic_position3_num . "rd";
} else {
    $topic_position3_str = $topic_position3_num . "th";
}

if (count($final_topic_array1) > 1) {
    for ($i = 0; $i < count($final_topic_array1); $i++) {
        if ($i == (count($final_topic_array1) - 2)) {
            $output1 .= $final_topic_array1[$i] . " and ";
        } else if ($i  != (count($final_topic_array1) - 2)) {
            $output1 .= $final_topic_array1[$i] . ", ";
        }
    }
} else {
    $output1 .= $final_topic_array1[0];
}
if (count($final_topic_array2) > 1) {
    for ($i = 0; $i < count($final_topic_array2); $i++) {
        if ($i == (count($final_topic_array2) - 2)) {
            $output2 .= $final_topic_array2[$i] . " and ";
        } else if ($i  != (count($final_topic_array2) - 2)) {
            $output2 .= $final_topic_array2[$i] . ", ";
        }
    }
} else {
    $output2 .= $final_topic_array2[0];
}


for ($i = 0; $i < count($topic_array3); $i++) {
    $output3 .= "Title: " . $title_array3[$i] . "<br>Topic: " . $topic_array3[$i] . "";
}



echo "The " . $topic . " is " . $topic_position1_str . " in the Highest Upload in 12 months<br><br>";
echo "The " . $topic . " is " . $topic_position2_str . " in the Highest upload in Total<br><br>";
echo "The " . $topic . " is " . $topic_position3_str . " in the Recent Uploaded Study<br><br>";


echo "Highest upload in 12 months<br><br>" . rtrim($output1, ", ") . "<br><br>";
echo "Highest upload in Total<br><br>" . rtrim($output2, ", ") . "<br><br>";
echo "Recent Uploaded Study<br><br>" . rtrim($output3, "<br><br>");
