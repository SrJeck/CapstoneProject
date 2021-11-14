<html>

<head>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/display.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ChatBot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.convform.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <a href="index.php"><img style="height: 25px;" src="images/libraryLogo.png"></a>
        <a style="margin-top: 5px;" href="index.php">HOME</a>
        <a style="margin-top: 5px;" href="journals.php">JOURNALS</a>
        <a style="margin-top: 5px;" href="#">ANALYTICS</a>
        <a style="float: right;" href="#"><img style="height: 25px;" src="images/logoutIcon.png"></a>
        <a style="float: right;" href="login.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
        <a class="boomark" style="float: right;" href="#"><img style="height: 23px;" src="images/bookmark.png"></a>
    </div>

    <?php
    $dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
    $id = $_GET['id'];
    $stat = $dbh->prepare('select * from research where id=?');
    $stat->bindParam(1, $id);
    $stat->execute();
    $row = $stat->fetch();
    echo "
    <br><br><br><br><h1 style='margin-left: 50px;'>" . $row['title'] . "</h1><p style='color: #10147e;margin-left: 50px;'>" . "<strong>Authors:  </strong>"  . $row['author'] . "</p><p style='margin-left: 50px;'>" . "<strong>Published Online: </strong>" . $row['publication_day'] . ' ' . $row['publication_month'] . ' ' . $row['publication_year'] . "</p>
    <h2 style='margin-left: 50px;'>Abstract</h2><p style='font-size: 1.1em;margin-left: 50px;'>" . $row['abstract'] . "</p><h2 style='margin-left: 50px;'>Keywords</h2><p style='font-size: 1.1em;margin-left: 50px;'>" . $row['keywords'] . "</p><li><br>
    <br><iframe style='margin-left: 180px;' type='application/pdf' src='data:" . $row['file_type'] . ";base64," . base64_encode($row['file_upload']) . "' height='100%' width='250%'></iframe><br>
    <a class='view' target='_blank' href='view.php?id=" . $row['id'] . "'> View PDF</a><br><br>
    <a class='download' target='_blank' href='download.php?id=" . $row['id'] . "'> download</a>
    </li>";
