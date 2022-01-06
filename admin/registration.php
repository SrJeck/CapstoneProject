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
  <link rel="stylesheet" href="css/login.css">
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
        <a href="profile.php">
          <i class='far fa-id-card'></i>
          <span class="links_name">Profile</span>
        </a>
      </li>
      <li>
        <a href="#" class="active">
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
        <span class="dashboard">Admin Registration</span>
      </div>
    </nav>
    <br><br><br><br><br><br><br>
    <div class="content-register">
      <form action="registration_insert.php" method="post" enctype="multipart/form-data">

        <div class="login-form">
          <div class="top">
            <div class="text-container">
              <h1>Sign Up</h1>
            </div>
            <div class="icon-container">
              <svg fill="currentColor" viewBox="0 0 16 16" width="50px" height="50px">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </div>
          </div>

          <div class="mid">
            <div class="input-group">
              <input name="myImage" type="file" accept="image/png" onchange="loadFile(event)">
              <img id="output" width="15%" height="10%" alt="" />
            </div>
            <div>

            </div>
            <div class="mid">
              <div class="input-group">
                <h4>First Name</h4>
                <div class="input-area">
                  <input type="text" id="firstName" name="firstName" />
                  <div class="input-icon">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Middle Name</h4>
                <div class="input-area">
                  <input type="text" id="middleName" name="middleName" />
                  <div class="input-icon">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Last Name</h4>
                <div class="input-area">
                  <input type="text" id="lastName" name="lastName" />
                  <div class="input-icon">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Birthday</h4>
                <div class="input-area">
                  <input type="date" id="birthday" name="birthday" />
                  <div class="input-icon">
                    <img src="https://icon-library.com/images/birthday-icon-png/birthday-icon-png-7.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Phone Number</h4>
                <div class="input-area">
                  <input type="text" id="phoneNum" name="phoneNum" />
                  <div class="input-icon">
                    <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/phone-512.png" alt="">
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Address</h4>
                <div class="input-area">
                  <input type="text" id="address" name="address" />
                  <div class="input-icon">
                    <img src="images/location.png" alt="">
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Sex</h4>
                <input style="margin-left: 20px;" type="radio" id="download_only" name="sex" value="Male">
                <label>Male</label>
                <input style="margin-left: 20px;" type="radio" id="view_download" name="sex" value="Female">
                <label>Female</label><br>
              </div>

              <div class="input-group">
                <h4>Email</h4>
                <div class="input-area">
                  <input type="text" id="email" name="email" />
                  <div class="input-icon">
                    <img src="images/email.png" alt="">
                  </div>
                </div>
              </div>
              <div class="input-group">
                <h4>Password</h4>
                <div class="input-area">
                  <input type="text" id="password" name="password" />
                  <div class="input-icon">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                      <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                      <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                    </svg>
                  </div>
                </div>
              </div>



              <button name="submit">Submit</button>
            </div>
            <div class="bottom">
              <div class="options">
                <a href="login.php">
                  <h4>Already have an account?</h4>
                </a>
              </div>
            </div>
          </div>
      </form>
      <script>
        imgInp.onchange = evt => {
          const [file] = imgInp.files
          if (file) {
            blah.style.display = "block";
            blah.src = URL.createObjectURL(file)
          }
        }
      </script>
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