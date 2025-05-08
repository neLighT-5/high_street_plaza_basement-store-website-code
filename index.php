<?php

require_once 'config.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    error_log("Redirecting to login - session data: " . print_r($_SESSION, true));
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($page_description = 'something') ?>">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--secondary);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-accent {
            background-color: var(--accent);
        }
        
        .btn-accent:hover {
            background-color: #c0392b;
        }
        
        /* Header Styles */
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
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero h2 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .hero-btns {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        /* Services Preview */
        .services-preview {
            padding: 80px 0;
            background-color: white;
        }
        
        .services-preview h2 {
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary);
            font-size: 2.2rem;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .service-icon {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 20px;
        }
        
        .service-card h3 {
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        /* Why Choose Us */
        .why-us {
            padding: 80px 0;
            background-color: #f1f5f9;
        }
        
        .why-us h2 {
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary);
            font-size: 2.2rem;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature {
            display: flex;
            gap: 20px;
        }
        
        .feature-icon {
            font-size: 1.8rem;
            color: var(--secondary);
        }
        
        .feature-text h3 {
            margin-bottom: 10px;
            color: var(--primary);
        }
        
        /* Testimonials */
        .testimonials {
            padding: 80px 0;
            background-color: white;
        }
        
        .testimonials h2 {
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary);
            font-size: 2.2rem;
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .testimonial {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            position: relative;
        }
        
        .testimonial:before {
            content: '"';
            font-size: 5rem;
            color: var(--secondary);
            opacity: 0.2;
            position: absolute;
            top: 10px;
            left: 20px;
        }
        
        .testimonial p {
            margin-bottom: 20px;
            font-style: italic;
            position: relative;
            z-index: 1;
        }
        
        .testimonial-author {
            font-weight: bold;
            color: var(--primary);
        }
        
        /* Call to Action */
        .cta {
            padding: 80px 0;
            background-color: var(--primary);
            color: white;
            text-align: center;
        }
        
        .cta h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        
        .cta p {
            max-width: 700px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }
        
        /* Footer */
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
            
            .hero h2 {
                font-size: 2.2rem;
            }
            
            .hero-btns {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navigation -->
    <header>
        <?php include 'includes/topbar.php' ?>        
        <?php include 'includes/nav.php' ?>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>Quality Hardware & Expert Advice</h2>
            <p>San Fernando's trusted hardware store since 1995. Everything you need for home improvement, construction, and maintenance projects.</p>
            <div class="hero-btns">
                <a href="Pages/products.php" class="btn">Browse Products</a>
                <a href="Pages/services.php" class="btn btn-accent">Our Services</a>
            </div>
        </div>
    </section>

    <!-- Services Preview Section -->
    <section class="services-preview">
        <div class="container">
            <h2>Our Hardware Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Tool Rental</h3>
                    <p>Quality tools available for rent at affordable daily rates.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3>Delivery Service</h3>
                    <p>We deliver heavy or bulky items directly to your job site.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-search-dollar"></i>
                    </div>
                    <h3>Special Orders</h3>
                    <p>Can't find what you need? We'll source it for you.</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Expert Advice</h3>
                    <p>Get free project advice from our experienced staff.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-us">
        <div class="container">
            <h2>Why Choose Our Hardware Store?</h2>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="feature-text">
                        <h3>28 Years in Business</h3>
                        <p>Trusted by the San Fernando community since 1995.</p>
                    </div>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Knowledgeable Staff</h3>
                        <p>Our team has decades of combined experience.</p>
                    </div>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Competitive Prices</h3>
                        <p>We match any local competitor's price.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>What Our Customers Say</h2>
            <div class="testimonial-grid">
                <div class="testimonial">
                    <p>The staff at High Street Plaza helped me find exactly what I needed for my home renovation. Their advice saved me time and money!</p>
                    <div class="testimonial-author">- Michael R., San Fernando</div>
                </div>
                
                <div class="testimonial">
                    <p>When I had a plumbing emergency at 5pm on a Friday, they stayed open late to make sure I got what I needed. That's service!</p>
                    <div class="testimonial-author">- Sarah K., Marabella</div>
                </div>
                
                <div class="testimonial">
                    <p>Their tool rental service is a lifesaver for small projects where buying doesn't make sense. Always well-maintained equipment.</p>
                    <div class="testimonial-author">- David T., La Romaine</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Start Your Project?</h2>
            <p>Visit our store today or contact us to discuss your hardware needs.</p>
            <div class="hero-btns">
                <a href="tel:8684788230" class="btn"><i class="fas fa-phone"></i> Call Us</a>
                <a href="Pages/Contacts.php" class="btn btn-accent"><i class="fas fa-map-marker-alt"></i> Get Directions</a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <p>Family-owned hardware store serving San Fernando with quality products and honest advice since 1995.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Pages/products.php">Products</a></li>
                        <li><a href="Pages/services.php">Services</a></li>
                        <li><a href="Pages/Contacts.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Store Hours</h3>
                    <ul>
                        <li>Monday-Friday: 8:00 AM - 6:00 PM</li>
                        <li>Saturday: 8:00 AM - 4:00 PM</li>
                        <li>Sunday: Closed</li>
                        <li>Public Holidays: 9:00 AM - 2:00 PM</li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> High Street, San Fernando</li>
                        <li><i class="fas fa-phone"></i> (868) 478-8230</li>
                        <li><i class="fas fa-envelope"></i> info@highstreetplaza.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?= date("Y") ?> High Street Plaza Basement Store. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
        
        // Simple cart counter
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.classList.contains('add-to-cart')) {
                    e.preventDefault();
                    const count = document.getElementById('cart-count');
                    count.textContent = parseInt(count.textContent) + 1;
                }
            });
        });

        // Session validation
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Session check:", {
                loggedin: <?= isset($_SESSION['loggedin']) ? 'true' : 'false' ?>,
                path: window.location.pathname
            });
        });
    </script>
</body>
</html>