<?php

$topic_list = array("technology","education","research","analysis","database","agriculture","health","politics","business","marketing","mechanical","ethics","others");
$count_list = array();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

for ($i=0; $i < count($topic_list); $i++) { 
    $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
    $topic->bindParam(1,$topic_list[$i]);
    $topic->execute();
    $topic_rows = $topic->fetch();
    array_push($count_list,$topic_rows['number_of_research']);
    //echo "['" . $topic_list[$i] . "', " . $topic_rows['number_of_research'] . "],";
  }

$topic_string = "";
for ($i=0; $i < count($topic_list); $i++) { 
    $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
    $topic->bindParam(1,$topic_list[$i]);
    $topic->execute();
    $topic_rows = $topic->fetch();
    $topic_string .= $topic_rows['number_of_research'] . " : " .$topic_list[$i].", ";
  }


 $asc_topic_array = explode(", ",rtrim($topic_string, ", "));
 $desc_topic_array = explode(", ",rtrim($topic_string, ", "));

 $asc_topic_array_count = array();
 $asc_topic_array_key = array();
 $asc_topic_array_key2 = array();
 $desc_topic_array_count = array();
 $desc_topic_array_key = array();
 $desc_topic_array_key2 = array();
 sort($asc_topic_array);
 rsort($desc_topic_array);
 for ($i=0; $i < count($asc_topic_array); $i++) {
    $splitter = explode(" : ",$asc_topic_array[$i]);
    array_push($asc_topic_array_count,$splitter[0]);
    array_push($asc_topic_array_key,$splitter[1]);
 }
 for ($i=0; $i < count($desc_topic_array); $i++) {
    $splitter = explode(" : ",$desc_topic_array[$i]);
    array_push($desc_topic_array_count,$splitter[0]);
    array_push($desc_topic_array_key,$splitter[1]);
 }
$asc_count = 0;
$desc_count = 0;
for ($i=0; $i < count($asc_topic_array_count); $i++) { 
    if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
        $asc_count++;
    }
}
for ($i=0; $i < count($desc_topic_array_count); $i++) { 
    if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
        $desc_count++;
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
        array_push($asc_topic_array_key2,$asc_topic_array_key[$i]);
    }
    if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
    }else{
        $asc_output_count = $asc_topic_array_count[0];
    }
}else{
    array_push($asc_topic_array_key2,$asc_topic_array_key[0]);
    $asc_output_key = $asc_topic_array_key[0];
    if ($asc_topic_array_count[0] == 0) {
        $asc_output_count = "no";
    }else{
        $asc_output_count = $asc_topic_array_count[0];
    }
}


$desc_output_key = "";
$desc_output_count = "";
if ($desc_count > 1) {
    for ($i=0; $i < $desc_count; $i++) { 
        if ($i == ($asc_count-2)) {
            $desc_output_key .= $desc_topic_array_key[$i]." and ";
        }else{
            $desc_output_key .= $desc_topic_array_key[$i].", ";
        }
        array_push($asc_topic_array_key2,$asc_topic_array_key[$i]);
    }
    $desc_output_count = $desc_topic_array_count[0];
}else{
    array_push($desc_topic_array_key2,$desc_topic_array_key[0]);
    $desc_output_key = $desc_topic_array_key[0];
    $desc_output_count = $desc_topic_array_count[0];
}





$asc_string = "";
$asc_count = 0;
$desc_string = "";
$desc_count = 0;
$topic_string = "";
for ($i=0; $i < count($topic_list); $i++) { 
    $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
    $topic->bindParam(1,$topic_list[$i]);
    $topic->execute();
    $topic_rows = $topic->fetch();
    $topic_string .= $topic_rows['number_of_research'] . " : " .$topic_list[$i].", ";
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

$year_arr = explode(",",substr_replace($year_rows,"",-1)) ;

$topic_length = count($topic_list);
$year_length = count($year_arr);

for ($i = 0; $i < $year_length; $i++) {
  $string_output .= $year_arr[$i]." - ";
  for ($j = 0; $j < $topic_length; $j++) {
    $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
    $fetch_count->bindParam(1, $topic_list[$j]);
    $fetch_count->bindParam(2, $year_arr[$i]);
    $fetch_count->execute();
    $fetched_count = $fetch_count->fetch();
    $string_output .= $fetched_count['number_count'] . " : " . $topic_list[$j].", ";
  }
  $string_output .= " / ";
}
$string_output2 = explode(" / ",substr($string_output,0,-3));
for ($i=0; $i < count($string_output2); $i++) { 
    $string_output3 = explode(" - ",$string_output2[$i]);
    $string_holder = $string_output3[1];
    $asc_string .=  $string_output3[0]." - ";
    $desc_string .= $string_output3[0]." - ";
    $string_output4 = explode(", ",substr_replace($string_output3[1],"",-2));
    $string_output5 = explode(", ",substr_replace($string_output3[1],"",-2));
    sort($string_output4);
    rsort($string_output5);
    for ($j=0; $j < count($string_output4); $j++) { 
      $string_holder1 = $string_output4[0];
      $string_holder2 = $string_output4[$j];
        if ($string_holder1[0] == $string_holder2[0]) {
            $asc_string .= $string_output4[$j]. ", ";
        }
    }
    for ($j=0; $j < count($string_output5); $j++) { 
      $string_holder1 = $string_output5[0];
      $string_holder2 = $string_output5[$j];
      if ($string_holder1[0] == $string_holder2[0]) {
        $desc_string .= $string_output5[$j]. ", ";
      }
    }
    $asc_string .= " / ";
    $desc_string .= " / ";
}
//echo $asc_string."<br>";
//echo $desc_string;

$asc_string_output2 = explode(" / ",substr_replace($asc_string,"",-4)) ;
$desc_string_output2 = explode(" / ",substr_replace($desc_string,"",-4)) ;
// echo substr_replace($asc_string,"",-4)."<br>";
// echo substr_replace($desc_string,"",-4);


$asc_counter = 0;
$desc_counter = 0;
$asc_counter_output = "";
$desc_counter_output  = "";
for ($i=0; $i < count($asc_topic_array_key2); $i++) { 
    for ($j=0; $j < count($asc_string_output2); $j++) { 
    if (str_contains($asc_string_output2[$j],$asc_topic_array_key2[$i])) {
        $asc_counter++;
    }else{
        $asc_counter=0;
        break;
    }
    }
    $asc_counter_output .= $asc_topic_array_key2[$i] . " : " . $asc_counter .",";
    $asc_counter = 0;
}
for ($i=0; $i < count($desc_topic_array_key2); $i++) { 
    for ($j=0; $j < count($desc_string_output2); $j++) {
        if (str_contains($desc_string_output2[$j],$desc_topic_array_key2[$i])) {
            $desc_counter++;
        }else{
            $desc_counter=0;
            break;
        }
    }
    $desc_counter_output .= $desc_topic_array_key2[$i] . " : " . $desc_counter .",";
}
echo  $asc_counter_output."<br>";
echo  $desc_counter_output;

?>






<?php



// $topic_list = array("technology","education","research","analysis","database","agriculture","health","politics","business","marketing","mechanical","ethics","others");

// $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");


// $topic_string = "";
// for ($i=0; $i < count($topic_list); $i++) { 
//     $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
//     $topic->bindParam(1,$topic_list[$i]);
//     $topic->execute();
//     $topic_rows = $topic->fetch();
//     $topic_string .= $topic_rows['number_of_research'] . " : " .$topic_list[$i].", ";
//   }


//  $asc_topic_array = explode(", ",rtrim($topic_string, ", "));
//  $desc_topic_array = explode(", ",rtrim($topic_string, ", "));

//  $asc_topic_array_count = array();
//  $asc_topic_array_key = array();
//  $asc_topic_array_key2 = array();
//  $desc_topic_array_count = array();
//  $desc_topic_array_key = array();
//  $desc_topic_array_key2 = array();
//  sort($asc_topic_array);
//  rsort($desc_topic_array);
//  for ($i=0; $i < count($asc_topic_array); $i++) {
//     $splitter = explode(" : ",$asc_topic_array[$i]);
//     array_push($asc_topic_array_count,$splitter[0]);
//     array_push($asc_topic_array_key,$splitter[1]);
//  }
//  for ($i=0; $i < count($desc_topic_array); $i++) {
//     $splitter = explode(" : ",$desc_topic_array[$i]);
//     array_push($desc_topic_array_count,$splitter[0]);
//     array_push($desc_topic_array_key,$splitter[1]);
//  }
// $asc_count = 0;
// $desc_count = 0;
// for ($i=0; $i < count($asc_topic_array_count); $i++) { 
//     if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
//         $asc_count++;
//     }
// }
// for ($i=0; $i < count($desc_topic_array_count); $i++) { 
//     if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
//         $desc_count++;
//     }
// }

// $asc_output_key = "";
// $asc_output_count = "";
// if ($asc_count > 1) {
//     for ($i=0; $i < $asc_count; $i++) { 
//         if ($i == ($asc_count-2)) {
//             $asc_output_key .= $asc_topic_array_key[$i]." and ";
//         }else{
//             $asc_output_key .= $asc_topic_array_key[$i].", ";
//         }
//         array_push($asc_topic_array_key2,$asc_topic_array_key[$i]);
//     }
//     if ($asc_topic_array_count[0] == 0) {
//         $asc_output_count = "no";
//     }else{
//         $asc_output_count = $asc_topic_array_count[0];
//     }
// }else{
//     array_push($asc_topic_array_key2,$asc_topic_array_key[0]);
//     $asc_output_key = $asc_topic_array_key[0];
//     if ($asc_topic_array_count[0] == 0) {
//         $asc_output_count = "no";
//     }else{
//         $asc_output_count = $asc_topic_array_count[0];
//     }
// }


// $desc_output_key = "";
// $desc_output_count = "";
// if ($desc_count > 1) {
//     for ($i=0; $i < $desc_count; $i++) { 
//         if ($i == ($asc_count-2)) {
//             $desc_output_key .= $desc_topic_array_key[$i]." and ";
//         }else{
//             $desc_output_key .= $desc_topic_array_key[$i].", ";
//         }
//         array_push($asc_topic_array_key2,$asc_topic_array_key[$i]);
//     }
//     $desc_output_count = $desc_topic_array_count[0];
// }else{
//     array_push($desc_topic_array_key2,$desc_topic_array_key[0]);
//     $desc_output_key = $desc_topic_array_key[0];
//     $desc_output_count = $desc_topic_array_count[0];
// }






// $topic_string = "";
// for ($i=0; $i < count($topic_list); $i++) { 
//     $topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
//     $topic->bindParam(1,$topic_list[$i]);
//     $topic->execute();
//     $topic_rows = $topic->fetch();
//     $topic_string .= $topic_rows['number_of_research'] . " : " .$topic_list[$i].", ";
//   }


//  $asc_topic_array = explode(", ",rtrim($topic_string, ", "));
//  $desc_topic_array = explode(", ",rtrim($topic_string, ", "));

//  $asc_topic_array_count = array();
//  $asc_topic_array_key = array();
//  $desc_topic_array_count = array();
//  $desc_topic_array_key = array();
//  sort($asc_topic_array);
//  rsort($desc_topic_array);
//  for ($i=0; $i < count($asc_topic_array); $i++) {
//     $splitter = explode(" : ",$asc_topic_array[$i]);
//     array_push($asc_topic_array_count,$splitter[0]);
//     array_push($asc_topic_array_key,$splitter[1]);
//  }
//  for ($i=0; $i < count($desc_topic_array); $i++) {
//     $splitter = explode(" : ",$desc_topic_array[$i]);
//     array_push($desc_topic_array_count,$splitter[0]);
//     array_push($desc_topic_array_key,$splitter[1]);
//  }
// $asc_count = 0;
// $desc_count = 0;
// for ($i=0; $i < count($asc_topic_array_count); $i++) { 
//     if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
//         $asc_count++;
//     }
// }
// for ($i=0; $i < count($desc_topic_array_count); $i++) { 
//     if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
//         $desc_count++;
//     }
// }


// $asc_topics = "";
// $desc_topics = "";

// $asc_output_key = "";
// $asc_output_count = "";
// if ($asc_count > 1) {
//     for ($i=0; $i < $asc_count; $i++) { 
//         if ($i == ($asc_count-2)) {
//             $asc_output_key .= $asc_topic_array_key[$i]." and ";
//         }else{
//             $asc_output_key .= $asc_topic_array_key[$i].", ";
//         }
//         $asc_topics .= $asc_topic_array_key[$i].", ";
//     }
//     if ($asc_topic_array_count[0] == 0) {
//         $asc_output_count = "no";
//     }else{
//         $asc_output_count = $asc_topic_array_count[0];
//     }
// }else{
  
//     $asc_topics .= $asc_topic_array_key[0];
//     $asc_output_key = $asc_topic_array_key[0];
//     if ($asc_topic_array_count[0] == 0) {
//         $asc_output_count = "no";
//     }else{
//         $asc_output_count = $asc_topic_array_count[0];
//     }
// }

// $desc_output_key = "";
// $desc_output_count = "";
// if ($desc_count > 1) {
//     for ($i=0; $i < $desc_count; $i++) { 
//         if ($i == ($asc_count-2)) {
//             $desc_output_key .= $desc_topic_array_key[$i]." and ";
//         }else{
//             $desc_output_key .= $desc_topic_array_key[$i].", ";
//         }
//         $desc_topics .= $desc_topic_array_key[$i].", ";
//     }
//     $desc_output_count = $desc_topic_array_count[0];
// }else{
//     $desc_topics .= $desc_topic_array_key[0];
//     $desc_output_key = $desc_topic_array_key[0];
//     $desc_output_count = $desc_topic_array_count[0];
// }

// $asc_topics_array = explode(", ",rtrim($asc_topics, ", "));
// $desc_topics_array = explode(", ",rtrim($desc_topics, ", "));
// echo "<br>least upload topic<br>";
// for ($i=0; $i < count($asc_topics_array); $i++) { 
//   echo $asc_topics_array[$i]."<br>";
// }
// echo "<br>most upload topic<br>";
// for ($i=0; $i < count($desc_topics_array); $i++) { 
//   echo $desc_topics_array[$i]."<br>";
// }
// $asc_string_output = "";
// $desc_string_output = "";
// //collect and store all years
// $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year DESC');
// $fetch_year->execute();
// $year_rows = "";
// while ($fetched_year = $fetch_year->fetch()) {
//   $year_rows = $year_rows . $fetched_year['publication_year'] . ',';
// }

// $year_arr = explode(",",rtrim($year_rows,",")) ;

// $asc_topic_length = count($asc_topics_array);
// $desc_topic_length = count($desc_topics_array);
// $year_length = count($year_arr);

// for ($i = 0; $i < $year_length; $i++) {
//   $asc_string_output .= " / ". $year_arr[$i]." - ";
//   for ($j = 0; $j < $asc_topic_length; $j++) {
//     $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
    
//     $fetch_count->bindParam(1, $asc_topics_array[$j]);
//     $fetch_count->bindParam(2, $year_arr[$i]);
//     $fetch_count->execute();
//     $fetched_count = $fetch_count->fetch();
//     //$year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];
//     $asc_string_output .= $fetched_count['number_count'] . " : " . $asc_topics_array[$j].", ";
//   }
// }
// for ($i = 0; $i < $year_length; $i++) {
//     $asc_string_output .= " / ". $year_arr[$i]." - ";
//     for ($j = 0; $j < $desc_topic_length; $j++) {
//       $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
      
//       $fetch_count->bindParam(1, $desc_topics_array[$j]);
//       $fetch_count->bindParam(2, $year_arr[$i]);
//       $fetch_count->execute();
//       $fetched_count = $fetch_count->fetch();
//       //$year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];
//       $desc_string_output .= $fetched_count['number_count'] . " : " . $desc_topics_array[$j].", ";
//     }
// }

// // for ($i = 0; $i < $asc_topic_length ; $i++) {
// //   $asc_string_output .= $asc_topics_array[$i]." - ";
// //   for ($j = 0; $j < $year_length; $j++) {
// //     $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
    
// //     $fetch_count->bindParam(1, $asc_topics_array[$j]);
// //     $fetch_count->bindParam(2, $year_arr[$i]);
// //     $fetch_count->execute();
// //     $fetched_count = $fetch_count->fetch();
// //     //$year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];
// //     $asc_string_output .= $fetched_count['number_count'] . " : " . $year_arr[$j].", ";
// //   }
// //   $asc_string_output .= " / "; 
// // }
// // for ($i = 0; $i < $desc_topic_length; $i++) {
// //   $desc_string_output .= $desc_topics_array[$i]." - ";
// //   for ($j = 0; $j < $year_length; $j++) {
// //     $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
    
// //     $fetch_count->bindParam(1, $desc_topics_array[$i]);
// //     $fetch_count->bindParam(2, $year_arr[$j]);
// //     $fetch_count->execute();
// //     $fetched_count = $fetch_count->fetch();
// //     //$year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];
// //     $desc_string_output .= $fetched_count['number_count'] . " : " . $year_arr[$j].", ";
// //   }
// //   $desc_string_output .= " / "; 
// // }
// echo $asc_string_output."<br>";
// echo $desc_string_output;

// $asc_string_output2 = explode(" / ",substr_replace($asc_string_output,"",-3)) ;
// $desc_string_output2 = explode(" / ",substr_replace($desc_string_output,"",-3)) ;
// //echo $asc_string_output;
// //echo $desc_string_output;

// //rsort($asc_string_output2);
// // for ($i=0; $i < count($asc_string_output2); $i++) { 
// //   //echo $asc_string_output2[$i]."<br>";
// //    $asc_string_output3 = explode(" - ",substr_replace($asc_string_output2[$i],"",-2));
// //     echo $asc_string_output3[0]." ";
// //   //  echo $asc_string_output3[1]."<br>";
// //    $asc_string_output4 = explode(", ",$asc_string_output3[1]);
// //    for ($j=0; $j < count($asc_string_output4); $j++) { 
// //         echo $asc_string_output4[$j]."<br>";
// //    }
// // }
// // for ($i=0; $i < count($desc_string_output2); $i++) { 
// //    //echo $desc_string_output2[$i]."<br>";
// //    $desc_string_output3 = explode(" - ",substr_replace($desc_string_output2[$i],"",-2));
// //    echo $desc_string_output3[0]." ";
// //    //echo $desc_string_output3[1]."<br>";
// //    $desc_string_output4 = explode(", ",$desc_string_output3[1]);
// //    for ($j=0; $j < count($desc_string_output4); $j++) { 
// //     echo $desc_string_output4[$j]."<br>";
// //    }
// // }

// $asc_counter = 0;
// $desc_counter = 0;
// $asc_counter_output = "";
// $desc_counter_output  = "";
// for ($i=0; $i < count($asc_topic_array_key2); $i++) { 
//     if (str_contains($asc_string_output,$asc_topic_array_key2[$i])) {
//         $asc_counter++;
//     }else{
//         $asc_counter=0;
//     }
//     $asc_counter_output .= $asc_topic_array_key2[$i] . " : " . $asc_counter .",";
// }
// for ($i=0; $i < count($desc_topic_array_key2); $i++) { 
//     if (str_contains($desc_string_output,$desc_topic_array_key2[$i])) {
//         $desc_counter++;
//     }else{
//         $desc_counter=0;
//     }
//     $desc_counter_output .= $desc_topic_array_key2[$i] . " : " . $desc_counter .",";
// }
//echo  $asc_counter_output."<br>";
//echo  $desc_counter_output;
?>


























<?php
// $topic_year_list = [];
// $year_list = [];
// $topic_string = "";

// //collect and store all years
// $fetch_year = $dbh->prepare('SELECT publication_year, COUNT(*) AS number_of_year FROM research GROUP BY publication_year ASC');
// $fetch_year->execute();
// $year_rows = "";
// while ($fetched_year = $fetch_year->fetch()) {
//   $year_rows = $year_rows . $fetched_year['publication_year'] . ',';
//   array_push($topic_year_list,$fetched_year['publication_year']);
// }

// //collect and store all topic

// $topic_rows = "";
// $first_row = "['Year'";
// for ($i=0; $i < count($topic_list); $i++) { 
//   $fetch_topic = $dbh->prepare('SELECT COUNT(*) AS number_of_research FROM research WHERE topic=?');
//   $fetch_topic->bindParam(1,$topic_list[$i]);
//   $fetch_topic->execute();
//   $fetched_topic = $fetch_topic->fetch();
//   //echo "['" . $topic_list[$i] . "', " . $topic_rows['number_of_research'] . "],";
//   $topic_rows .= $topic_list[$i] . ',';
//   $first_row  .= ",'" . $topic_list[$i] . "'";
// }

// for ($j=0; $j < count($year_list); $j++) { 
//         $topic_year_list[$j] = [];
//     for ($i = 0; $i < count($topic_list); $i++) {
//         $fetch_count = $dbh->prepare('SELECT COUNT(*) AS number_count FROM research WHERE topic=? AND publication_year=?');
//         //$fetch_count->bindParam(1, $topic_arr[$j]);
//         $fetch_count->bindParam(1, $topic_list[$i]);
//         $fetch_count->bindParam(2, $topic_year_list[$j]);
//         $fetch_count->execute();
//         $fetched_count = $fetch_count->fetch();
//         //$year_topic_count = $year_topic_count . ", " . $fetched_count['number_count'];

//         array_push($topic_year_list[$j][$i],$fetched_count['number_count']);
//       }
// }
// // for ($i=0; $i < count($year_list); $i++) { 
// //     //for ($j=0; $j < count($topic_list); $j++) { 
// //        //echo $topic_year_list[$i];
// //        echo $year_list[$i];
// //     //}
// // }
// for ($i=0; $i < count($topic_year_list); $i++) { 
//     for ($j=0; $j < count($topic_list); $j++) { 
//        echo $topic_year_list[$i][$j];
//        //echo $year_list[$i];
//     }
// }

?>