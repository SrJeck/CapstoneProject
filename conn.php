<?php
$conn = mysqli_connect("localhost", "root", "", "journal");

if (!$conn) {
  die("Error: Failed to connect to database!");
}
