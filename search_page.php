<?php
require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$title = "";
$author = "";
$research_type = "";
$publication_day = "";
$publication_day = "";
$publication_year = "";

$queryCondition = "";
if (!empty($_POST["search"])) {
	foreach ($_POST["search"] as $k => $v) {
		if (!empty($v)) {

			$queryCases = array("title", "author", "research_type", "publication_day", "publication_day", "publication_year");
			if (in_array($k, $queryCases)) {
				if (!empty($queryCondition)) {
					$queryCondition .= " AND ";
				} else {
					$queryCondition .= " WHERE ";
				}
			}
			switch ($k) {
				case "title":
					$title = $v;
					$queryCondition .= "title LIKE '" . $v . "%'";
					break;
				case "author":
					$author = $v;
					$queryCondition .= "author LIKE '" . $v . "%'";
					break;
			}
		}
	}
}
$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM research " . $queryCondition;
$href = 'search_page.php';

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
<html>

<head>
	<script type="text/javascript" src="js/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/journals.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<!-- NAVBAR -->
	<div class="navbar">
		<a href="index.php"><img style="height: 30px;" src="images/Logo.png"></a>
		<a style="margin-top: 6px;" href="index.php">HOME</a>
		<a style="margin-top: 6px;" href="journals.php">JOURNALS</a>
		<a style="margin-top: 6px;" href="#">ANALYTICS</a>
		<a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
		<a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
		<a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
	</div>

	<!-- BANNER IMAGE -->
	<img class="bg" src="images/bookreadbackground.JPG">

	<!-- SEARCH BAR CONTAINER -->

	<center>

		<form name="frmSearch" method="post" action="search_page.php">
			<!-- <div class="search-box">
				<p><input type="text" placeholder="Name" name="search[title]" class="demoInputBox" value="<?php echo $title; ?>" /><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='search_page.php'"></p>
			</div> -->
			<div class="container">
				<div class="row height d-flex justify-content-center align-items-center">
					<div>
						<div class="form">
							<select class="topic" name="topic" id="topic">
								<option value="" selected disabled hidden>Topic</option>
								<option style="font-size:17px" value="Education">Education</option>
								<option style="font-size:17px" value="Technology">Technology</option>
								<option style="font-size:17px" value="Research">Research</option>
								<option style="font-size:17px" value="Analysis">Analysis</option>
								<option style="font-size:17px" value="Database">Database</option>
							</select>
							<input type="text" id="speechToText" class="form-control form-input" name="search[title]" placeholder="Enter your search here" value="<?php echo $title; ?>"> <span class="left-pan"><i style="cursor: pointer;" onclick="record()" class="fa fa-microphone"></i></span> <button class="button" name="go">Search</button>
						</div>
					</div>
				</div>
			</div>
			<br>
			<table class="formview">

				<?php
				if (!empty($result)) {
					foreach ($result as $k => $v) {
						if (is_numeric($k)) {
				?>
							<tr>
								<td><a class="displayResearch" target='_blank' href='display.php?id=<?php echo $result[$k]['id']; ?>'><i style="font-size:80px" class="fa">&#xf0f6;</i>
										<p style="margin-left: 90px; margin-top: -90px;"><?php echo $result[$k]['research_type']; ?></p>
										<p style="margin-left: 90px; "><?php echo $result[$k]["title"]; ?></p>
										<p style="margin-left: 90px; ">
											<p style="margin-left: 90px; "><?php echo $result[$k]["author"]; ?></p>
											<p style="margin-left: 90px; "><?php echo $result[$k]['publication_day'] . ' ' . $result[$k]['publication_month'] . ' ' . $result[$k]['publication_year']; ?></p>
											<hr>
									</a>
								</td>

							</tr>
					<?php
						}
					}
				}
				if (isset($result["perpage"])) {
					?>
					<tr>
						<td> <?php echo $result["perpage"]; ?></td>
					</tr>
				<?php } ?>
			</table>
		</form>
		<center>

</body>
<!-- Below is the script for voice recognition and conversion to text-->
<script>
	function record() {
		var recognition = new webkitSpeechRecognition();
		recognition.lang = "en-GB";

		recognition.onresult = function(event) {
			// console.log(event);
			document.getElementById('speechToText').value = event.results[0][0].transcript;
		}
		recognition.start();

	}
</script>

</html>