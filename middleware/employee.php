<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employee') {
    echo "Access Denied!";
    exit;
}
?>
