```php
<?php

// Include the database connection
include("../conn.php");

// Check if the image was uploaded successfully
if (
    isset($_FILES['hero_image']) &&
    $_FILES['hero_image']['error'] === UPLOAD_ERR_OK
) {

    // Get the data from the form
    if (
        isset($_POST['title']) &&
        isset($_POST['description'])
    ) {

        $title = $_POST['title'];
        $description = $_POST['description'];

        // Get the uploaded image information
        $image_name = $_FILES['hero_image']['name'];
        $image_tmp = $_FILES['hero_image']['tmp_name'];
        $image_size = $_FILES['hero_image']['size'];

        // Display data for debugging
        // var_dump($title);
        // var_dump($description);
        // var_dump($_FILES['hero_image']);

        // Get the file extension
        $extension = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );

        // Allowed image extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        // Check the image extension
        if (!in_array($extension, $allowed_extensions)) {
            die("Invalid image type.");
        }

        // Check image size
        // Maximum size = 2 MB
        if ($image_size > 2 * 1024 * 1024) {
            die("Image size must be less than 2MB.");
        }

        // Create a unique image name
        $new_image_name = uniqid('hero_', true) . '.' . $extension;

        // Image upload folder
        $upload_folder = "../Client/images/";

        // Full image path
        $image_path = $upload_folder . $new_image_name;

        // Move the uploaded image to Client/images
        if (!move_uploaded_file($image_tmp, $image_path)) {
            die("Failed to upload image.");
        }

        // SQL query to insert the Hero data
        $sql = "INSERT INTO hero (title, description, hero_image)
                VALUES (?, ?, ?)";

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
        $stmt->bind_param(
            "sss",
            $title,
            $description,
            $new_image_name
        );

        // Execute the query
        if ($stmt->execute()) {

            echo "
            <script>
                alert('✓ Carousel slide added successfully!');
                window.location.href = 'admin_hero.php';
            </script>
            ";

            exit;

        } else {

            // If the database insert fails
            // Delete the uploaded image
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            die("Error adding carousel slide: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();

    } else {

        die("Title or description is missing.");

    }

} else {

    die("Please upload a valid image.");

}

?>
```
