<?php
require_once '../config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'customer';

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill all fields";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords don't match";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            $error = "Email or username already registered";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            
            if ($stmt->execute()) {
                $_SESSION['registration_success'] = true;
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | High Street Plaza</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #333;
            --gray: #95a5a6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: var(--dark);
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Header Styles (Matches index.php) */
        .top-bar {
            background-color: var(--primary);
            color: var(--light);
            padding: 10px 0;
            font-size: 0.9rem;
        }
        
        .user-actions {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }
        
        .user-actions a {
            color: var(--light);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .user-actions a:hover {
            color: var(--secondary);
        }
        
        .main-nav {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .store-title h1 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .store-title p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            padding: 5px 0;
            position: relative;
        }
        
        .nav-links a.active,
        .nav-links a:hover {
            color: var(--secondary);
        }
        
        .nav-links a.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--secondary);
        }
        
        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
            color: var(--primary);
        }
        
        /* Main Content Styles */
        .register-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
            flex: 1;
            display: flex;
            align-items: center;
        }
        
        .register-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            margin: 40px auto;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
        }
        
        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .register-card h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary);
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px 25px;
            background-color: var(--secondary);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
        }
        
        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .error {
            color: var(--accent);
            background-color: #fdecea;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
        }
        
        .login-link a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .password-requirements {
            color: var(--gray);
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 20px;
        }
        
        /* Footer Styles (Matches index.php) */
        .site-footer {
            background-color: #1a252f;
            color: var(--light);
            padding: 60px 0 20px;
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h3 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 1.3rem;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 10px;
        }
        
        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--secondary);
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            color: var(--light);
            font-size: 1.2rem;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #2c3e50;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: white;
                flex-direction: column;
                gap: 0;
                padding: 20px 0;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            }
            
            .nav-links.active {
                display: flex;
            }
            
            .nav-links li {
                padding: 10px 20px;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .register-card {
                padding: 30px 20px;
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>
    <!-- Header (Matches index.php) -->
    <div class="top-bar">
        <div class="container">
            <div class="user-actions">
                <a href="#" id="login-btn"><i class="fas fa-user"></i> Login</a>
                <a href="#" id="register-btn"><i class="fas fa-user-plus"></i> Register</a>
                <a href="#" id="cart-btn"><i class="fas fa-shopping-cart"></i> Cart (<span id="cart-count">0</span>)</a>
            </div>
        </div>
    </div>
    
    <nav class="main-nav">
        <div class="container">
            <div class="store-title">
                <h1><i class="fas fa-equals"></i> High Street Plaza Basement Store</h1>
                <p>Your Trusted Hardware Retailer</p>
            </div>
            
            <div class="nav-container">
                <ul class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="Contacts.php">About</a></li>
                </ul>
                
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>
    
    <!-- Registration Form -->
    <div class="register-container">
        <div class="register-card">
            <h2>Create Account</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" required>
                    <p class="password-requirements">Use at least 8 characters with a mix of letters and numbers</p>
                </div>
                
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                
                <button type="submit" class="btn">Register</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>

    <!-- Footer (Matches index.php) -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <p>High Street Plaza Basement Store has been serving the community since 1995 with quality hardware products and expert advice.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Store Information</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> San Fernando, High Street</li>
                        <li><i class="fas fa-phone"></i> (868) 478-8230</li>
                        <li><i class="fas fa-envelope"></i> info@highstreetplaza.com</li>
                        <li><i class="fas fa-clock"></i> Mon-Sat: 8:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> High Street Plaza Basement Store. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>