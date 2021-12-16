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
                <a href="pending_research.php">
                    <i class='far fa-file-alt'></i>
                    <span class="links_name">Pending Research</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Profile</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <?php
                    $stat = $dbh->prepare('select * from admin where admin_id=?');
                    $stat->bindParam(1, $id);
                    $stat->execute();
                    $row = $stat->fetch();
                    if ($row["access"] == "Super Admin") {
                        echo '<a href="registration.php"><i class="fas fa-user" style="bold:none;"> Create Admin Account</i></a>';
                    }
                    ?>
                    <table>


                        <!-- populate table from mysql database -->
                        <?php

                        $stat = $dbh->prepare('select * from admin where admin_id=?');
                        $stat->bindParam(1, $id);
                        $stat->execute();
                        $row = $stat->fetch();
                        ?>
                        <img class="profilepencil" src="images/profilepencil.png">

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