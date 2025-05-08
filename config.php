<?php
// ==================== SESSION FIX ====================
// Force fresh session start
// if (session_status() === PHP_SESSION_ACTIVE) {
//     session_unset();
//     session_destroy();
//     setcookie('HSPSESSID', '', time()-3600, '/high_street_plaza/');
// }

// WAMP-specific session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.use_strict_mode', 1);

// Start the session
session_start();

// ==================== DATABASE ====================
$conn = new mysqli('localhost', 'root', '', 'high_street_plaza');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ==================== SESSION VALIDATION ====================
function validate_session() {
    // Verify session is writing data
    if (empty($_SESSION)) {
        error_log("Session data is empty - possible write issue");
    }
    
    // // Basic security checks
    // if (!isset($_SESSION['IP'])) {
    //     $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
    // } elseif ($_SESSION['IP'] !== $_SERVER['REMOTE_ADDR']) {
    //     session_unset();
    //     session_destroy();
    //     header("Location: login.php");
    //     exit;
    // }
}

define('BASE_URL', 'http://localhost/high_street_plaza/');

define ('ROOT_PATH', realpath(dirname(__FILE__)));
?>