<?php

// Connect to HA Home Store database 
include("../conn.php");


// Check if all product data and image were submitted 
if (
    isset($_POST['product_name']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    isset($_POST['category_id']) &&
    isset($_FILES['products_image'])
) {


    // Get product data from form 
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];
    $category_id = (int) $_POST['category_id'];


    // Check if product already exists
    $check_sql = "SELECT product_id FROM products WHERE product_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $product_name);
    $check_stmt->execute();

    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>
                alert('Product already exists!');
                window.location.href = 'products.php';
              </script>";
        exit;
    }

    $check_stmt->close();


    // Check product name 
    if ($product_name === '') {
        die("Product name is required.");
    }


    // Check description 
    if ($description === '') {
        die("Product description is required.");
    }


    // Check category 
    if ($category_id <= 0) {
        die("Please select a category.");
    }


    // Check price 
    if ($price < 0) {
        die("Invalid product price.");
    }


    // Check image upload 
    if ($_FILES['products_image']['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading product image.");
    }


    // Get image information 
    $original_name = $_FILES['products_image']['name'];
    $tmp_name = $_FILES['products_image']['tmp_name'];


    // Get image extension 
    $extension = strtolower(
        pathinfo($original_name, PATHINFO_EXTENSION)
    );


    // Allowed image formats 
    $allowed_extensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];


    // Check image format 
    if (!in_array($extension, $allowed_extensions)) {
        die("Invalid image format.");
    }


    // Maximum image size = 2 MB 
    $max_size = 2 * 1024 * 1024;


    if ($_FILES['products_image']['size'] > $max_size) {
        die("Product image must not exceed 2 MB.");
    }


    // Create a unique name for the image 
    $file_name = uniqid('product_', true) . '.' . $extension;


    // HA Home Store product images folder 
    $upload_folder = 'uploads/products/';


    // Full image destination 
    $destination = $upload_folder . $file_name;


    // Move image to uploads/products 
    if (!move_uploaded_file($tmp_name, $destination)) {
        die("Failed to upload product image.");
    }


    // Insert product into HA Home Store products table 
    $sql = "INSERT INTO products 
            ( 
                product_name, 
                description, 
                price, 
                category_id, 
                products_image 
            ) 
            VALUES (?, ?, ?, ?, ?)";


    // Prepare SQL statement 
    $stmt = $conn->prepare($sql);


    // Check if SQL statement was prepared successfully 
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind product values 
    $stmt->bind_param(
        "ssdis",
        $product_name,
        $description,
        $price,
        $category_id,
        $file_name
    );


    // Execute INSERT query 
    if ($stmt->execute()) {


        // Display success message with green check icon

        // Display success message
?>

        <div style="color: green; font-size: 20px;">
            <i class="bi bi-check-circle-fill"></i>
            Product added successfully!
        </div>

<?php
    } else {

        echo "Error adding product: " . $stmt->error;
    }


    // Close statement 
    $stmt->close();
}
