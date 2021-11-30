<?php
//echo substr_replace($all_rows,"",-1);
// $arr = substr_replace($all_rows,"",-1);
// $new_arr = explode(",",$arr);
// $count = 0;
// $new_Arr = [];
// for ($i=0; $i < (count($new_arr)/2); $i++) { 
//     $new_Arr[$i] = [];
//     for ($j=0; $j < 2; $j++) { 
//         $new_Arr[$i][$j] = $new_arr[$count++];
//         //echo $new_arr[$count++];
//     }
// }
// foreach ($new_Arr as $key => $value) {
//     echo $key . " : " . $value."<br>";
// }

// for ($i=0; $i < (count($new_arr)/2); $i++) {
//         echo $new_Arr[$i][0]." : ".$new_Arr[$i][1]."<br>";


$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");


//collect and store all years
$fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year');
$fetch_year->execute();
$year_rows = "";
while ($fetched_year = $fetch_year->fetch()) {
    //echo $fetched_year['publication_year'] . ' : ' . $fetched_year['number_of_year'].'<br>';
    $year_rows = $year_rows . $fetched_year['publication_year'] . ',';
}
//echo $year_rows .'<br>';

//collect and store all topic
$fetch_topic = $dbh->prepare('SELECT topic, COUNT(*) AS number_of_topic FROM research GROUP BY topic');
$fetch_topic->execute();
$topic_rows = "";
$first_row = "['Year'";
while ($fetched_topic = $fetch_topic->fetch()) {
    //echo $fetched_topic['topic'] . ' : ' . $fetched_topic['number_of_topic'].'<br>';
    $topic_rows = $topic_rows . ',' . $fetched_topic['topic'];
    $first_row  = $first_row .",'".$fetched_topic['topic'] ."'";
}
echo $first_row .']';


$topic_arr = explode(",",$topic_rows);
$new_year_rows = substr_replace($year_rows,"",-1);
$year_arr = explode(",",$new_year_rows);

$topic_length = count($topic_arr);
$year_length = count($year_arr);


$year_topic_count = "";
for ($i=0; $i < $year_length; $i++) { 
    //$year_topic_count = $year_arr[$i];
    $year_topic_count = ",['". $year_arr[$i]."'";
    for ($j=0; $j < $topic_length-1; $j++) { 
        $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
        $fetch_count->bindParam(1, $topic_arr[$j]);
        $fetch_count->bindParam(2, $year_arr[$i]);
        $fetch_count->execute();
        $fetched_count = $fetch_count->fetch();
        $year_topic_count = $year_topic_count . ", ". $fetched_count['number_count'];
    }
    echo $year_topic_count."]";
    $year_topic_count = "";
}
echo  $topic_rows."<br>";
echo  $year_rows."<br>";
echo  $topic_length." topic <br>";
echo  $year_length." year <br>";
// $fetch_topic = $dbh->prepare('SELECT COUNT(*) AS number_occured FROM research WHERE topic="analysis" AND publication_year=1996');
// $fetch_topic->execute();
// while ($fetched_topic = $fetch_topic->fetch()) {
//     echo $fetched_topic['number_occured'].'<br>';
// }



    // $new_stat = $dbh->prepare('SELECT publication_year,topic, COUNT(*) AS number_of_research FROM research where publication_year="2021" GROUP BY topic');
    // $new_stat->execute();
    // $topic_row = "";
    // $year_row = "";
    // $count_row = "";
    // while ($rows = $new_stat->fetch()) {

    //     echo $rows['publication_year']."".$rows['topic']."".$rows['number_of_research']."<br>";
    //     $topic_row = $topic_row . ",'". $rows['topic'] ."'";
    //     $year_row = $year_row . $rows['publication_year'] . ",";
    //     $count_row = $count_row . $rows['number_of_research'] . ",";
    //   }

    //   echo $topic_row."<br>";
    //   echo $year_row."<br>";
    //   echo $count_row."<br>";
    // //   echo "['Year'".$topic_row."],<br>";

    //   $arr_topic = explode(",",$topic_row);
    //   $arr_year = explode(",",$year_row);
    //   $arr_count = explode(",",$count_row);

    //   echo count($arr_topic)."<br>";
    //   echo count($arr_year)."<br>";
    //   echo count($arr_count)."<br>";

    //   $year_count = "";
    // for ($i=0; $i < count($arr_year); $i++) { 
    //   $year_count = $year_count . "'".$arr_year[$i]."'";
    //   for ($j=0; $j < count($arr_topic); $j++) { 
    //     $year_count = $year_count . ",".$arr_count[$j];
    //   }
    //   echo "[".$year_count."],<br>";
    // }

    
// }
?>
