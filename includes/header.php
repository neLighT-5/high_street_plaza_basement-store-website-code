<?php

// Set default page title
$page_title = $page_title ?? 'High Street Plaza Basement Store';

// Dynamic base URL (works for both localhost and live server)
$base_url = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . 
            $_SERVER['HTTP_HOST'] . 
            str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

// Check login status for UI elements
$isLoggedIn = isset($_SESSION['loggedin']);
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="<?= $base_url ?>css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="<?= $base_url ?>Images/favicon.ico">
    <style>
        /* User Badges */
        .user-badge {
            background: #e74c3c;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 0.8em;
            margin-left: 5px;
        }
        .welcome-user {
            color: #ecf0f1;
            margin-right: 15px;
        }
        /* Active link highlight */
        .main-nav .active {
            color: #3498db;
            position: relative;
        }
        .main-nav .active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #3498db;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="user-actions">
                <?php if($isLoggedIn): ?>
                    <!-- Logged-in state -->
                    <span class="welcome-user">
                        <i class="fas fa-user"></i> <?= htmlspecialchars($username) ?>
                        <?php if(in_array($role, ['owner', 'manager'])): ?>
                            <span class="user-badge">(<?= ucfirst($role) ?>)</span>
                        <?php endif; ?>
                    </span>
                    <?php if(in_array($role, ['owner', 'manager'])): ?>
                        <a href="<?= $base_url ?>admin/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <?php endif; ?>
                    <a href="<?= $base_url ?>Pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <!-- Logged-out state -->
                    <a href="<?= $base_url ?>Pages/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="<?= $base_url ?>Pages/register.php"><i class="fas fa-user-plus"></i> Register</a>
                <?php endif; ?>
                <a href="<?= $base_url ?>Pages/cart.php"><i class="fas fa-shopping-cart"></i> Cart
                    <?php if(!empty($_SESSION['cart'])): ?>
                        <span class="cart-count">(<?= array_sum($_SESSION['cart']) ?>)</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="main-header">
        <div class="container">
            <div class="store-branding">
                <h1><i class="fas fa-equals"></i> High Street Plaza Basement Store</h1>
                <p>Your Trusted Hardware Retailer</p>
            </div>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="<?= $base_url ?>index.php" <?= basename($_SERVER['SCRIPT_NAME']) == 'index.php' ? 'class="active"' : '' ?>>Home</a></li>
                    <li><a href="<?= $base_url ?>Pages/products.php" <?= basename($_SERVER['SCRIPT_NAME']) == 'products.php' ? 'class="active"' : '' ?>>Products</a></li>
                    <li><a href="<?= $base_url ?>Pages/services.php" <?= basename($_SERVER['SCRIPT_NAME']) == 'services.php' ? 'class="active"' : '' ?>>Services</a></li>
                    <li><a href="<?= $base_url ?>Pages/Contacts.php" <?= basename($_SERVER['SCRIPT_NAME']) == 'Contacts.php' ? 'class="active"' : '' ?>>Contact</a></li>
                </ul>
            </nav>
            
            <button class="mobile-menu-toggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main class="container">