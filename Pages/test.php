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
    $row = $result->fetch_assoc();
    $row['category'] = $row['category'] ?? 'Uncategorized';
    $row['image'] = $row['image'] ?? 'default-product.jpg';
    $row['description'] = $row['description'] ?? 'No description available';
    $products[] = $row;
} else {
    echo "No products found.";
}

print_r($products);
?>
