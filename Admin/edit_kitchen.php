<?php

// Connect to HA Home Store database
include("../conn.php");


// Get the kitchen product ID from the URL
$kitchen_id = $_GET['id'];


// Get the kitchen product from the database
$sql = "SELECT * FROM kitchen WHERE kitchen_id = ?";

$stmt = $conn->prepare($sql);


// Check if the statement was prepared successfully
if (!$stmt) {

    die("Prepare failed: " . $conn->error);

}


// Bind the product ID
$stmt->bind_param("i", $kitchen_id);


// Execute the query
$stmt->execute();


// Get the result
$result = $stmt->get_result();


// Check if the product exists
if ($result->num_rows == 0) {

    die("Kitchen product not found.");

}


// Get the product data
$product = $result->fetch_assoc();


// Close the statement
$stmt->close();

?>

<!-- Head -->
<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

    <div class="container-scroller">

        <!-- Navbar -->
        <?php include(__DIR__ . "/template/common/navbar.php"); ?>
        <!-- End Navbar -->


        <div class="container-fluid page-body-wrapper">

            <!-- Sidebar -->
            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>
            <!-- End Sidebar -->


            <!-- Main Panel -->
            <div class="main-panel">

                <!-- Content Wrapper -->
                <div class="content-wrapper">

                    <!-- Edit Kitchen Product Content -->
                    <div class="container-fluid">

                        <!-- Page Title -->
                        <h3 class="page-title mb-4">
                            Edit Kitchen Product
                        </h3>


                        <!-- Edit Product Card -->
                        <div class="card">

                            <div class="card-body">

                                <!-- Card Title -->
                                <h4 class="card-title">
                                    Update Kitchen Product Information
                                </h4>


                                <!--
                                    Product edit form.

                                    enctype="multipart/form-data"
                                    is required because we allow
                                    the user to upload a new image.
                                -->
                                <form
                                    method="POST"
                                    action="update_kitchen.php"
                                    enctype="multipart/form-data"
                                >


                                    <!--
                                        Hidden Product ID

                                        We keep the product ID hidden
                                        so update_kitchen.php knows
                                        which product to update.
                                    -->
                                    <input
                                        type="hidden"
                                        name="kitchen_id"
                                        value="<?php echo $product['kitchen_id']; ?>"
                                    >


                                    <!-- Product Name -->
                                    <div class="form-group">

                                        <label>
                                            Product Name
                                        </label>

                                        <input
                                            type="text"
                                            name="kname"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($product['kname']); ?>"
                                            required
                                        >

                                    </div>


                                    <!-- Product Price -->
                                    <div class="form-group">

                                        <label>
                                            Price
                                        </label>

                                        <input
                                            type="number"
                                            name="price"
                                            class="form-control"
                                            step="0.01"
                                            value="<?php echo $product['price']; ?>"
                                            required
                                        >

                                    </div>


                                    <!-- Current Product Image -->
                                    <div class="form-group">

                                        <label>
                                            Current Product Image
                                        </label>

                                        <br>

                                        <!--
                                            Display the current image
                                            saved in the database.
                                        -->
                                        <img
                                            src="../Client/images/<?php echo $product['k_image']; ?>"
                                            alt="<?php echo htmlspecialchars($product['kname']); ?>"
                                            width="150"
                                            height="150"
                                            style="
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                    </div>


                                    <!-- New Product Image -->
                                    <div class="form-group">

                                        <label>
                                            Change Product Image
                                        </label>

                                        <!--
                                            The user can choose a new image.

                                            This field is NOT required
                                            because the user may want
                                            to keep the current image.
                                        -->
                                        <input
                                            type="file"
                                            name="k_image"
                                            class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp"
                                        >

                                    </div>


                                    <!-- Product Description -->
                                    <div class="form-group">

                                        <label>
                                            Description
                                        </label>

                                        <textarea
                                            name="description"
                                            class="form-control"
                                            rows="4"
                                            required
                                        ><?php echo htmlspecialchars($product['description']); ?></textarea>

                                    </div>


                                    <!-- Update Product Button -->
                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <!-- Save icon -->
                                        <i class="mdi mdi-content-save"></i>

                                        <!-- Button text -->
                                        Update Product

                                    </button>


                                    <!-- Cancel Button -->
                                    <a
                                        href="admin_kitchen.php"
                                        class="btn btn-light"
                                    >

                                        Cancel

                                    </a>


                                </form>

                            </div>

                        </div>

                    </div>
                    <!-- End Edit Kitchen Product Content -->

                </div>
                <!-- End Content Wrapper -->


                <!-- Footer -->
                <?php include(__DIR__ . "/template/common/footer.php"); ?>
                <!-- End Footer -->

            </div>
            <!-- End Main Panel -->

        </div>
        <!-- End Page Body Wrapper -->

    </div>
    <!-- End Container Scroller -->


    <!-- Scripts -->
    <?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>