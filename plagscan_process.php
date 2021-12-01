<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
}
$output_string = "";


$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$name = $_FILES['myfile']['name'];
$type = $_FILES['myfile']['type'];
$title = $_POST['title'];
$author = $_POST['author'];
$publication_month = $_POST['publication_month'];
$publication_day = $_POST['publication_day'];
$publication_year = $_POST['publication_year'];
$institution = $_POST['institution'];
$degree_level = $_POST['degree_level'];
$topic = $_POST['topic'];
$research_type = $_POST['research_type'];
$abstract = $_POST['abstract'];
// $abstract = $_POST['fullText'];
$keywords = $_POST['keywords'];
$publisher = $_POST['publisher'];
$permission = $_POST['permission'];
$upload_status = 'Unposted';
$admin_id = 0;
$data = file_get_contents($_FILES['myfile']['tmp_name']);
$stmt = $dbh->prepare("insert into research values('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'')");
$stmt->bindParam(1, $title);
$stmt->bindParam(2, $author);
$stmt->bindParam(3, $publication_month);
$stmt->bindParam(4, $publication_day);
$stmt->bindParam(5, $publication_year);
$stmt->bindParam(6, $name);
$stmt->bindParam(7, $data);
$stmt->bindParam(8, $type);
$stmt->bindParam(9, $institution);
$stmt->bindParam(10, $degree_level);
$stmt->bindParam(11, $topic);
$stmt->bindParam(12, $research_type);
$stmt->bindParam(13, $abstract);
$stmt->bindParam(14, $keywords);
$stmt->bindParam(15, $publisher);
$stmt->bindParam(16, $permission);
$stmt->bindParam(17, $upload_status);
$stmt->bindParam(18, $plagPercent);
$stmt->bindParam(19, $unPercent);
$stmt->bindParam(20, $id);
$stmt->execute();


?>
<html>

<head>
    <title>Add Article</title>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/add_article.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
        <a style="margin-top: 6px;" href="index.php">HOME</a>
        <a style="margin-top: 6px;" href="research.php">JOURNALS</a>
        <a style="margin-top: 6px;" href="analytics.php">ANALYTICS</a>
        <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
        <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
        <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>
    <br><br><br><br>
    <div>
        <?php

        error_reporting(0);
        // getting the form input and preparing the results block
        require 'simple_html_dom.php';
        //$data = $_POST['fullText'] ?? null;
        $data = $_POST['abstract'] ?? null;
        $not_printed = true;
        $data_arr = explode(PHP_EOL, $data);
        for ($i = 0; $i < count($data_arr); $i++) {
            $data_arr[$i] = trim($data_arr[$i]);
        }
        $data_arr = array_filter($data_arr);
        $totalSentences = 0;
        $plagUrls = [];
        $plagCount = 0;
        foreach ($data_arr as $line) {
            $line = explode(". ", $line);
            for ($i = 0; $i < count($line); $i++) {
                $line[$i] = trim($line[$i], ' ";.,“”');
                $line[$i] = trim($line[$i], "'");
            }
            $line = array_filter($line);
            if (count($line) > 0 && $not_printed) {

                $output_string = $output_string . "<div class = 'results' id='result'><h4>Results</h4>";
                $not_printed = false;
            }

            // print_r($data);

            foreach ($line as $sentence) {
                if (strlen($sentence) < 2) {
                    continue;
                }
                $totalSentences++;
                $s1 = "";
                $n = strlen($sentence);
                $sentence = str_replace('“', '"', $sentence);
                $sentence = str_replace('”', '"', $sentence);
                $sentence = str_replace('‘', "'", $sentence);
                $sentence = str_replace('’', "'", $sentence);

                $s1 = "";
                $n = strlen($sentence);
                for ($i = 0; $i < $n; $i++) {
                    // echo $sentence[$i]."<br>";
                    if (
                        $sentence[$i] == ' '
                        && $i + 1 < $n
                        && ($sentence[$i + 1] != '.')
                        && ($sentence[$i + 1] != '"')
                        && ($sentence[$i + 1] != "'")
                        && !($sentence[$i + 1] >= 0 && $sentence[$i + 1] <= 9)
                        && !($sentence[$i + 1] >= 'a' && $sentence[$i + 1] <= 'z')
                        && !($sentence[$i + 1] >= 'A' && $sentence[$i + 1] <= 'Z')
                    ) {
                        continue;
                    }
                    if (
                        $sentence[$i] != '.'
                        && $sentence[$i] != ' '
                        && ($sentence[$i] != '"')
                        && ($sentence[$i] != "'")
                        && !($sentence[$i] >= 0 && $sentence[$i] <= 9)
                        && !($sentence[$i] >= 'a' && $sentence[$i] <= 'z')
                        && !($sentence[$i] >= 'A' && $sentence[$i] <= 'Z')
                    ) {

                        if ($i + 1 < $n && $sentence[$i + 1] != ' ') {
                            $s1 .= $sentence[$i] . ' ';
                        } else {
                            $s1 .= $sentence[$i];
                        }
                    } else {
                        $s1 .= $sentence[$i];
                    }
                }
                $sentence = $s1;
                $query = urlencode($sentence);
                $url = 'https://www.google.com/search?q=' . $query;
                //echo $url;
                $result = file_get_html($url);
                $found = false;
                foreach ($result->find('#main div .ZINbbc.xpd.O9g5cc.uUPGi') as $entry) {
                    // echo $entry;
                    $text = $entry->find('.kCrYT div .BNeawe.s3v9rd.AP7Wnd div div (.BNeawe.s3v9rd.AP7Wnd)');
                    $text = $text[0]->plaintext ?? null;
                    if (strlen($text) < 2) {
                        continue;
                    }
                    $text = str_replace('&#8220;', '"', $text);
                    $text = str_replace('&#8221;', '"', $text);
                    $text = str_replace('&#8216;', "'", $text);
                    $text = str_replace('&#8217;', "'", $text);
                    $s1 = "";
                    $n = strlen($text);
                    for ($i = 0; $i < $n; $i++) {
                        if (
                            $text[$i] == ' '
                            && $i + 1 < $n
                            && ($text[$i + 1] != '.')
                            && ($text[$i + 1] != '"')
                            && ($text[$i + 1] != "'")
                            && !($text[$i + 1] >= 0 && $text[$i + 1] <= 9)
                            && !($text[$i + 1] >= 'a' && $text[$i + 1] <= 'z')
                            && !($text[$i + 1] >= 'A' && $text[$i + 1] <= 'Z')
                        ) {
                            continue;
                        }
                        if (
                            $text[$i] != '.'
                            && $text[$i] != ' '
                            && ($text[$i] != '"')
                            && ($text[$i] != "'")
                            && !($text[$i] >= 0 && $text[$i] <= 9)
                            && !($text[$i] >= 'a' && $text[$i] <= 'z')
                            && !($text[$i] >= 'A' && $text[$i] <= 'Z')
                        ) {

                            if ($i + 1 < $n && $text[$i + 1] != ' ') {
                                $s1 .= $text[$i] . ' ';
                            } else {
                                $s1 .= $text[$i];
                            }
                        } else {
                            $s1 .= $text[$i];
                        }
                    }
                    $text = $s1;

                    $urlstring = $entry->find('.kCrYT a');
                    $urlstring = $urlstring[0]->href;
                    $pattern = "/q=(http|https):\/\/(.+?)\//";
                    preg_match($pattern, $urlstring, $matches);
                    $urlstring = $matches[2];
                    // echo "$urlstring<br>$text<br><br>";
                    // $arr[$urlstring] = $text;
                    if (strpos($text, $sentence) !== false) {
                        $plagCount++;
                        $plagUrls[$urlstring]++;
                        echo "<div class = 'sent'>
                                    <div class = 'plag'>plagiarised</div>$sentence - <strong>$urlstring</strong>
                                    </div><br>";
                        $found = true;
                        break;
                    }
                }
                if ($found === false) {
                    $url = 'https://www.google.com/search?q=' . $query;
                    $url .= '&cr=countryIN';
                    $result = file_get_html($url);
                    foreach ($result->find('#main div .ZINbbc.xpd.O9g5cc.uUPGi') as $entry) {
                        // echo $entry;
                        $text = $entry->find('.kCrYT div .BNeawe.s3v9rd.AP7Wnd div div (.BNeawe.s3v9rd.AP7Wnd)');
                        $text = $text[0]->plaintext ?? null;
                        if (strlen($text) < 2) {
                            continue;
                        }
                        $text = str_replace('&#8220;', '"', $text);
                        $text = str_replace('&#8221;', '"', $text);
                        $text = str_replace('&#8216;', "'", $text);
                        $text = str_replace('&#8217;', "'", $text);
                        $s1 = "";
                        $n = strlen($text);
                        for ($i = 0; $i < $n; $i++) {
                            if (
                                $text[$i] == ' '
                                && $i + 1 < $n
                                && ($text[$i + 1] != '.')
                                && ($text[$i + 1] != '"')
                                && ($text[$i + 1] != "'")
                                && !($text[$i + 1] >= 0 && $text[$i + 1] <= 9)
                                && !($text[$i + 1] >= 'a' && $text[$i + 1] <= 'z')
                                && !($text[$i + 1] >= 'A' && $text[$i + 1] <= 'Z')
                            ) {
                                continue;
                            }
                            if (
                                $text[$i] != '.'
                                && $text[$i] != ' '
                                && ($text[$i] != '"')
                                && ($text[$i] != "'")
                                && !($text[$i] >= 0 && $text[$i] <= 9)
                                && !($text[$i] >= 'a' && $text[$i] <= 'z')
                                && !($text[$i] >= 'A' && $text[$i] <= 'Z')
                            ) {

                                if ($i + 1 < $n && $text[$i + 1] != ' ') {
                                    $s1 .= $text[$i] . ' ';
                                } else {
                                    $s1 .= $text[$i];
                                }
                            } else {
                                $s1 .= $text[$i];
                            }
                        }
                        $text = $s1;

                        $urlstring = $entry->find('.kCrYT a');
                        $urlstring = $urlstring[0]->href;
                        $pattern = "/q=(http|https):\/\/(.+?)\//";
                        preg_match($pattern, $urlstring, $matches);
                        $urlstring = $matches[2];
                        // echo "$urlstring<br>$text<br><br>";
                        // $arr[$urlstring] = $text;
                        if (strpos($text, $sentence) != false) {
                            $plagCount++;
                            $plagUrls[$urlstring]++;

                            $output_string = $output_string . "<div class = 'sent'>
                                        <div class = 'plag'>plagiarised</div>$sentence - <strong>$urlstring</strong>
                                    </div><br>";
                            $found = true;
                            break;
                        }
                    }
                    if ($found === false) {
                        $output_string = $output_string . "<div class = 'sent'>
                                        <div class = 'uni'>unique</div>$sentence
                                    </div><br>";
                    }
                }
            }
        }
        $output_string = $output_string . "</div>";
        // print_r($plagUrls);
        $plagPercent = ($plagCount / $totalSentences) * 100;
        $unPercent = 100 - $plagPercent;


        if (count($plagUrls) > 0) {
            $output_string = $output_string .  "<div class = 'topSource'><h4>Top Sources</h4><br>";
            foreach ($plagUrls as $key => $value) {
                $x = ($value / $plagCount) * 100;
                $output_string = $output_string .  "<div class = 'sent'>
                $key - <strong style='color:rgb(245, 59, 59)'> " . number_format((float)$x, 2, '.', '') . "% </strong> </div><br>";
            }
            $output_string = $output_string .  " </div>";
        } else {
            $output_string = $output_string .   "<script>
                        document.getElementById('result').style.width = '96%';
                        document.getElementById('result').style.margin = '2% 2% 3% 2%';
                    </script>";
        }

        // printing the overview block
        if (is_countable($plagUrls) && count($plagUrls) > 0) {
            $output_string = $output_string .  "<div class = 'overview' ><h4>Results:</h4>
            <div class='circle' style='display: flex;'>
            <div class = 'box1'>
            <div class='plagiarized'>" .
                number_format((float)$plagPercent, 2, '.', '') . "%
            </div>
            <div style='font-weight:bold; margin-top: -50px'>
            plagiarised
            </div>
            </div>
            <div class = 'box2'>
            <div class='unique'><strong>" .
                number_format((float)$unPercent, 2, '.', '') . "%
            </strong></div>
            <div style='font-weight:bold; margin-top: -50px; margin-left: 10px;'>
            unique
            </div>
            </div>
            </div><br><br>
            </div>";
        }

        // printing the Download button and Check New button
        // if ($_POST['fullText'] ?? null) {
        if ($_POST['abstract'] ?? null) {
            $output_string = $output_string . "
                <div class = 'boxes' >
                
                <button class = 'downR' onclick='window.print()'>  <i class='fas fa-download'></i>   Download Report </button>
                <button class='submit' name='proceed' onclick='proceed()'> Finish </button><br><br><br>
                </div>";
        }

        echo $output_string;
        ?>

    </div>


</body>

</html>


<?php

?>