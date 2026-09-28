<?php

// Connect to HA Home Store database
include("../conn.php");


// Check if the kitchen product ID was received
if (isset($_GET['id'])) {

    // Get the product ID
    $kitchen_id = (int) $_GET['id'];

    // Check if the ID is valid
    if ($kitchen_id <= 0) {
        die("Invalid kitchen product ID.");
    }


    // Delete the product from the database
    $delete_sql = "DELETE FROM kitchen WHERE kitchen_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);

    if (!$delete_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $delete_stmt->bind_param("i", $kitchen_id);


    // Execute DELETE
    if ($delete_stmt->execute()) {

        // Show success message
        echo "
        <script>
            alert('✓ Kitchen product deleted successfully!');
            window.location.href = 'admin_kitchen.php';
        </script>
        ";

        exit;

    } else {

        // Show error if DELETE failed
        die("Error deleting kitchen product: " . $delete_stmt->error);

    }

    $delete_stmt->close();

} else {

    // No ID was provided
    die("Kitchen product ID is missing.");

}

?>