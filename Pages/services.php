<?php
// services.php - Save in Pages directory

require_once '../config.php';

// Set page title
$page_title = "Services | High Street Plaza Basement Store";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles - Same as Products/About Pages */
        .top-bar {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 10px 0;
            font-size: 0.9rem;
        }
        
        .user-actions {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }
        
        .user-actions a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .user-actions a:hover {
            color: #3498db;
        }
        
        .main-nav {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .store-title {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .store-title h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .store-title p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .nav-container {
            display: flex;
            justify-content: center;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        .nav-links a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            padding: 5px 0;
            position: relative;
        }
        
        .nav-links a.active,
        .nav-links a:hover {
            color: #3498db;
        }
        
        .nav-links a.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #3498db;
        }
        
        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            text-align: center;
            padding: 10px 0;
        }
        
        /* Page Header - Same as Products/About Pages */
        .page-header {
            background-color: #3498db;
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-header h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        /* Services Section - Updated to match style */
        .services {
            padding: 60px 0;
        }
        
        .services h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
            font-size: 2rem;
        }
        
        .services ul {
            max-width: 800px;
            margin: 0 auto;
            list-style: none;
            padding: 0;
        }
        
        .services ul li {
            background-color: #fff;
            padding: 15px 25px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .services ul li:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .services ul li::before {
            font-size: 1.3rem;
        }
        
        /* Footer Styles - Same as Products/About Pages */
        .site-footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 20px;
            padding: 0 15px;
        }
        
        .footer-section h3 {
            color: #3498db;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
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
            color: #3498db;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #34495e;
            margin-top: 20px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            color: #ecf0f1;
            font-size: 1.2rem;
        }
        
        /* Responsive Styles - Same as Products/About Pages */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                gap: 15px;
                width: 100%;
            }
            
            .nav-links.active {
                display: flex;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .footer-container {
                flex-direction: column;
            }
            
            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navigation - Same as Products/About Pages -->
    <header>
        <?php include '../includes/topbar.php' ?>        
        <?php include '../includes/nav.php' ?>
    </header>

    <!-- Page Header - Same as Products/About Pages -->
    <section class="page-header">
        <div class="container">
            <h2>Our Services</h2>
            <p>Quality services to complement our premium hardware products</p>
        </div>
    </section>

    <!-- Services Section - Content remains the same -->
    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <ul>
                <li>🔧 Tool Rental Services</li>
                <li>📦 Custom Packaging and Delivery</li>
                <li>🔩 Product Sourcing for Special Orders</li>
                <li>🧰 Repair and Maintenance Advice</li>
                <li>🏡 Home Improvement Consultations</li>
            </ul>
        </div>
    </section>

    <!-- Footer Section - Same as Products/About Pages -->
    <footer class="site-footer">
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
                    <li><i class="fas fa-phone"></i> (868) 478-8230 </li>
                    <li><i class="fas fa-envelope"></i> info@highstreetplaza.com</li>
                    <li><i class="fas fa-clock"></i> Mon-Sat: 8:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date("Y") ?> High Street Plaza Basement Store. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript - Same as Products/About Pages -->
    <script>
        // Mobile menu toggle functionality
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>
<?php
// Close database connection
$conn->close();
?>