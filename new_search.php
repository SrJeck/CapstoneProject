<html>

<head>
 
<script type="text/javascript" src="script.js"></script>
</head>
<body>
    
<form action="" method="post">
<input name="search" placeholder="search  ">
<button type="submit">submit</button><br>
<select class="sortby" name="sort">
    <option selected="selected"  value="" selected disabled hidden>Relevance</option>
    <option value="DESC">Newest-Oldest</option>
    <option value="ASC">Oldest-Newest</option>
</select><br>
<select name="topic" id="topic" class="selecttopic" name="topic">
    <option selected="selected" value="" selected disabled hidden>Select topic</option>
    <option value="Education">Education</option>
    <option value="Technology">Technology</option>
    <option value="Research">Research</option>
    <option value="Analysis">Analysis</option>
    <option value="Database">Database</option>
    <option value="Agriculture">Agriculture</option>
    <option value="Health">Health</option>
    <option value="Politics">Politics</option>
    <option value="Psychology">Psychology</option>
    <option value="Business">Business</option>
    <option value="Marketing and Advertising">Marketing and Advertising</option>
    <option value="Mechanical">Mechanical</option>
    <option value="Ethics">Ethics</option>
    <option value="Others">Others</option>
</select><br>
<input type="text" class="fromDate" name="yearFrom"><br>
<input type="text" class="toDate" name="yearTo"><br>
<button type="submit">apply</button>
</form>
<?php
session_start();
if (!empty($_POST["topic"])) {
    $topic = $_POST["topic"];
    $topic2 = $_POST["topic"];
}
if (!empty($_POST["yearFrom"])) {
    $yearFrom = $_POST["yearFrom"];
    $yearFrom2 = $_POST["yearFrom"];
}



$query = "";
$sort = " ORDER BY publication_year DESC";
$yearTo = date("Y");
$between = "";

$query2 = "";
$sort2 = " ORDER BY publication_year DESC";
$yearTo2 = date("Y");
$between2 = "";

if (!empty($_POST["search"])) {
    $query = "SELECT COUNT(*) AS counted FROM research WHERE topic LIKE '%". $_POST["search"] . "%' OR title LIKE '%". $_POST["search"] . "%' OR author LIKE '%". $_POST["search"] . "%'";
    $query2 = "SELECT *FROM research WHERE topic LIKE '%". $_POST["search"] . "%' OR title LIKE '%". $_POST["search"] . "%' OR author LIKE '%". $_POST["search"] . "%'";
    
    $_SESSION['search_session1'] = $query;
    $_SESSION['search_session2'] = $query2;
}
if (!empty($_POST["topic"])) {
        $query = "SELECT COUNT(*) AS counted FROM research WHERE topic LIKE '%". $_POST["topic"] . "%'";
        $query2 = "SELECT * FROM research WHERE topic LIKE '%". $_POST["topic"] . "%'";
        $_SESSION['search_session1'] = $query;
        $_SESSION['search_session2'] = $query2;
}
if (isset($_POST["Education"])) {
    $query = "SELECT COUNT(*) AS counted FROM research WHERE topic LIKE '%Education%'";
    $query2 = "SELECT * FROM research WHERE topic LIKE '%Education%'";
    $_SESSION['search_session1'] = $query;
    $_SESSION['search_session2'] = $query2;
}
if (isset($_POST["Technology"])) {
    $query = "SELECT COUNT(*) AS counted FROM research WHERE topic LIKE '%Technology%'";
    $query2 = "SELECT * FROM research WHERE topic LIKE '%Technology%'";
    $_SESSION['search_session1'] = $query;
    $_SESSION['search_session2'] = $query2;
}
if (isset($_POST["Business"])) {
    $query = "SELECT COUNT(*) AS counted FROM research WHERE topic LIKE '%Business%'";
    $query2 = "SELECT * FROM research WHERE topic LIKE '%Business%'";
    $_SESSION['search_session1'] = $query;
    $_SESSION['search_session2'] = $query2;
}

if (!empty($_POST["sort"])) {
    $sort = " ORDER BY publication_year ".$_POST["sort"];
    $sort2 = " ORDER BY publication_year ".$_POST["sort"];
}
if (!empty($_POST["yearFrom"])) {
    if (!empty($_POST["yearTo"])) {
        $yearTo = $_POST["yearTo"];
        $query = "SELECT COUNT(*) AS counted FROM research ";
        $between = " WHERE publication_year BETWEEN ".$yearFrom." AND ".$yearTo;
        $sort = " ORDER BY publication_year ASC";
        $yearTo2 = $_POST["yearTo"];
        $query2 = "SELECT * FROM research ";
        $between2 = " WHERE publication_year BETWEEN ".$yearFrom2." AND ".$yearTo2;
        $sort2 = " ORDER BY publication_year ASC";
    }else {
        $query = "SELECT COUNT(*) AS counted FROM research ";
        $between = " WHERE publication_year BETWEEN ".$yearFrom." AND ".$yearTo;
        $sort = " ORDER BY publication_year ASC";
        $query2 = "SELECT *  FROM research ";
        $between2 = " WHERE publication_year BETWEEN ".$yearFrom2." AND ".$yearTo2;
        $sort2 = " ORDER BY publication_year ASC";
    }
}
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$fetching = $dbh->prepare($_SESSION['search_session1'].$between.$sort);
$fetching->execute();
$fetched = $fetching->fetch();
$counted = $fetched['counted'];
$limit = "3";
$test = "<table>
<tr>
<th>title</th>
<th>author</th>
<th>date</th>
<th>topic</th></tr>";
if ($counted == 0) {
    $test .= "<tr><td colspan='4' style='text-align:center'>No Results</td></tr>";
}
$num = 0;
$prevNum = 0;
for ($i=0; $i < $counted; $i+=3) { 
    $fetching2 = $dbh->prepare($_SESSION['search_session2'].$between2.$sort2." LIMIT ?,?");
    $fetching2->bindParam(1,$i,PDO::PARAM_INT);
    $fetching2->bindParam(2,$limit,PDO::PARAM_INT);
    $fetching2->execute();
    $num++;
    while ($fetched2 = $fetching2->fetch()) {
        if ($num > 1) {
            $test .= "<tr class='page$num' style='display:none'>
        <td>".$fetched2['title']."</td>
        <td>".$fetched2['author']."</td>
        <td>".$fetched2['publication_month'].$fetched2['publication_day'].$fetched2['publication_year']."</td>
        <td>".$fetched2['topic']."</td>
        </tr>";
        }else if ($num == 1){
            $test .= "<tr  class='page$num'  style='display:block'>
        <td>".$fetched2['title']."</td>
        <td>".$fetched2['author']."</td>
        <td>".$fetched2['publication_month'].$fetched2['publication_day'].$fetched2['publication_year']."</td>
        <td>".$fetched2['topic']."</td>
        </tr>";
        }elseif ($num % 3 == 0) {
            $test .= "<tr  class='page$num' >
        <td>".$fetched2['title']."</td>
        <td>".$fetched2['author']."</td>
        <td>".$fetched2['publication_month'].$fetched2['publication_day'].$fetched2['publication_year']."</td>
        <td>".$fetched2['topic']."</td>
        </tr></table>";
        }
        
    }
    
}
echo $test;
for ($i=0; $i < $num; $i++) { 
    $new_num = $i+1;
    if ($new_num > 5) {
        echo "<button class='btn$new_num' style='display:none' type='button' onclick='pageDisplay($new_num,$num)'>$new_num</button>";
    }else{
        echo "<button class='btn$new_num' style='display:block' type='button' onclick='pageDisplay($new_num,$num)'>$new_num</button>";
    }
}
?>
<script>

</script>
</body>
</html>