<?php
require_once '../config.php';

$selected_category = $_GET['category'];
$products = [];
$categories = ['Electrical', 'Hand Tools', 'Power Tools'];

switch ($selected_category) {
    case 'Electrical':
        $category_id = 3;
        break;
    
    case 'Hand Tools':
        $category_id = 2;
        break;

    case 'Power Tools':
        $category_id = 1;
        break;
    
    default:
        $category_id = 0;
        break;
}

if ($category_id == 0 ) {
    $sql = "SELECT * FROM products LIMIT 12";
    $result = $conn->query($sql);
} else {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
}

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_all(MYSQLI_ASSOC);
    // $row['category'] = $row['category'] ?? 'Uncategorized';
    // $row['image'] = $row['image'] ?? 'default-product.jpg';
    // $row['description'] = $row['description'] ?? 'No description available';
    $products = $row;
} else {
    echo "No products found.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog | High Street Plaza Basement Store</title>
    <link rel="stylesheet" href="../css/products.css">
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
        
        /* Header Styles */
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
        
        /* Page Header */
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
        
        /* Catalog Header */
        .catalog-intro {
            text-align: center;
            margin: 40px auto;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .catalog-intro h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .catalog-intro p {
            color: #7f8c8d;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        /* Category Tabs */
        .category-tabs {
            display: flex;
            justify-content: center;
            margin: 30px 0;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .category-tab {
            padding: 12px 24px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .category-tab:hover {
            background-color: #e0e0e0;
        }
        
        .category-tab.active {
            background-color: #3498db;
            color: white;
        }
        
        /* Products Section */
        .products-section {
            padding: 40px 0;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .product-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .product-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .product-card:hover img {
            transform: scale(1.05);
        }
        
        .product-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .product-card .price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        
        .product-card .description {
            color: #7f8c8d;
            margin-bottom: 15px;
            font-size: 0.9rem;
            flex: 1;
        }
        
        .product-card .category {
            display: inline-block;
            padding: 4px 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
            font-size: 0.75rem;
            color: #666;
            margin-bottom: 10px;
        }
        
        .product-card .add-to-cart {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 4px;
            font-weight: 500;
            margin-top: auto;
        }
        
        .product-card .add-to-cart:hover {
            background-color: #2980b9;
        }
        
        /* Footer Styles */
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
        
        /* Responsive Styles */
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
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .category-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .category-tab {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navigation -->
    <header>
        <?php include '../includes/topbar.php' ?>        
        <?php include '../includes/nav.php' ?>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h2>Our Product Catalog</h2>
            <p>Carefully curated selection of premium hardware products</p>
        </div>
    </section>

    <!-- Catalog Introduction -->
    <section class="catalog-intro">
        <h2>Featured Products</h2>
        <p>We take pride in offering a select range of high-quality hardware products. Our catalog is carefully curated to ensure we provide only the best solutions for your needs.</p>
    </section>

    <!-- Category Tabs -->
    <div class="container">
        <div class="category-tabs">
            <button class="category-tab <?php echo $selected_category == 'all' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=all'">
                All Products
            </button>
            <button class="category-tab <?php echo $selected_category == 'Electrical' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=Electrical'">
                Electrical
            </button>
            <button class="category-tab <?php echo $selected_category == 'Hand Tools' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=Hand Tools'">
                Hand Tools
            </button>
            <button class="category-tab <?php echo $selected_category == 'Power Tools' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=Power Tools'">
                Power Tools
            </button>
        </div>
    </div>

    <!-- Products Listing -->
<!-- Products Listing -->
<section class="products-section">
    <div class="container">
        <div class="products-grid">
            <?php if(empty($products)): ?>
                <div class="notification" style="grid-column: 1/-1; text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border-radius: 4px;">
                    <p>No products found in this category. Please check back later.</p>
                </div>
            <?php else: ?>
                <?php foreach($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="<?php echo !empty($product['image']) ? '../Images/' . htmlspecialchars($product['image']) : '../Images/default-product.jpg'; ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 onerror="this.src='../Images/default-product.jpg'">
                        </div>
                        <div class="product-info">
                            <?php if(!empty($product['category_name'])): ?>
                                <span class="category"><?php echo htmlspecialchars($product['category_name']); ?></span>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                            <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

    <!-- Footer Section -->
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
            <p>&copy; <?php echo date("Y"); ?> High Street Plaza Basement Store. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle functionality
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.parentElement.querySelector('h3').textContent;
                const productPrice = this.parentElement.querySelector('.price').textContent;
                
                // In a real implementation, you would send this to your server
                console.log(`Added to cart: ${productName} - ${productPrice}`);
                
                // Update cart count
                const cartCount = document.getElementById('cart-count');
                cartCount.textContent = parseInt(cartCount.textContent) + 1;
                
                // Show confirmation
                alert(`${productName} added to cart!`);
            });
        });
    </script>
</body>
</html>