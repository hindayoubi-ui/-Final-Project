
<?php

// Include the database connection
include("../conn.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the data from the form
    $hero_id = (int) $_POST['hero_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Display the received data for debugging
    // var_dump($hero_id);exit;
    // var_dump($title);exit;
    // var_dump($description);exit;
    // var_dump($_FILES);exit;

    // Check if the Hero ID is valid
    if ($hero_id <= 0) {
        die("Invalid Hero ID.");
    }


    /*
        First, get the current image from the database.
        We need its name in case we want to delete it later.
    */
    $select_sql = "SELECT hero_image FROM hero WHERE hero_id = ?";

    $select_stmt = $conn->prepare($select_sql);

    if (!$select_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $select_stmt->bind_param("i", $hero_id);

    $select_stmt->execute();

    $select_result = $select_stmt->get_result();

    $old_hero = $select_result->fetch_assoc();

    $select_stmt->close();


    // Check if the Hero exists
    if (!$old_hero) {
        die("Hero slide not found.");
    }


    // Keep the old image by default
    $hero_image = $old_hero['hero_image'];


    /*
        Check if the user uploaded a new image.
        If no image was uploaded, we keep the old image.
    */
    if (
        isset($_FILES['hero_image']) &&
        $_FILES['hero_image']['error'] === UPLOAD_ERR_OK
    ) {

        // Get the new image information
        $image_name = $_FILES['hero_image']['name'];
        $image_tmp = $_FILES['hero_image']['tmp_name'];
        $image_size = $_FILES['hero_image']['size'];

        // Get the file extension
        $extension = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );

        // Allowed image extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        // Check image extension
        if (!in_array($extension, $allowed_extensions)) {
            die("Invalid image type.");
        }

        // Check image size
        // Maximum size = 2 MB
        if ($image_size > 2 * 1024 * 1024) {
            die("Image size must be less than 2MB.");
        }

        // Create a unique name for the new image
        $new_image_name = uniqid('hero_', true) . '.' . $extension;

        // Image upload folder
        $upload_folder = "../Client/images/";

        // Full path of the new image
        $new_image_path = $upload_folder . $new_image_name;

        // Move the new image to Client/images
        if (!move_uploaded_file($image_tmp, $new_image_path)) {
            die("Failed to upload new image.");
        }

        // Use the new image name in the database
        $hero_image = $new_image_name;


        /*
            Delete the old image after the new image
            has been uploaded successfully.
        */
        $old_image_path = $upload_folder . $old_hero['hero_image'];

        if (
            !empty($old_hero['hero_image']) &&
            file_exists($old_image_path)
        ) {
            unlink($old_image_path);
        }

    }


    // SQL query to update the Hero data
    $sql = "UPDATE hero
            SET title = ?, description = ?, hero_image = ?
            WHERE hero_id = ?";


    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if prepare failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind the values
    // s = title
    // s = description
    // s = hero_image
    // i = hero_id
    $stmt->bind_param(
        "sssi",
        $title,
        $description,
        $hero_image,
        $hero_id
    );


    // Execute the update
    if ($stmt->execute()) {

        echo "
        <script>
            alert('✓ Carousel slide updated successfully!');
            window.location.href = 'admin_hero.php';
        </script>
        ";

        exit;

    } else {

        die("Error updating carousel slide: " . $stmt->error);

    }


    // Close the statement
    $stmt->close();

}

?>

