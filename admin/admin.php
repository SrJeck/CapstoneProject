<?php
session_start();
$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");
if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];
}
?>

<!-- START DATE 8/28/2021 -->
<!-- UPDATE DATE 10/05/2021 -->
<html>

<head>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
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
        <a href="index.php"><img style=" height: 25px;" src="images/Logo.png"></a>
        <a style="margin-top: 5px;" href="users.php">USERS</a>
        <a style="margin-top: 5px;" href="research.php">RESEARCH</a>
        <a style="float: right;" href="logout.php"><img style="height: 25px;" src="images/logoutIcon.png"></a>
        <a style="float: right;" href="logOrProf.php"><img style="height: 25px;" src="images/profileIcon.png"></a>
    </div>


    <div class="side">
        <a href="editprofile.php?user_id=<?php echo $id; ?>"><i class="fa fa-pencil"> <b>Edit Profile </b> &#xf105;</i></a>
        <a href="security.php?user_id=<?php echo $id; ?>"><i class='fas fa-user-shield' style="bold:none;"> Password</i></a>
        <a href="registration.php"><i class='fas fa-user' style="bold:none;"> Create Admin Account</i></a>

    </div>
    <img class="profilepencil" src="images/profilepencil.png">

    <div class="editform">
        <form action="/action_page.php" id="editform">

            <table>


                <!-- populate table from mysql database -->
                <?php

                $stat = $dbh->prepare('select * from admin where admin_id=?');
                $stat->bindParam(1, $id);
                $stat->execute();
                $row = $stat->fetch();
                ?>

                <tr class="displayRow">
                    <td>
                        <div class="name">
                            <p class="fname"><?php echo $row['firstName']; ?></p>
                            <p class="mname"><?php echo $row['middleName']; ?></p>
                            <p class="lname"><?php echo $row['lastName']; ?></p>
                        </div>
                        <div class="emailrow">
                            <p class="email"><?php echo $row['email']; ?></p>
                        </div>
                        <div class="displayrow2">
                            <p class="pnumber"><?php echo $row['phoneNumber']; ?></p>
                            <p class="address"><?php echo $row['address']; ?></p>
                        </div>

                    </td>
                </tr>
            </table>
        </form>
        <div class="vl"></div>

    </div>
    <table class="table">
        <tr class="tr">
            <th class="th">ID</th>
            <th class="th">Title</th>
            <th class="th">Published By</th>
            <th class="th">Year</th>
            <th class="th" colspan="2">action</th>
        </tr>
        <?php
        $research = $dbh->prepare('select * from research where upload_status="unposted"');
        $research->execute();
        while ($row = $research->fetch()) {
            echo '<tr class="tr">
            <td class="th">'.$row['id'].'</td>
            <td class="th">'.$row['title'].'</td>
            <td class="th">'.$row['author'].'</td>
            <td class="th">'.$row['publication_year'].'</td>
            <td class="th"><button><a href="accept_research.php?id=' . $row['id'] . '">accept</a></button></td>
            <td class="th"><button><a href="reject_research.php?id=' . $row['id'] . '">reject</a></button></td>
        </tr>';
        }
        
        ?>
    </table>
    <table class="table2">
        <tr class="tr2">
            <th class="th2">Admin Name</th>
            <th class="th2">Email</th>
            <th class="th2">Access</th>
        </tr>
        <?php
        $admins = $dbh->prepare('select * from admin');
        $admins->execute();
        while ($row = $admins->fetch()) {
            if ($row['admin_id'] != $_SESSION['admin_id']) {
                echo '<tr class="tr">
            <td class="th">'.$row['firstName'].'</td>
            <td class="th">'.$row['email'].'</td>
            <td class="th">'.$row['access'].'</td>
        </tr>';
            }
        }
        
        ?>
    </table>
    <!-- ChatBot -->
    <div class="chat_icon">
        <img style="height: 80px;" src="images/chatboticon.png">
    </div>

    <div class="chat_box">
        <div class="my-conv-form-wrapper">
            <form action="" method="GET" class="hidden">

                <select data-conv-question="Hello! How can I help you" name="category">
                    <option value="WebDevelopment">Website Development ?</option>
                    <option value="ThesisQuoForum">Thesis Quo Forum</option>
                </select>

                <div data-conv-fork="category">
                    <div data-conv-case="WebDevelopment">
                        <input type="text" name="domainName" data-conv-question="Please, tell me your domain name">
                    </div>
                    <div data-conv-case="ThesisQuoForum" data-conv-fork="first-question2">
                        <input type="text" name="companyName" data-conv-question="Please, enter your institution name">
                    </div>
                </div>

                <input type="text" name="name" data-conv-question="Please, Enter your name">

                <input type="text" data-conv-question="Hi {name}, <br> It's a pleasure to meet you." data-no-answer="true">

                <input data-conv-question="Enter your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" name="email" required placeholder="What's your e-mail?">

                <select data-conv-question="Please Confirm">
                    <option value="Yes">Confirm</option>
                </select>

            </form>
        </div>
    </div>

    <!-- ChatBot end -->

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