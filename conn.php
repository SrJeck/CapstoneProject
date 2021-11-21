<?php
$conn = mysqli_connect("localhost", "root", "", "research");

if (!$conn) {
  die("Error: Failed to connect to database!");
}
