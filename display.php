<?php
    $dbh = new PDO("mysql:host=localhost;dbname=journal","root","");
    $id = $_POST['id'];
    $stat = $dbh->prepare('select * from research where id=?');
    $stat->bindParam(1, $id);
    $stat->execute();
    $row = $stat->fetch();
    echo "<li><a target='_blank' href='view.php?id=".$row['id']."'> view:".$row['title']."</a><br/>
    <a target='_blank' href='download.php?id=".$row['id']."'> download:".$row['title']."</a><br/>
    <iframe type='application/pdf' src='data:".$row['file_type'].";base64,".base64_encode($row['file_upload'])."' height='30%' width='50%'></iframe><br/>
    <p>file type: ".$row['file_type']."</p><p>file name: ".$row['file_name']."</p></li>";
?>