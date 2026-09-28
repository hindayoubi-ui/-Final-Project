```php
<?php

// Connect to HA Home Store database
include("../conn.php");


// Check if the furniture product ID was received
if (isset($_GET['id'])) {

    // Get the product ID
    $furniture_id = (int) $_GET['id'];


    // Check if the ID is valid
    if ($furniture_id <= 0) {
        die("Invalid furniture product ID.");
    }


    /*
        Get the furniture image name
        before deleting the product.

        We need the image name so we can
        delete the image from Client/images.
    */

    $image_sql = "SELECT f_image FROM furniture WHERE furniture_id = ?";

    $image_stmt = $conn->prepare($image_sql);


    // Check if the statement was prepared successfully
    if (!$image_stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind furniture ID
    $image_stmt->bind_param("i", $furniture_id);


    // Execute SELECT
    $image_stmt->execute();


    // Get the result
    $image_result = $image_stmt->get_result();


    // Check if furniture product exists
    if ($image_result->num_rows == 0) {
        die("Furniture product not found.");
    }


    // Get the furniture image name
    $product = $image_result->fetch_assoc();

    $image_name = $product['f_image'];


    // Close SELECT statement
    $image_stmt->close();


    // Delete the product from the database
    $delete_sql = "DELETE FROM furniture WHERE furniture_id = ?";

    $delete_stmt = $conn->prepare($delete_sql);


    // Check if the DELETE statement was prepared successfully
    if (!$delete_stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind furniture ID
    $delete_stmt->bind_param("i", $furniture_id);


    // Execute DELETE
    if ($delete_stmt->execute()) {

        /*
            Delete the product image from
            Client/images after deleting
            the product from the database.
        */

        $image_path = "../Client/images/" . $image_name;


        if (
            !empty($image_name) &&
            file_exists($image_path)
        ) {

            unlink($image_path);

        }


        // Show success message
        echo "
        <script>

            alert('✓ Furniture product deleted successfully!');

            window.location.href = 'admin_furniture.php';

        </script>
        ";

        exit;

    } else {

        // Show error if DELETE failed
        die(
            "Error deleting furniture product: "
            . $delete_stmt->error
        );

    }


    // Close DELETE statement
    $delete_stmt->close();

} else {

    // No ID was provided
    die("Furniture product ID is missing.");

}

?>
```
