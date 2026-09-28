<?php

// Connect to HA Home Store database
include("../conn.php");


// Check if the form data was submitted
if (
    isset($_POST['kitchen_id']) &&
    isset($_POST['kname']) &&
    isset($_POST['price']) &&
    isset($_POST['description'])
) {

    // Get product data from the form
    $kitchen_id = (int) $_POST['kitchen_id'];
    $kname = trim($_POST['kname']);
    $price = (float) $_POST['price'];
    $description = trim($_POST['description']);


    // Check product ID
    if ($kitchen_id <= 0) {

        die("Invalid kitchen product ID.");

    }


    // Check product name
    if ($kname === '') {

        die("Product name is required.");

    }


    // Check product price
    if ($price < 0) {

        die("Invalid product price.");

    }


    // Check product description
    if ($description === '') {

        die("Product description is required.");

    }


    // Get the current product information
    $select_sql = "SELECT k_image FROM kitchen WHERE kitchen_id = ?";

    $select_stmt = $conn->prepare($select_sql);


    // Check if the statement was prepared successfully
    if (!$select_stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind product ID
    $select_stmt->bind_param("i", $kitchen_id);


    // Execute the query
    $select_stmt->execute();


    // Get the result
    $select_result = $select_stmt->get_result();


    // Check if the product exists
    if ($select_result->num_rows == 0) {

        die("Kitchen product not found.");

    }


    // Get the current image name
    $current_product = $select_result->fetch_assoc();

    $current_image = $current_product['k_image'];


    // Close the statement
    $select_stmt->close();


    /*
        Check if the user selected a new image.

        If no new image was selected,
        the old image will stay unchanged.
    */

    $new_image = $current_image;


    if (
        isset($_FILES['k_image']) &&
        $_FILES['k_image']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        // Check if the image uploaded successfully
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


        // Check image format
        if (!in_array($extension, $allowed_extensions)) {

            die("Invalid image format.");

        }


        // Maximum image size = 2 MB
        $max_size = 2 * 1024 * 1024;


        // Check image size
        if ($_FILES['k_image']['size'] > $max_size) {

            die("Kitchen product image must not exceed 2 MB.");

        }


        // Create a unique name for the new image
        $new_image = uniqid('kitchen_', true) . '.' . $extension;


        // Kitchen images folder
        $upload_folder = '../Client/images/';


        // Create the full destination path
        $destination = $upload_folder . $new_image;


        // Move the new image to Client/images
        if (!move_uploaded_file($tmp_name, $destination)) {

            die("Failed to upload new kitchen product image.");

        }


        // Delete the old image if it exists
        if (
            $current_image !== '' &&
            file_exists($upload_folder . $current_image)
        ) {

            unlink($upload_folder . $current_image);

        }

    }


    // Update the kitchen product
    $sql = "UPDATE kitchen
            SET
                kname = ?,
                price = ?,
                k_image = ?,
                description = ?
            WHERE kitchen_id = ?";


    // Prepare the UPDATE statement
    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if (!$stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind the updated values
    // s = string
    // d = decimal / double
    // i = integer
    $stmt->bind_param(
        "sdssi",
        $kname,
        $price,
        $new_image,
        $description,
        $kitchen_id
    );


    // Execute the UPDATE query
    if ($stmt->execute()) {

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <title>Product Updated</title>

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

            <!-- Success message -->
            <div class="container mt-5">

                <div
                    class="alert alert-success d-flex align-items-center"
                    role="alert"
                >

                    <!-- Success icon -->
                    <i class="bi bi-check-circle-fill fs-3 me-3"></i>


                    <!-- Success text -->
                    <div>

                        <strong>
                            Kitchen product updated successfully!
                        </strong>

                        <br>

                        Your changes have been saved successfully.

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

        // Display the error if UPDATE failed
        echo "Error updating kitchen product: " . $stmt->error;

    }


    // Close the UPDATE statement
    $stmt->close();

}

?>