
<?php

// Connect to HA Home Store database
include("../conn.php");


// Check if the furniture product data was submitted
if (
    isset($_POST['furniture_id']) &&
    isset($_POST['fname']) &&
    isset($_POST['description']) &&
    isset($_POST['price'])
) {

    // Get the furniture product data
    $furniture_id = (int) $_POST['furniture_id'];
    $fname = trim($_POST['fname']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];


    // Check furniture product name
    if ($fname === '') {
        die("Furniture product name is required.");
    }


    // Check furniture product description
    if ($description === '') {
        die("Furniture product description is required.");
    }


    // Check furniture product price
    if ($price < 0) {
        die("Invalid furniture product price.");
    }


    /*
        First, get the current furniture product
        from the database.

        We need the current image name because
        the user may NOT upload a new image.
    */

    $sql = "SELECT * FROM furniture WHERE furniture_id = ?";

    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind furniture ID
    $stmt->bind_param("i", $furniture_id);


    // Execute the query
    $stmt->execute();


    // Get the result
    $result = $stmt->get_result();


    // Check if furniture product exists
    if ($result->num_rows == 0) {
        die("Furniture product not found.");
    }


    // Get current furniture product data
    $product = $result->fetch_assoc();


    // Current image name
    $file_name = $product['f_image'];


    // Close the statement
    $stmt->close();


    /*
        Check if the user uploaded a new image.

        If no new image was uploaded,
        we keep the current image.
    */

    if (
        isset($_FILES['f_image']) &&
        $_FILES['f_image']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        // Check upload error
        if ($_FILES['f_image']['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading furniture product image.");
        }


        // Get original image name
        $original_name = $_FILES['f_image']['name'];


        // Get temporary file name
        $tmp_name = $_FILES['f_image']['tmp_name'];


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
        if ($_FILES['f_image']['size'] > $max_size) {
            die("Furniture product image must not exceed 2 MB.");
        }


        /*
            Create a new unique image name.

            Example:
            furniture_68d123abc.jpeg
        */
        $new_file_name = uniqid('furniture_', true) . '.' . $extension;


        // Folder where images are saved
        $upload_folder = '../Client/images/';


        // Full destination path
        $destination = $upload_folder . $new_file_name;


        // Move new image to Client/images
        if (!move_uploaded_file($tmp_name, $destination)) {
            die("Failed to upload furniture product image.");
        }


        /*
            Delete the old image from Client/images
            after the new image was uploaded successfully.
        */

        if (
            !empty($file_name) &&
            file_exists($upload_folder . $file_name)
        ) {

            unlink($upload_folder . $file_name);
        }


        // Use the new image name for the database
        $file_name = $new_file_name;
    }


    /*
        Update the furniture product
        in the database.
    */

    $sql = "UPDATE furniture
            SET
                fname = ?,
                price = ?,
                f_image = ?,
                description = ?
            WHERE furniture_id = ?";


    // Prepare the UPDATE statement
    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    /*
        Bind the values:

        s = string
        d = decimal/double
        i = integer
    */

    $stmt->bind_param(
        "sdssi",
        $fname,
        $price,
        $file_name,
        $description,
        $furniture_id
    );


    // Execute the UPDATE query
    if ($stmt->execute()) {

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <title>
                Furniture Product Updated
            </title>

            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
            >

            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                rel="stylesheet"
            >

        </head>


        <body>

            <div class="container mt-5">

                <div
                    class="alert alert-success d-flex align-items-center"
                    role="alert"
                >

                    <i class="bi bi-check-circle-fill fs-3 me-3"></i>

                    <div>

                        <strong>
                            Furniture product updated successfully!
                        </strong>

                        <br>

                        Your furniture product has been updated successfully.

                    </div>

                </div>

            </div>


            <?php

            // Redirect to Furniture Admin page after 1 second
            echo "<script>

                    setTimeout(function() {

                        window.location.href = 'admin_furniture.php';

                    }, 1000);

                  </script>";

            ?>

        </body>

        </html>

        <?php

    } else {

        // Show the error if UPDATE failed
        echo "Error updating furniture product: " . $stmt->error;

    }


    // Close the UPDATE statement
    $stmt->close();

}

?>

