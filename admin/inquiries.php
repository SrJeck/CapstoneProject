<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=journal", "root", "");

require_once("perpage.php");
require_once("dbcontroller.php");
$db_handle = new DBController();


?>
<?php
include 'backend/database.php';
?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="css/test.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="ajax/Ajax.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img style="height: 40px; margin-left: 10px;" src="images/TQ.png">
            <span class="logo_name"><img style="height: 40px; " src="images/Logo.png"></span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="analytics.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="users.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
            </li>
            <li>
                <a href="research.php">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Research</span>
                </a>
            </li>
            <li>
                <a href="pending_research.php">
                    <i class='far fa-file-alt'></i>
                    <span class="links_name">Pending Research</span>
                </a>
            </li>
            <li>
                <a href="profile.php" class="active">
                    <i class='fa fa-envelope'></i>
                    <span class="links_name">Inquiries </span>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class='far fa-id-card'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="registration.php">
                    <i class='bx bx-user-plus'></i>
                    <span class="links_name">Admin Registration</span>
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Settings</span>
                </a>
            </li>
            <li class="log_out">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Inquiries</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <table class="table">
                        <caption>Unreplied Inquiries</caption>
                        <tr class="tr">
                            <th class="th">Email</th>
                            <th class="th">Subject</th>
                            <th class="th">Message</th>
                            <th class="th">Reply</th>
                            <th class="th">Action</th>
                        </tr>
                        <?php
                        $research = $dbh->prepare('select * from inquiry');
                        $research->execute();
                        while ($row = $research->fetch()) {
                            if (empty($row['reply'])) {
                                echo '<tr class="tr">
                                    <td class="td">' . $row['email'] . '</td>
                                    <td class="td">' . $row['subject'] . '</td>
                                    <td class="td">' . $row['question'] . '</td>
                                    <td class="td">
                                    <form id="reply-form" action="inquiry_reply.php" method="POST">
                                    <textarea  name="reply" id="reply" placeholder="Reply"></textarea> 
                                    <input name="inquiry_id" value="' . $row['inquiry_id'] . '" style="display:none">   
                                    </form></td>
                                    <td class="td"><button class="send" type="submit" form="reply-form"><a style="text-decoration:none;color:white;" href=""><i style="font-size: 12px;" class="material-icons">send</i></a></button></td>
                                </tr>';
                            }
                        }

                        ?>
                    </table>
                    <table class="table">
                        <caption>Replied Inquiries</caption>
                        <tr class="tr">
                            <th class="th">Email</th>
                            <th class="th">Subject</th>
                            <th class="th">Message</th>
                            <th class="th">Reply</th>
                            <th class="th" colspan="3" style="display:none">Action</th>
                        </tr>
                        <?php
                        $research = $dbh->prepare('select * from inquiry');
                        $research->execute();
                        while ($row = $research->fetch()) {
                            if (!empty($row['reply'])) {
                                echo '<tr class="tr">
                                    <td class="td">' . $row['email'] . '</td>
                                    <td class="td">' . $row['subject'] . '</td>
                                    <td class="td">' . $row['question'] . '</td>
                                    <td class="td">' . $row['reply'] . '</td>
                                    <td class="td" style="display:none"><button onclick="openEdit">Edit Reply</button></td>
                                    <td class="td" style="display:none">
                                    <form id="edit-reply-form" action="inquiry_reply.php" method="POST">
                                    <textarea  name="reply" id="reply" placeholder="Reply"></textarea> 
                                    <input name="user" value="' . $row['inquiry_id'] . '" style="display:none">   
                                    </form></td>
                                    <td class="td" style="display:none"><button class="send" type="submit" form="edit-reply-form"><a style="text-decoration:none;color:white;" href=""><i style="font-size: 12px;" class="material-icons">send</i></a></button></td>
                                </tr>';
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
    </section>
    <!-- <td class="td"><button class="accept"><a style="text-decoration:none;color:white;" href="reject_research.php?id=' . $row['id'] . '">accept</a></button></td>
            <td class="td"><button class="reject"><a style="text-decoration:none;color:white;" href="reject_research.php?id=' . $row['id'] . '">reject</a></button></td> -->

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>

</body>

</html>