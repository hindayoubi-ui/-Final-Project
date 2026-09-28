<?php

session_start();



include("../conn.php");
// var_dump($_SESSION);exit


// var_dump($_POST);
// var_dump($_FILES);
// exit;

// Check if user is logged in
if (!isset($_SESSION['users_id'])) {
    die("User is not logged in.");
}

$users_id = $_SESSION['users_id'];

// Check occasion
if (isset($_POST['occasion'])) {

    $occasion = $_POST['occasion'];

} else {

    die("Please choose an occasion.");

}


// Check image
if (
    isset($_FILES['background_image']) &&
    $_FILES['background_image']['error'] === UPLOAD_ERR_OK
) {

    $image_name = $_FILES['background_image']['name'];
    $image_tmp = $_FILES['background_image']['tmp_name'];
    $image_size = $_FILES['background_image']['size'];

} else {

    die("Please choose a background image.");

}


// Get file extension
$image_extension = strtolower(
    pathinfo($image_name, PATHINFO_EXTENSION)
);


// Allowed extensions
$allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];


// Check extension
if (!in_array($image_extension, $allowed_extensions)) {

    die("Only JPG, JPEG, PNG and WEBP images are allowed.");

}


// Check image size - maximum 2 MB
if ($image_size > 2 * 1024 * 1024) {

    die("Image size must be less than 2 MB.");

}


// Create unique image name
$new_image_name = uniqid() . "." . $image_extension;


// Image upload folder
$upload_folder = "../Client/images/";


// Full image path
$upload_path = $upload_folder . $new_image_name;


// Move image
if (move_uploaded_file($image_tmp, $upload_path)) {

    // Insert background into database

    $sql = "INSERT INTO product_background
            (occasion, background_image, users_id)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param(
            "ssi",
            $occasion,
            $new_image_name,
            $users_id
        );

        if ($stmt->execute()) {

            echo "<script>
                    alert('Background added successfully!');
                    window.location.href = 'add_background.php';
                  </script>";

            exit;

        } else {

            echo "Error adding background: " . $stmt->error;

        }

    } else {

        echo "Prepare failed: " . $conn->error;

    }

} else {

    echo "Error uploading image.";

}

?>