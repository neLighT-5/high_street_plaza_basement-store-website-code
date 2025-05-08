<?php
// includes/auth_check.php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: " . BASE_URL . "login.php");
    exit;
}

// Optional: Check user role for authorization
$allowed_roles = ['owner', 'manager', 'customer']; // Adjust as needed
if (isset($required_role) && !in_array($_SESSION['role'], $allowed_roles)) {
    header("HTTP/1.1 403 Forbidden");
    die("You don't have permission to access this page");
}
?>