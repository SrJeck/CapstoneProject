<!-- Search and Pagination -->
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
}
require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$title = "";
$author = "";
$topic = "";
$publication_day = "";
$publication_day = "";
$publication_year = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (!empty($v)) {

            $queryCases = array("title", "author", "topic", "publication_day", "publication_day", "publication_year");
            if (in_array($k, $queryCases)) {
                if (!empty($queryCondition)) {
                    $queryCondition .= " OR ";
                } else {
                    $queryCondition .= " WHERE ";
                }
            }
            switch ($k) {
                case "title":
                    $title = $v;
                    $queryCondition .= "title LIKE '%" . $v . "%'"  . "OR author LIKE'%" . $v . "%'"  . "OR topic LIKE'%" . $v . "%'";
                    break;
            }
        }
    }
}
$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM research " . $queryCondition;
$href = 'journals.php';

$perPage = 3;
$page = 1;
if (isset($_POST['page'])) {
    $page = $_POST['page'];
}
$start = ($page - 1) * $perPage;
if ($start < 0) $start = 0;

$query =  $sql . $orderby .  " limit " . $start . "," . $perPage;
$result = $db_handle->runQuery($query);

if (!empty($result)) {
    $result["perpage"] = showperpage($sql, $perPage, $href);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/display.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ChatBot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.convform.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <style type="text/css">
        #outer {
            position: relative;

        }

        #left {
            float: left;
            width: 210px;
            margin-left: 40px;
        }

        #right {
            float: right;
            width: 60%;
            margin-right: 40px;
            padding-left: 10px;

        }

        .left-content,
        .right-content {
            background: #aaa;
            margin: 15px;
            background-color: white;
            padding: 12px;
        }

        .left-content {
            font-size: 16px;
            border-radius: 5px;
            box-shadow: 6px 6px 8px 0 #e0dfe0;
        }

        .right-content {
            background: #bbb;
            margin: 15px 13px 15px 0;
            background-color: white;

        }

        .right-content-header {
            padding: 5px;
            color: #fff;
            background: #ccc;
            border-bottom: 1px solid #000;
            height: auto;
            background-color: white;

        }

        #center {
            float: right;
            width: 300px
        }

        .center-content {
            margin: 15px
        }

        .left-content p {
            margin-left: 3px;
            color: #2a5db0;
            padding: 5px;
            cursor: pointer;
        }

        .left-content p:hover {
            background-color: #EEEEEE;
        }

        .left-content-header,
        .center-content-header {
            padding: 5px;
            color: black;
            background: #ccc;
            border-bottom: 1px solid #e7e7e7;
            background-color: white;
        }

        .left-content-header {
            font-size: 16px;
            cursor: pointer;
            color: #686868;
        }


        .center-content-header {
            height: auto;
        }

        iframe {
            height: 1000px;
        }

        #details {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;


        }

        #details td,
        #customers th {
            padding: 8px;
        }

        td {
            word-wrap: break-word;
            margin-left: 20px;
        }

        #details tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    }
    if (isset($_SESSION['user_id'])) {
        echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
    } else {
        echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
    }
    ?>
    <a href="#" class="btn btn-lg">
        <span class="glyphicon glyphicon-bookmark"></span> Bookmark
    </a>
    <a href="#" class="btn btn-lg">
        <span class="fa fa-quote-right"></span> Cite
    </a>
    <a href="#" class="btn btn-lg">
        <span class="fa fa-download"></span> Download
    </a>
    <a href="#" class="btn btn-lg">
        <span class="fa fa-file-pdf-o"></span> View
    </a>
    <?php
    $dbh = new PDO("mysql:host=localhost;dbname=research", "root", "");
    $id = $_GET['id'];
    $stat = $dbh->prepare('select * from research where id=?');
    $stat->bindParam(1, $id);
    $stat->execute();
    $row = $stat->fetch();
    echo "
    <div class='row'>
        <br><br><h1 style='margin-left: 50px;max-width: 1100px'>" . $row['title'] . "</h1><p style='margin-left: 50px;'>" . "<strong>Authors:  </strong>" . $row['author'] . "</p><p style='margin-left: 50px;'>" . "<strong>Published Online: </strong>" . $row['publication_day'] . ' ' . $row['publication_month'] . ' ' . $row['publication_year'] . "</p>
        
        </div>";
    ?>
    <div id="outer">
        <div id="left">
            <div class="left-content">
                <div class="left-content-header">Jump to:</div><br>
                <a href="#full-text">
                    <p>Full text</p>
                </a>
                <a href="#abstract">
                    <p>Abstract</p>
                </a>
                <a href="#details">
                    <p>Details</p>
                </a>


            </div>
        </div>
        <div id="center">
            <div class="center-content">
                <form class="example" name="frmSearch" method="post" action="journals.php" style="margin:auto;max-width:300px">
                    <input type="text" name="search[title]" placeholder="Search ThesisQuo" value="<?php echo $title; ?>" name="search2">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>

            </div>
        </div>


        <div id="right">
            <div class="right-content">
                <div class="right-content-header"></div>
                <div id="full-text"><?php echo "<iframe ' type='application/pdf' src='data:" . $row['file_type'] . ";base64," . base64_encode($row['file_upload']) . "' height='150%' width='100%'></iframe>" ?></div>
                <div id="abstract"><?php echo "<h3 style='font-family: Arial, Helvetica, sans-serif;'>Abstract</h3><p style='font-size: 1.1em;'>" . $row['abstract'] . "</p><h3>Keywords</h3><p style='font-size: 1.1em;'>" . $row['keywords'] . "</p><li>" ?>
                </div>
                <h3>Details</h3>
                <table id="details">
                    <tr>
                        <td>Title</td>
                        <td><?php echo  $row['title']  ?></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><?php echo  $row['author']  ?></td>
                    </tr>
                    <tr>
                        <td>Publication year</td>
                        <td><?php echo  $row['publication_year']  ?></td>
                    </tr>
                    <tr>
                        <td>Publication date</td>
                        <td><?php echo  $row['publication_month']  ?> <?php echo  $row['publication_year']  ?></td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td><?php echo  $row['publisher']  ?></td>
                    </tr>
                    <tr>
                        <td>Topic</td>
                        <td><?php echo  $row['topic']  ?></td>
                    </tr>
                    <tr>
                        <td>Research Type</td>
                        <td><?php echo  $row['research_type']  ?></td>
                    </tr>
                    <tr>
                        <td>Citation</td>
                        <td><?php echo  $row['citation']  ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>