<?php
// utilities.php - Security and helper functions

/**
 * Escape string for safe database insertion
 */
function esc($str) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($str));
}

/**
 * Get client IP address
 */
function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Generate secure session phrase
 */
function getSecurePhrase() {
    return bin2hex(random_bytes(32));
}

/**
 * Verify password with pepper
 */
function verifyPassword($inputPassword, $hashedPassword) {
    return password_verify($inputPassword . PEPPER, $hashedPassword);
}
?>