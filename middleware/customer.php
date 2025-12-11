<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    echo "Access Denied!";
    exit;
}
?>
