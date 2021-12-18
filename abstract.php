<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$id = isset($_GET['id']) ? $_GET['id'] : "";

$abstract = $dbh->prepare('select abstract from research where id=?');
$abstract->bindParam(1, $id);
$abstract->execute();
$display_abstract = $abstract->fetch();
echo $display_abstract['abstract'];
?>