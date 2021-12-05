<?php

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
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
echo "The ".rtrim($desc_output_key, ", ")." have the highest number of uploaded topics with ".$desc_output_count." number of uploads while the ".rtrim($asc_output_key, ", ")." have the lowest number of uploaded topics with ".$asc_output_count." number of uploads."
?>