<?php

// Connect to database
include("../conn.php");

// Check if all required fields were submitted
if (
    isset($_POST['product_id']) &&
    isset($_POST['product_name']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    isset($_POST['category_id'])
) {

    // Get values from the form
    $product_id = (int) $_POST['product_id'];
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];
    $category_id = (int) $_POST['category_id'];

    // Validate product ID
    if ($product_id <= 0) {
        die("Invalid product ID.");
    }

    // Validate product name
    if ($product_name === '') {
        die("Product name is required.");
    }

    // Validate description
    if ($description === '') {
        die("Product description is required.");
    }

    // Validate category
    if ($category_id <= 0) {
        die("Please select a category.");
    }

    // Validate price
    if ($price < 0) {
        die("Invalid product price.");
    }


    // Get old image
    $sql_old = "SELECT products_image
                FROM products
                WHERE product_id = ?";

    $stmt_old = $conn->prepare($sql_old);

    if (!$stmt_old) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_old->bind_param("i", $product_id);
    $stmt_old->execute();

    $result_old = $stmt_old->get_result();

    if ($result_old->num_rows === 0) {
        die("Product not found.");
    }

    $old_product = $result_old->fetch_assoc();
    $old_image = $old_product['products_image'];

    $stmt_old->close();


    // Check if a new image was uploaded
    $new_image_uploaded = (
        isset($_FILES['products_image']) &&
        $_FILES['products_image']['error'] === UPLOAD_ERR_OK &&
        !empty($_FILES['products_image']['name'])
    );


    // If a new image was uploaded
    if ($new_image_uploaded) {

        // Get image information
        $original_name = $_FILES['products_image']['name'];
        $tmp_name = $_FILES['products_image']['tmp_name'];
        $file_size = $_FILES['products_image']['size'];

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

        // Check image size
        if ($file_size > $max_size) {
            die("Image size must not exceed 2 MB.");
        }


        // Generate unique image name
        $file_name = uniqid('product_', true) . '.' . $extension;


        // Product image folder
        $upload_folder = 'uploads/products/';

        // Full destination
        $destination = $upload_folder . $file_name;


        // Move new image
        if (!move_uploaded_file($tmp_name, $destination)) {
            die("Failed to upload image.");
        }


        // Update product WITH new image
        $sql = "UPDATE products
                SET product_name = ?,
                    description = ?,
                    price = ?,
                    category_id = ?,
                    products_image = ?
                WHERE product_id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssdisi",
            $product_name,
            $description,
            $price,
            $category_id,
            $file_name,
            $product_id
        );


        // Execute UPDATE
        if ($stmt->execute()) {

            // Delete old image
            if (!empty($old_image)) {

                $old_image_path = $upload_folder . $old_image;

                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            // Success alert
            echo "<script>
                    alert('Product updated successfully!');
                    window.location.href = 'products.php';
                  </script>";

            exit;

        } else {

            // Delete new image if database update failed
            if (file_exists($destination)) {
                unlink($destination);
            }

            echo "Error updating product: " . $stmt->error;
        }


    } else {

        // Update product WITHOUT changing image
        $sql = "UPDATE products
                SET product_name = ?,
                    description = ?,
                    price = ?,
                    category_id = ?
                WHERE product_id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssdii",
            $product_name,
            $description,
            $price,
            $category_id,
            $product_id
        );


        // Execute UPDATE
        if ($stmt->execute()) {

            // Success alert
            echo "<script>
                    alert('Product updated successfully!');
                    window.location.href = 'products.php';
                  </script>";

            exit;

        } else {

            echo "Error updating product: " . $stmt->error;
        }
    }

    // Close statement
    $stmt->close();
}

?>