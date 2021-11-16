<?php
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
$stat = $dbh->prepare('select * from research');
$stat->execute();
while ($row = $stat->fetch()) {
    echo "<li><a target='_blank' href='view.php?id=" . $row['id'] . "'>" . $row['title'] . "</a><br/>
            <embed type='application/pdf' src='data:" . $row['file_type'] . ";base64," . base64_encode($row['file_upload']) . "' height='30%' width='50%'></embed><br/>
            <p>file type: " . $row['file_type'] . "</p><p>file type: " . $row['file_type'] . "</p><p>file type: " . $row['file_name'] . "</p></li>";
}
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
