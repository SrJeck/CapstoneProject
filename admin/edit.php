<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_POST["submit"])) {
	$query = "UPDATE user set firstName = " . $_POST['firstName'] . " WHERE  id=" . $_GET["id"];
	$result = $db_handle->executeQuery($query);
	if (!$result) {
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:index.php");
	}
}
$result = $db_handle->runQuery("SELECT * FROM user WHERE user_id='" . $_GET["id"] . "'");
?>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
	function validate() {
		var valid = true;
		$(".demoInputBox").css('background-color', '');
		$(".info").html('');

		if (!$("#name").val()) {
			$("#name-info").html("(required)");
			$("#name").css('background-color', '#FFFFDF');
			valid = false;
		}
		return valid;
	}
</script>
<form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();">
	<div id="mail-status"></div>
	<div>
		<label style="padding-top:20px;">Name</label>
		<span id="name-info" class="info"></span><br />
		<input type="text" name="firstName" id="firstName" class="demoInputBox" value="<?php echo $result[0]["firstName"]; ?>">
	</div>

	<div>
		<input type="submit" name="submit" id="btnAddAction" value="Save" />
	</div>
	</div>