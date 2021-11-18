<?php
require 'conn.php';
if (isset($_POST['go'])) {
  $topic = $_POST['topic'];

  $query = mysqli_query($conn, "SELECT * FROM `research` WHERE `topic`='$topic'") or die(mysqli_error());
  while ($fetch = mysqli_fetch_array($query)) {
    echo "<tr><td>" . $fetch['title'] . "</td><td>" . $fetch['topic'] . "</td></tr>";
  }
} else if (isset($_POST['reset'])) {
  $query = mysqli_query($conn, "SELECT * FROM `research`") or die(mysqli_error());
  while ($fetch = mysqli_fetch_array($query)) {
    echo "<tr><td>" . $fetch['title'] . "</td><td>" . $fetch['topic'] . "</td></tr>";
  }
} else {
  $query = mysqli_query($conn, "SELECT * FROM `research`") or die(mysqli_error());
  while ($fetch = mysqli_fetch_array($query)) {
    echo "<tr><td>" . $fetch['title'] . "</td><td>" . $fetch['topic'] . "</td></tr>";
  }
}
