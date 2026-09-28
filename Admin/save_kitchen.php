<?php

// Connect to HA Home Store database
include("../conn.php");


// Check if all kitchen product data and image were submitted
if (
    isset($_POST['kname']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    isset($_FILES['k_image'])
) {

    // Get product data from the form
    $kname = trim($_POST['kname']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];


    // Check product name
    if ($kname === '') {

        die("Product name is required.");

    }


    // Check product description
    if ($description === '') {

        die("Product description is required.");

    }


    // Check product price
    if ($price < 0) {

        die("Invalid product price.");

    }


    // Check if the kitchen product already exists
    $check_sql = "SELECT kitchen_id FROM kitchen WHERE kname = ?";

    $check_stmt = $conn->prepare($check_sql);


    // Check if the statement was prepared successfully
    if (!$check_stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind product name
    $check_stmt->bind_param("s", $kname);


    // Execute the check query
    $check_stmt->execute();


    // Get the result
    $check_result = $check_stmt->get_result();


    // If the product already exists
    if ($check_result->num_rows > 0) {

        echo "<script>

                alert('Kitchen product already exists!');

                window.location.href = 'admin_kitchen.php';

              </script>";

        exit;
    }


    // Close the check statement
    $check_stmt->close();


    // Check if the image was uploaded successfully
    if ($_FILES['k_image']['error'] !== UPLOAD_ERR_OK) {

        die("Error uploading kitchen product image.");

    }


    // Get the original image name
    $original_name = $_FILES['k_image']['name'];


    // Get the temporary file name
    $tmp_name = $_FILES['k_image']['tmp_name'];


    // Get the image extension
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


    // Check if the image format is allowed
    if (!in_array($extension, $allowed_extensions)) {

        die("Invalid image format.");

    }


    // Maximum image size = 2 MB
    $max_size = 2 * 1024 * 1024;


    // Check image size
    if ($_FILES['k_image']['size'] > $max_size) {

        die("Kitchen product image must not exceed 2 MB.");

    }


    // Create a unique name for the image
    // Example: kitchen_68d123abc.jpeg
    $file_name = uniqid('kitchen_', true) . '.' . $extension;


    // Folder where kitchen images will be saved
    $upload_folder = '../Client/images/';


    // Create the full destination path
    $destination = $upload_folder . $file_name;


    // Move the uploaded image to Client/images
    if (!move_uploaded_file($tmp_name, $destination)) {

        die("Failed to upload kitchen product image.");

    }


    // Insert the kitchen product into the database
    $sql = "INSERT INTO kitchen
            (
                kname,
                price,
                k_image,
                description
            )
            VALUES (?, ?, ?, ?)";


    // Prepare the INSERT statement
    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if (!$stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind the product values
    // s = string
    // d = decimal / double
    $stmt->bind_param(
        "sdss",
        $kname,
        $price,
        $file_name,
        $description
    );


    // Execute the INSERT query
    if ($stmt->execute()) {

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <title>Product Added</title>


            <!-- Bootstrap Icons -->
            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
            >


            <!-- Bootstrap 5 -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                rel="stylesheet"
            >

        </head>


        <body>

            <!-- Success message container -->
            <div class="container mt-5">

                <!-- Green success alert -->
                <div
                    class="alert alert-success d-flex align-items-center"
                    role="alert"
                >

                    <!-- Success icon -->
                    <i
                        class="bi bi-check-circle-fill fs-3 me-3"
                    ></i>


                    <!-- Success message -->
                    <div>

                        <strong>
                            Kitchen product added successfully!
                        </strong>

                        <br>

                        Your product has been saved successfully.

                    </div>

                </div>

            </div>


            <?php

            // Redirect to Kitchen Admin page after 1 second
            echo "<script>

                    setTimeout(function() {

                        window.location.href = 'admin_kitchen.php';

                    }, 1000);

                  </script>";

            ?>

        </body>

        </html>

        <?php

    } else {

        // Show the error if INSERT failed
        echo "Error adding kitchen product: " . $stmt->error;

    }


    // Close the INSERT statement
    $stmt->close();

}

?>