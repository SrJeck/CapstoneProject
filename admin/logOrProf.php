<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
} else {

    header("Location: profile.php");
}
