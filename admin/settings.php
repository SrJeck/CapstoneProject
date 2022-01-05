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
                <a href="profile.php">
                    <i class='far fa-id-card'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Settings</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">

                    <h2>Change Image Banner</h2><br>

                    <!-- Upload  -->
                    <form action="upload_banner.php"  method="post" enctype="multipart/form-data">
                    <input name="myfile" type="file" accept="image/png" onchange="loadFile(event)">
                    <img id="output" width='30%' height='20%'/><br>
                    <button type="submit">Upload Image</button>
                    </form>
                </div>
            </div>
            <div>
                <table>
                <thead>
                    <tr>
                    <th class="th">Image</th>
                    <th class="th">Action</th>
                    <th class="th">Status</th>
                    </tr>
                </thead>
                <?php
                $dbh = new PDO("mysql:host=localhost;dbname=journal","root","");
                $stat = $dbh->prepare('select * from banner order by banner_id DESC');
                $stat->execute();
                while ($row = $stat->fetch()) {
                echo "<tr>
                <td text-align='center'>
                <img src='data:".$row['banner_type'].";base64,".base64_encode($row['banner_image'])."' width='30%' height='20%'>
                </td>
                <td>
                <button class='send'  onclick='setBanner(" . $row['banner_id'] . ")'>Set as Banner</button>
                </td>
                <td>
                " . $row['select_status'] . "
                </td>
                </tr>";
                }
                ?>
                </table>
            </div>
        </div>
    </section>
    <script>
        // File Upload
        // 
        function ekUpload() {
            function Init() {

                console.log("Upload Initialised");

                var fileSelect = document.getElementById('file-upload'),
                    fileDrag = document.getElementById('file-drag'),
                    submitButton = document.getElementById('submit-button');

                fileSelect.addEventListener('change', fileSelectHandler, false);

                // Is XHR2 available?
                var xhr = new XMLHttpRequest();
                if (xhr.upload) {
                    // File Drop
                    fileDrag.addEventListener('dragover', fileDragHover, false);
                    fileDrag.addEventListener('dragleave', fileDragHover, false);
                    fileDrag.addEventListener('drop', fileSelectHandler, false);
                }
            }

            function fileDragHover(e) {
                var fileDrag = document.getElementById('file-drag');

                e.stopPropagation();
                e.preventDefault();

                fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
            }

            function fileSelectHandler(e) {
                // Fetch FileList object
                var files = e.target.files || e.dataTransfer.files;

                // Cancel event and hover styling
                fileDragHover(e);

                // Process all File objects
                for (var i = 0, f; f = files[i]; i++) {
                    parseFile(f);
                    uploadFile(f);
                }
            }

            // Output
            function output(msg) {
                // Response
                var m = document.getElementById('messages');
                m.innerHTML = msg;
            }

            function parseFile(file) {

                console.log(file.name);
                output(
                    '<strong>' + encodeURI(file.name) + '</strong>'
                );

                // var fileType = file.type;
                // console.log(fileType);
                var imageName = file.name;

                var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
                if (isGood) {
                    document.getElementById('start').classList.add("hidden");
                    document.getElementById('response').classList.remove("hidden");
                    document.getElementById('notimage').classList.add("hidden");
                    // Thumbnail Preview
                    document.getElementById('file-image').classList.remove("hidden");
                    document.getElementById('file-image').src = URL.createObjectURL(file);
                } else {
                    document.getElementById('file-image').classList.add("hidden");
                    document.getElementById('notimage').classList.remove("hidden");
                    document.getElementById('start').classList.remove("hidden");
                    document.getElementById('response').classList.add("hidden");
                    document.getElementById("file-upload-form").reset();
                }
            }

            function setProgressMaxValue(e) {
                var pBar = document.getElementById('file-progress');

                if (e.lengthComputable) {
                    pBar.max = e.total;
                }
            }

            function updateFileProgress(e) {
                var pBar = document.getElementById('file-progress');

                if (e.lengthComputable) {
                    pBar.value = e.loaded;
                }
            }

            function uploadFile(file) {

                var xhr = new XMLHttpRequest(),
                    fileInput = document.getElementById('class-roster-file'),
                    pBar = document.getElementById('file-progress'),
                    fileSizeLimit = 1024; // In MB
                if (xhr.upload) {
                    // Check if file is less than x MB
                    if (file.size <= fileSizeLimit * 1024 * 1024) {
                        // Progress bar
                        pBar.style.display = 'inline';
                        xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
                        xhr.upload.addEventListener('progress', updateFileProgress, false);

                        // File received / failed
                        xhr.onreadystatechange = function(e) {
                            if (xhr.readyState == 4) {
                                // Everything is good!

                                // progress.className = (xhr.status == 200 ? "success" : "failure");
                                // document.location.reload(true);
                            }
                        };

                        // Start upload
                        xhr.open('POST', document.getElementById('file-upload-form').action, true);
                        xhr.setRequestHeader('X-File-Name', file.name);
                        xhr.setRequestHeader('X-File-Size', file.size);
                        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
                        xhr.send(file);
                    } else {
                        output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
                    }
                }
            }

            // Check for the various File API support.
            if (window.File && window.FileList && window.FileReader) {
                Init();
            } else {
                document.getElementById('file-drag').style.display = 'none';
            }
        }
        ekUpload();
        
    </script>
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