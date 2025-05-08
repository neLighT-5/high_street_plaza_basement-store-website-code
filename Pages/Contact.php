<?php
// about.php - Save in Pages directory

require_once '../config.php';

// Set page title
$page_title = "About Us | High Street Plaza Basement Store";
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
        
        /* Header Styles - Same as Products Page */
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
        
        /* Page Header - Same as Products Page */
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
        
        /* About Page Specific Styles */
        .about-page {
            padding: 40px 0;
        }
        
        .our-story .container {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .story-content {
            flex: 1;
        }
        
        .story-content h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        
        .story-content p {
            color: #7f8c8d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .story-image {
            flex: 1;
        }
        
        .story-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .milestones {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .milestone {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }
        
        .milestone h3 {
            color: #3498db;
            margin-bottom: 10px;
        }
        
        .meet-team {
            background: #f8f9fa;
            padding: 60px 0;
        }
        
        .meet-team h2 {
            color: #2c3e50;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .team-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
            padding-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .team-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        
        .team-card h3 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 1.2rem;
        }
        
        .team-card .position {
            color: #7f8c8d;
            font-weight: 500;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .team-card .quote {
            font-style: italic;
            padding: 0 20px;
            color: #555;
            font-size: 0.9rem;
        }
        
        .contact-cta {
            text-align: center;
            padding: 60px 0;
            background: #3498db;
            color: white;
        }
        
        .contact-cta h3 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .contact-cta p {
            font-size: 1.1rem;
            margin-bottom: 25px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .contact-cta .btn {
            display: inline-block;
            padding: 12px 30px;
            background: white;
            color: #3498db;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .contact-cta .btn:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
        
        /* Footer Styles - Same as Products Page */
        .site-footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 40px 0 20px;
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
        
        /* Responsive Styles - Same as Products Page */
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
            
            .our-story .container {
                flex-direction: column;
            }
            
            .team-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            .team-grid {
                grid-template-columns: 1fr;
            }
            
            .milestones {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navigation - Same as Products Page -->
    <header>
        <?php include '../includes/topbar.php' ?>        
        <?php include '../includes/nav.php' ?>
    </header>

    <!-- Page Header - Same as Products Page -->
    <section class="page-header">
        <div class="container">
            <h2>About Our Store</h2>
            <p>Discover our story and meet the team behind your trusted hardware store</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="about-page">
        <section class="our-story">
            <div class="container">
                <div class="story-content">
                    <h2>Our Story Since 1995</h2>
                    <p>Founded by Amit Mohan, our hardware store has been serving the community for over 18 years with quality products and expert advice for all your home improvement needs.</p>
                    <div class="milestones">
                        <?php
                        $milestones = [
                            ['year' => '1995', 'event' => 'Opened our first location'],
                            ['year' => '2002', 'event' => 'Expanded to second location'],
                            ['year' => '2010', 'event' => 'Launched online store'],
                            ['year' => '2020', 'event' => 'Renovated flagship store']
                        ];
                        
                        foreach ($milestones as $milestone) {
                            echo '<div class="milestone">
                                <h3>'.$milestone['year'].'</h3>
                                <p>'.$milestone['event'].'</p>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="story-image">
                    <img src="../Images/background wallpaper.jpeg" alt="Our Store in 1995">
                </div>
            </div>
        </section>

        <section class="meet-team">
            <div class="container">
                <h2>Meet Our Experts</h2>
                <div class="team-grid">
                    <?php
                    $team_members = [
                        [
                            'image' => 'team-john.jpg',
                            'name' => 'Amit Mohan',
                            'position' => 'Founder & Master Carpenter',
                            'quote' => 'I love helping customers find the perfect solution.'
                        ],
                        [
                            'image' => 'team-sarah.jpg',
                            'name' => 'Emily',
                            'position' => 'Store Manager',
                            'quote' => 'Customer satisfaction is our top priority.'
                        ],
                        [
                            'image' => 'team-mike.jpg',
                            'name' => 'Mike Rodriguez',
                            'position' => 'Electrical Specialist',
                            'quote' => 'I can help with any electrical project.'
                        ],
                        [
                            'image' => 'team-emily.jpg',
                            'name' => 'Jessica',
                            'position' => 'Paint & Decor Expert',
                            'quote' => 'Let me help you choose the perfect colors.'
                        ]
                    ];
                    
                    foreach ($team_members as $member) {
                        echo '<div class="team-card">
                            <img src="../Images/'.$member['image'].'" alt="'.$member['name'].'">
                            <h3>'.$member['name'].'</h3>
                            <p class="position">'.$member['position'].'</p>
                            <p class="quote">"'.$member['quote'].'"</p>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="contact-cta">
            <div class="container">
                <h3>Have Questions About Our Products?</h3>
                <p>Our team is ready to help with your home improvement projects</p>
                <a href="Contacts.php" class="btn">Contact Us</a>
            </div>
        </section>
    </main>

    <!-- Footer Section - Same as Products Page -->
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

    <!-- JavaScript - Same as Products Page -->
    <script>
        // Mobile menu toggle functionality
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>