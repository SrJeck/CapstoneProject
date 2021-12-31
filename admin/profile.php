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
    <link rel="stylesheet" href="css/profile.css">
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
                <a href="inquiries.php">
                    <i class='fa fa-envelope'></i>
                    <span class="links_name">Inquiries </span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
                    <i class='far fa-id-card'></i>
                    <span class="links_name">Profile</span>
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
                <span class="dashboard">Profile</span>
            </div>
        </nav>
        <?php
        $stat = $dbh->prepare('select * from admin where admin_id=?');
        $stat->bindParam(1, $id);
        $stat->execute();
        $row = $stat->fetch();
        if ($row["access"] == "Super Admin") {
            echo '<a href="registration.php"><i class="fas fa-user" style="bold:none;"> Create Admin Account</i></a>';
        }
        ?>
        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="wrapper">
                        <div class="left">
                            <img class="profilepencil" src="images/profilepencil.png">
                            <h2 style="margin-top: 30px;"><?php echo $row['firstName']; ?> <?php echo $row['middleName']; ?> <?php echo $row['lastName']; ?></h2>
                            <p>Admin</p>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>Information</h3>
                                <div class="info_data">
                                    <div class="data">
                                        <h4>Email</h4>
                                        <p><?php echo $row['email']; ?></p>
                                    </div>
                                    <div class="data">
                                        <h4>Phone</h4>
                                        <p><?php echo $row['phoneNumber']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <div class="info_data">
                                    <div class="data">
                                        <h4>Address</h4>
                                        <p><?php echo $row['address']; ?></p>
                                    </div>

                                    <div class="data">
                                        <h4>Birthday</h4>
                                        <p><?php echo $row['birthday']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <div class="info_data">
                                    <div class="data">
                                        <h4>Sex</h4>
                                        <p><?php echo $row['sex']; ?></p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="wrapper2">
            <div class="info">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th class="th">Admin Name</th>
                                <th class="th">Email</th>
                                <th class="th">Access</th>
                            </tr>
                        </thead>

                        <?php
                        $admins = $dbh->prepare('select * from admin');
                        $admins->execute();
                        while ($row = $admins->fetch()) {
                            if ($row['admin_id'] != $_SESSION['admin_id']) {
                                echo '<tr class="tr">
                                <td class="td">' . $row['firstName'] . '</td>
                                <td class="td">' . $row['email'] . '</td>
                                <td class="td">' . $row['access'] . '</td>
                            </tr>';
                            }
                        }

                        ?>

                    </table>
                </div>
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