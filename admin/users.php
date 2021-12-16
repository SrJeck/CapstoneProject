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
  <script src="ajax/usersAjax.js"></script>
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
        <a href="#" class="active">
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
        <span class="dashboard">Users</span>
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
                    <h2>Manage <b>Users</b></h2>
                  </div>
                  <div class="col-sm-6">
                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
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
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Home Address</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM user");
                  $i = 1;
                  while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <tr id="<?php echo $row["user_id"]; ?>">
                      <td>
                        <span class="custom-checkbox">
                          <input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["user_id"]; ?>">
                          <label for="checkbox2"></label>
                        </span>
                      </td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row["firstName"]; ?></td>
                      <td><?php echo $row["middleName"]; ?></td>
                      <td><?php echo $row["lastName"]; ?></td>
                      <td><?php echo $row["email_address"]; ?></td>
                      <td><?php echo $row["contactNumber"]; ?></td>
                      <td><?php echo $row["homeAddress"]; ?></td>
                      <td>
                        <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                          <i class="material-icons update" data-toggle="tooltip" data-id="<?php echo $row["user_id"]; ?>" data-name="<?php echo $row["firstName"]; ?>" data-middle-name="<?php echo $row["middleName"]; ?>" data-last-name="<?php echo $row["lastName"]; ?>" data-email="<?php echo $row["email_address"]; ?>" data-phone="<?php echo $row["contactNumber"]; ?>" data-city="<?php echo $row["homeAddress"]; ?>" title="Edit">&#xE254;</i>
                        </a>
                        <a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["user_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
                      <label>First Name</label>
                      <input type="text" id="name" name="firstName" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input type="text" id="middleName" name="middleName" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" id="email" name="email_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Contact Number</label>
                      <input type="phone" id="phone" name="contactNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Home Address</label>
                      <input type="city" id="city" name="homeAddress" class="form-control" required>
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
                    <input type="hidden" id="id_u" name="user_id" class="form-control" required>
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" id="name_u" name="firstName" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input type="text" id="middle_Name" name="middleName" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" id="last_Name" name="lastName" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" id="email_u" name="email_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Contact Number</label>
                      <input type="phone" id="phone_u" name="contactNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Home Address</label>
                      <input type="city" id="city_u" name="homeAddress" class="form-control" required>
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
                    <input type="hidden" id="id_d" name="user_id" class="form-control">
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