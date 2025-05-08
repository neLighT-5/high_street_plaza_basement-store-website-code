<?php
// includes/functions.php
function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function is_logged_in(): bool {
    return isset($_SESSION['loggedin']) && 
           $_SESSION['ip'] === $_SERVER['REMOTE_ADDR'] && 
           $_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT'];
}

function logout(): void {
    $_SESSION = [];
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
}
?>