<?php

// Connect to the database
include("../conn.php");

// Check if the product ID was provided in the URL
if (isset($_GET['product_id'])) {

    // Get the product ID and convert it to an integer
    $product_id = (int) $_GET['product_id'];

    // Prepare the DELETE query
    $sql = "DELETE FROM products WHERE product_id = ?";

    $stmt = $conn->prepare($sql);

    // Bind the product ID
    // i = integer
    $stmt->bind_param("i", $product_id);

    // Execute the DELETE query
    if ($stmt->execute()) {

        // Product deleted successfully
        // Go back to the Products page
        header("Location: products.php");
        exit;

    } else {

        // Display the database error
        echo "Error deleting product: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

} else {

    // Product ID was not provided
    die("Product ID not provided.");
}

?>