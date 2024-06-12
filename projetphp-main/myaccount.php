<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'admin') {
echo "admin" ;  } else {
        header('Location: error.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}