
<?php

// Connect to HA Home Store database
include("../conn.php");
// Debug: Check data coming from the form
//var_dump($_POST);exit;

// Debug: Check uploaded image data
//var_dump($_FILES);exit;


// Check if all furniture product data and image were submitted
if (
    isset($_POST['fname']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    isset($_FILES['f_image'])
) {

    // Get product data from the form
    $fname = trim($_POST['fname']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];


    // Check product name
    if ($fname === '') {

        die("Furniture product name is required.");

    }


    // Check product description
    if ($description === '') {

        die("Furniture product description is required.");

    }


    // Check product price
    if ($price < 0) {

        die("Invalid furniture product price.");

    }


    // Check if the furniture product already exists
    $check_sql = "SELECT furniture_id FROM furniture WHERE fname = ?";

    $check_stmt = $conn->prepare($check_sql);


    // Check if the statement was prepared successfully
    if (!$check_stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind furniture name
    $check_stmt->bind_param("s", $fname);


    // Execute the check query
    $check_stmt->execute();


    // Get the result
    $check_result = $check_stmt->get_result();


    // If the furniture product already exists
    if ($check_result->num_rows > 0) {

        echo "<script>

                alert('Furniture product already exists!');

                window.location.href = 'admin_furniture.php';

              </script>";

        exit;
    }


    // Close the check statement
    $check_stmt->close();


    // Check if the image was uploaded successfully
    if ($_FILES['f_image']['error'] !== UPLOAD_ERR_OK) {

        die("Error uploading furniture product image.");

    }


    // Get the original image name
    $original_name = $_FILES['f_image']['name'];


    // Get the temporary file name
    $tmp_name = $_FILES['f_image']['tmp_name'];


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
    if ($_FILES['f_image']['size'] > $max_size) {

        die("Furniture product image must not exceed 2 MB.");

    }


    // Create a unique name for the image
    // Example: furniture_68d123abc.jpeg
    $file_name = uniqid('furniture_', true) . '.' . $extension;


    // Folder where furniture images will be saved
    $upload_folder = '../Client/images/';


    // Create the full destination path
    $destination = $upload_folder . $file_name;


    // Move the uploaded image to Client/images
    if (!move_uploaded_file($tmp_name, $destination)) {

        die("Failed to upload furniture product image.");

    }


    // Insert the furniture product into the database
    $sql = "INSERT INTO furniture
            (
                fname,
                price,
                f_image,
                description
            )
            VALUES (?, ?, ?, ?)";


    // Prepare the INSERT statement
    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if (!$stmt) {

        die("Prepare failed: " . $conn->error);

    }


    // Bind the furniture product values
    // s = string
    // d = decimal / double
    $stmt->bind_param(
        "sdss",
        $fname,
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

            <title>Furniture Product Added</title>


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
                            Furniture product added successfully!
                        </strong>

                        <br>

                        Your furniture product has been saved successfully.

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

        // Show the error if INSERT failed
        echo "Error adding furniture product: " . $stmt->error;

    }


    // Close the INSERT statement
    $stmt->close();

}

?>
