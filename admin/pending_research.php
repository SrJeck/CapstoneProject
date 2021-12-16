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
            <img style="height: 40px;" src="images/Logo.png">
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
                <a href="#" class="active">
                    <i class='far fa-file-alt'></i>
                    <span class="links_name">Pending Research</span>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class='far fa-id-card'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
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
                <span class="dashboard">Pending Research</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <table class="table">
                        <tr class="tr">
                            <th class="th">ID</th>
                            <th class="th">Title</th>
                            <th class="th">Published By</th>
                            <th class="th">Year</th>
                            <th class="th" colspan="3">action</th>
                        </tr>
                        <?php
                        $research = $dbh->prepare('select * from research where upload_status="unposted"');
                        $research->execute();
                        while ($row = $research->fetch()) {
                            echo '<tr class="tr">
            <td class="td">' . $row['id'] . '</td>
            <td class="td">' . $row['title'] . '</td>
            <td class="td">' . $row['author'] . '</td>
            <td class="td">' . $row['publication_year'] . '</td>
            <td class="td"><button class="review"><a style="text-decoration:none;color:white;" href="review.php?id=' . $row['id'] . '">review</a></button></td>
            <td class="td"><button class="accept"><a style="text-decoration:none;color:white;" href="reject_research.php?id=' . $row['id'] . '">accept</a></button></td>
            <td class="td"><button class="reject"><a style="text-decoration:none;color:white;" href="reject_research.php?id=' . $row['id'] . '">reject</a></button></td>
        </tr>';
                        }

                        ?>
                    </table>

                </div>
            </div>
    </section>

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