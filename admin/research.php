<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}

require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$firstName = "";
$user_id = "";
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
          $firstName = $v;
          $queryCondition .= "title LIKE '%" . $v . "%'"  . "OR author LIKE'%" . $v . "%'"  . "OR topic LIKE'%" . $v . "%'";
          break;
      }
    }
  }
}
$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM research " . $queryCondition;
$href = 'research.php';

$perPage = 15;
$page = 1;
if (isset($_POST['page']))  $page = $_POST['page'];
$start = ($page - 1) * $perPage;
if ($start < 0) $start = 0;

$query =  $sql . $orderby .  " limit " . $start . "," . $perPage;
$result = $db_handle->runQuery($query);


if (!empty($result)) $result["perpage"] = showperpage($sql, $perPage, $href);

?>
<html>

<head>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ChatBot -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
  <!-- NAVBAR -->
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    
    <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
  </div>';
  } else {
    echo '<div class="navbar">
    <a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
    <a style="margin-top: 6px;" href="research.php">RESEARCH</a>
    <a style="margin-top: 6px;" href="#">ANALYTICS</a>
    <a class="ol-login-link" href="logOrProf.php"><span class="icons_base_sprite icon-open-layer-login"><strong style="margin-left:30px">Log in through your library</strong> <span>to access more features.</span></span></a>
    <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    <a class="boomark" style="float: right;" href="bookmark.php"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>';
  }
  ?>
  <br><br><br>
  <div id="toys-grid">
    <form name="frmSearch" method="post" action="research.php">
      <div class="search-box">
        <p><input type="text" placeholder="Name" name="search[title]" class="demoInputBox" value="<?php echo $firstName; ?>" /><input type="reset" class="btnSearch" value="Reset" onclick="window.location='research.php'"></p>
      </div>

      <table cellpadding="10" cellspacing="1">
        <thead>
          <tr>
            <th><strong>Title</strong></th>
            <th><strong>Author</strong></th>
            <th><strong>Publication Year</strong></th>
            <th><strong>Institution</strong></th>
            <th><strong>Topic</strong></th>
            <th><strong>Publisher</strong></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($result)) {
            foreach ($result as $k => $v) {
              if (is_numeric($k)) {
          ?>
                <tr>
                  <td><?php echo $result[$k]["title"]; ?></td>
                  <td><?php echo $result[$k]["author"]; ?></td>
                  <td><?php echo $result[$k]["publication_year"]; ?></td>
                  <td><?php echo $result[$k]["institution"]; ?></td>
                  <td><?php echo $result[$k]["topic"]; ?></td>
                  <td><?php echo $result[$k]["publisher"]; ?></td>
                  <td>
                    <a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["user_id"]; ?>">Edit</a>
                  </td>
                  <td>
                    <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["user_id"]; ?>">Delete</a>
                  </td>
                </tr>
            <?php
              }
            }
          }
          if (isset($result["perpage"])) {
            ?>
            <tr>
              <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
            </tr>
          <?php } ?>
        <tbody>
      </table>
    </form>
  </div>
</body>


</html>