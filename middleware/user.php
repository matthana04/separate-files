<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    echo "Access Denied!";
    exit;
}
?>
