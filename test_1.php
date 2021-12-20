<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";

$abstract = $dbh->prepare('select abstract from research where id=?');
$abstract->bindParam(1, $id);
$abstract->execute();
$display_abstract = $abstract->fetch();

$fetch_uploader = $dbh->prepare("select * from user where user_id=?");
$fetch_uploader->bindParam(1, $fetched2['user_id']);
$fetch_uploader->execute();
$fetched_uploader = $fetch_uploader->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("button").click(function() {
                $("#div1").load("display.php?id= <?php echo $fetched_uploader['id'] ?>");
            });
        });
    </script>
</head>

<body>

    <div id="div1">
        <h2>Let jQuery AJAX Change This Text</h2>
    </div>

    <button>Get External Content</button>

</body>

</html>