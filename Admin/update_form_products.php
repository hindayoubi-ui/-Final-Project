<?php


// Connect to the database

// We include conn.php because it contains the connection
// between PHP and our MySQL database "ha_homestore".
include("../conn.php");



// Get the product ID from the URL

// When we click the Edit button in products.php,
// the URL contains the product_id.
//
// Example:
// update_form_products.php?product_id=1
//
// $_GET['product_id'] gets the ID from the URL.
$product_id = $_GET['product_id'];


// Get the selected product from the database

// We use the product_id to find the exact product
// that we want to edit.
$sql = "SELECT * FROM products WHERE product_id = $product_id";

$result = $conn->query($sql);


// Convert the database result into an array
$product = $result->fetch_assoc();


// Get all categories from the database
$categories_sql = "SELECT category_id, category_name
                   FROM categories
                   ORDER BY category_name ASC";

$categories_result = $conn->query($categories_sql);

if (!$categories_result) {
    die("Error getting categories: " . $conn->error);
}

$categories = $categories_result->fetch_all(MYSQLI_ASSOC);

?>

<!-- Include the Admin Dashboard Head -->
<?php include(__DIR__ . "/template/common/head.php"); ?>


<body>

    <!-- Main Container -->
    <div class="container-scroller">


        <!-- Include Navbar -->
        <?php include(__DIR__ . "/template/common/navbar.php"); ?>


        <!-- Page Body Wrapper -->
        <div class="container-fluid page-body-wrapper">


            <!-- Include Sidebar -->
            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>


            <!-- Main Panel -->
            <div class="main-panel">


                <!-- Content Wrapper -->
                <div class="content-wrapper">


                    <!-- Page Header -->
                    <div class="page-header">

                        <h3 class="page-title">

                            <!-- Page icon -->
                            <span class="page-title-icon bg-gradient-primary text-white me-2">

                                <i class="mdi mdi-pencil"></i>

                            </span>

                            Update Product

                        </h3>

                    </div>


                    <!-- Update Product Form -->

                    <div class="row">

                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">
                                        Update Product
                                    </h4>


                                    <!--
                                    The form sends the updated product
                                    information to update_products.php
                                    using the POST method.
                                    -->

                                    <form action="update_products.php" method="POST" enctype="multipart/form-data">


                                        <!-- Hidden Product ID -->

                                        <!--
                                        We keep the product ID hidden because
                                        we need it to know which product
                                        should be updated.

                                        The user does not need to see or edit it.
                                        -->

                                        <input type="hidden"
                                            name="product_id"
                                            value="<?php echo $product['product_id']; ?>">


                                        <!-- Product Name -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Product Name
                                            </label>


                                            <!--
                                            The existing product name is
                                            automatically displayed inside
                                            the input field.
                                            -->

                                            <input type="text"
                                                class="form-control"
                                                name="product_name"
                                                value="<?php echo htmlspecialchars($product['product_name']); ?>"
                                                required>

                                        </div>


                                        <!-- Description -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Description
                                            </label>


                                            <!--
                                            The existing description is
                                            automatically displayed inside
                                            the textarea.
                                            -->

                                            <textarea
                                                class="form-control"
                                                name="description"
                                                required><?php echo htmlspecialchars($product['description']); ?></textarea>

                                        </div>


                                        <!-- Price -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Price
                                            </label>


                                            <!--
                                            The existing price is displayed
                                            so the user can modify it.
                                            -->

                                            <input type="number"
                                                class="form-control"
                                                name="price"
                                                value="<?php echo htmlspecialchars($product['price']); ?>"
                                                step="0.01"
                                                required>

                                        </div>

                                        <!-- Product Image -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Product Image
                                            </label>

                                            <input type="file"
                                                class="form-control"
                                                name="products_image"
                                                accept="image/*">

                                        </div>


                                        <!-- Category -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Category
                                            </label>

                                            <select class="form-control" name="category_id" required>

                                                <option value=""> Select Category </option>


                                                <?php foreach ($categories as $c) { ?>

                                                    <option
                                                        value="<?php echo $c['category_id']; ?>"
                                                        <?php if ($c['category_id'] == $product['category_id']) echo 'selected'; ?>>

                                                        <?php echo htmlspecialchars($c['category_name']); ?>

                                                    </option>

                                                <?php } ?>

                                            </select>

                                            <!-- Current product image -->
                                            <?php if (!empty($product['products_image'])) { ?>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Current Image
                                                    </label>

                                                    <br>

                                                    <img
                                                        src="uploads/products/<?php echo htmlspecialchars($product['products_image']); ?>"
                                                        alt="Product Image"
                                                        style="width: 150px; height: 150px; object-fit: cover;">

                                                </div>

                                            <?php } ?>


                                            <!-- Choose new image -->
                                            <div class="mb-3">

                                                <label class="form-label"> Change Product Image </label>

                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    name="products_image"
                                                    accept="image/*">

                                            </div>

                                        </div>


                                        <!-- Update Button -->

                                        <!--
                                        When the user clicks this button,
                                        the form sends the information to
                                        update_products.php.
                                        -->

                                        <button type="submit"
                                            class="btn btn-primary">

                                            Update Product

                                        </button>


                                        <!-- Cancel Button -->

                                        <!--
                                        The Cancel button does not update
                                        anything.

                                        It simply takes the user back to
                                        products.php.
                                        -->

                                        <a href="products.php"
                                            class="btn btn-light">

                                            Cancel

                                        </a>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- End Content Wrapper -->


                <!-- Footer -->

                <?php include(__DIR__ . "/template/common/footer.php"); ?>

            </div>
            <!-- End Main Panel -->


        </div>
        <!-- End Page Body Wrapper -->


    </div>
    <!-- End Main Container -->


    <!-- JavaScript Files -->

    <?php include(__DIR__ . "/template/common/script.php"); ?>


</body>

</html>