
<?php

// Include the database connection
include("../conn.php");

// Check if the Hero ID is available in the URL
if (isset($_GET['id'])) {

    // Get the Hero ID from the URL
    $hero_id = (int) $_GET['id'];

    // Check if the ID is valid
    if ($hero_id <= 0) {
        die("Invalid Hero ID.");
    }


    // Get the image name before deleting the row
    $select_sql = "SELECT hero_image FROM hero WHERE hero_id = ?";

    // Prepare the SQL statement
    $select_stmt = $conn->prepare($select_sql);

    // Check if prepare failed
    if (!$select_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the Hero ID
    $select_stmt->bind_param("i", $hero_id);

    // Execute the query
    $select_stmt->execute();

    // Get the result
    $result = $select_stmt->get_result();

    // Get the Hero data
    $hero = $result->fetch_assoc();

    // Display the data for debugging
    // var_dump($hero);

    // Close the statement
    $select_stmt->close();


    // Check if the Hero exists
    if (!$hero) {
        die("Hero slide not found.");
    }


    // Delete the Hero row from the database
    $delete_sql = "DELETE FROM hero WHERE hero_id = ?";

    // Prepare the delete statement
    $delete_stmt = $conn->prepare($delete_sql);

    // Check if prepare failed
    if (!$delete_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the Hero ID
    $delete_stmt->bind_param("i", $hero_id);


    // Execute the delete
    if ($delete_stmt->execute()) {

        // Image folder
        $image_path = "../Client/images/" . $hero['hero_image'];

        // Delete the image from the folder
        if (
            !empty($hero['hero_image']) &&
            file_exists($image_path)
        ) {
            unlink($image_path);
        }


        // Show success message and return to the Hero page
        echo "
        <script>
            alert('✓ Carousel slide deleted successfully!');
            window.location.href = 'admin_hero.php';
        </script>
        ";

        exit;

    } else {

        die("Error deleting carousel slide: " . $delete_stmt->error);

    }


    // Close the statement
    $delete_stmt->close();

} else {

    // Display an error if the ID is missing
    die("Hero ID is missing.");

}

?>

