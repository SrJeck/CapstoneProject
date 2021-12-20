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
  <link rel="stylesheet" href="css/style.css">
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
        <a href="#" class="active">
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
        <a href="profile.php">
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
        <span class="dashboard">Research</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="container">
            <p id="success"></p>
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h2>Manage <b>Research</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Research</span></a>
                    <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>
                      <span class="custom-checkbox">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll"></label>
                      </span>
                    </th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publication Year</th>
                    <th>Topic</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM research");
                  $i = 1;
                  while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <tr id="<?php echo $row["id"]; ?>">
                      <td>
                        <span class="custom-checkbox">
                          <input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
                          <label for="checkbox2"></label>
                        </span>
                      </td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row["title"]; ?></td>
                      <td><?php echo $row["author"]; ?></td>
                      <td><?php echo $row["publication_year"]; ?></td>
                      <td><?php echo $row["topic"]; ?></td>
                      <td>
                        <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                          <i class="material-icons update" data-toggle="tooltip" data-id="<?php echo $row["id"]; ?>" data-name="<?php echo $row["title"]; ?>" data-email="<?php echo $row["author"]; ?>" data-phone="<?php echo $row["publication_year"]; ?>" data-city="<?php echo $row["topic"]; ?>" title="Edit">&#xE254;</i>
                        </a>
                        <a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                      </td>
                    </tr>
                  <?php
                    $i++;
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>
          <!-- Add Modal HTML -->
          <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="user_form">
                  <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" id="name" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Author</label>
                      <input type="email" id="email" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Publication Year</label>
                      <input type="phone" id="phone" name="publication_year" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>topic</label>
                      <input type="city" id="city" name="topic" class="form-control" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" value="1" name="type">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-success" id="btn-add">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Edit Modal HTML -->
          <div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="update_form">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="id_u" name="id" class="form-control" required>
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" id="name_u" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Author</label>
                      <input type="email" id="email_u" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Publication Year</label>
                      <input type="phone" id="phone_u" name="publication_year" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Topic</label>
                      <input type="city" id="city_u" name="topic" class="form-control" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" value="2" name="type">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-info" id="update">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Delete Modal HTML -->
          <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form>

                  <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="id_d" name="id" class="form-control">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                  </div>
                </form>
              </div>
            </div>
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