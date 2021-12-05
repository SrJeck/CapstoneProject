<?php

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$asc_topic_string_count = "";
$asc_topic_string_key = "";
$desc_topic_string_count = "";
$desc_topic_string_key = "";
// SELECT COUNT(CustomerID), Country
// FROM Customers
// GROUP BY Country
// ORDER BY COUNT(CustomerID) DESC;
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
    // echo "asc".$asc_topic_array_key[$i];
    // echo $asc_topic_array_count[$i]."<br>";
    if ($asc_topic_array_count[$i] == $asc_topic_array_count[0]) {
        $asc_count++;
    }
}

if ($asc_count > 1) {
    $output = "";
    for ($i=0; $i < $asc_count; $i++) { 
        $output .= $asc_topic_array_key[$i].", ";
    }
    echo "topics that have least uploads are ".rtrim($output, ", ")."<br>";
}else{
    $output = $asc_topic_array_key[0];
    echo "topic that have least uploads is".$output."<br>";
}

for ($i=0; $i < count($desc_topic_array_count); $i++) { 
    // echo "desc".$desc_topic_array_key[$i]."";
    // echo $desc_topic_array_count[$i]."<br>";
    if ($desc_topic_array_count[$i] == $desc_topic_array_count[0]) {
        $desc_count++;
    }
}

if ($desc_count > 1) {
    $output = "";
    for ($i=0; $i < $desc_count; $i++) { 
        $output .= $desc_topic_array_key[$i];
    }
    echo "topics that have most uploads are ".rtrim($output, ", ")."<br>";
}else{
    $output = $desc_topic_array_key[0];
    echo "topic that have most uploads is ".$output."<br>";
}

?>