```php
<?php

// Connect to database
include("../conn.php");

// Get all products from database
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

// Check if query worked
if (!$result) {
    die("Error getting products: " . $conn->error);
}

// Convert result to array
$products = $result->fetch_all(MYSQLI_ASSOC);


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

<?php include(__DIR__ . "/template/common/head.php"); ?>

<body>

    <!-- Container Scroller Start -->
    <div class="container-scroller">


        <!-- Navbar Start -->
        <?php include(__DIR__ . "/template/common/navbar.php"); ?>
        <!-- Navbar End -->


        <!-- Page Body Wrapper Start -->
        <div class="container-fluid page-body-wrapper">


            <!-- Sidebar Start -->
            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>
            <!-- Sidebar End -->


            <!-- Main Panel Start -->
            <div class="main-panel">


                <!-- Content Wrapper Start -->
                <div class="content-wrapper">


                    <!-- Page Header Start -->
                    <div class="page-header">

                        <h3 class="page-title">

                            <span class="page-title-icon bg-gradient-primary text-white me-2">

                                <i class="mdi mdi-package-variant"></i>

                            </span>

                            Products

                        </h3>

                        <nav aria-label="breadcrumb">

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">

                                    Products

                                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>

                                </li>

                            </ul>

                        </nav>

                    </div>
                    <!-- Page Header End -->


                    <!-- Add Product Button Start -->
                    <div class="row">

                        <div class="col-12">

                            <div class="d-flex justify-content-end mb-3">

                                <button type="button"
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addProductModal">

                                    Add Product

                                </button>

                            </div>

                        </div>

                    </div>
                    <!-- Add Product Button End -->


                    <!-- Products Table Start -->
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">
                                        Products List
                                    </h4>


                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered table-hover">

                                            <thead>

                                                <tr>

                                                    <th>
                                                        Product Name
                                                    </th>

                                                    <th>
                                                        Product Image
                                                    </th>

                                                    <th>
                                                        Description
                                                    </th>

                                                    <th>
                                                        Price
                                                    </th>

                                                    <th>
                                                        Category ID
                                                    </th>

                                                    <th>
                                                        Created At
                                                    </th>

                                                    <th>
                                                        Actions
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                <?php

                                                // Loop through products
                                                foreach ($products as $p) {

                                                ?>

                                                    <tr>

                                                        <!-- Product Name -->
                                                        <td>
                                                            <?php echo htmlspecialchars($p['product_name']); ?>
                                                        </td>


                                                        <!-- Product Image -->
                                                        <td>

                                                            <img src="uploads/products/<?php echo htmlspecialchars($p['products_image']); ?>"
                                                                alt="Product Image"
                                                                style="width: 80px; height: 80px; object-fit: cover;">

                                                        </td>


                                                        <!-- Description -->
                                                        <td>
                                                            <?php echo htmlspecialchars($p['description']); ?>
                                                        </td>


                                                        <!-- Price -->
                                                        <td>
                                                            <?php echo htmlspecialchars($p['price']); ?>
                                                        </td>


                                                        <!-- Category ID -->
                                                        <td>
                                                            <?php echo htmlspecialchars($p['category_id']); ?>
                                                        </td>


                                                        <!-- Created At -->
                                                        <td>
                                                            <?php echo htmlspecialchars($p['created_at']); ?>
                                                        </td>


                                                        <!-- Actions -->
                                                        <td>

                                                            <!-- Edit Button -->
                                                            <a href="update_form_products.php?product_id=<?php echo $p['product_id']; ?>"
                                                                class="btn btn-sm btn-outline-success" title="Edit">
                                                                  <i class="bi bi-pencil"></i>

                                                                Edit

                                                            </a>


                                                            <!-- Delete Button -->
                                                            <a href="delete_products.php?product_id=<?php echo $p['product_id']; ?>"
                                                                class="btn btn-sm btn-outline-danger" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete it?');"> 
                                                                 <i class="bi bi-trash"></i>
                                                                Delete
                                                            </a>
                                                        </td>

                                                    </tr>

                                                <?php

                                                }

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Products Table End -->


                </div>
                <!-- Content Wrapper End -->


                <!-- Footer Start -->
                <?php include(__DIR__ . "/template/common/footer.php"); ?>
                <!-- Footer End -->


            </div>
            <!-- Main Panel End -->


        </div>
        <!-- Page Body Wrapper End -->


    </div>
    <!-- Container Scroller End -->


    <!-- Add Product Modal Start -->
    <div class="modal fade"
        id="addProductModal"
        tabindex="-1"
        aria-labelledby="addProductModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->
                <div class="modal-header">

                    <h5 class="modal-title"
                        id="addProductModalLabel">

                        Add Product

                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                    </button>

                </div>


                <!-- Modal Body -->
                <div class="modal-body">


                    <!-- Product Form -->
                    <form action="insert_products.php"
                        method="POST"
                        enctype="multipart/form-data">


                        <!-- Product Name -->
                        <div class="mb-3">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input type="text"
                                class="form-control"
                                name="product_name"
                                placeholder="Enter Product Name"
                                required
                                autocomplete="off">

                        </div>


                        <!-- Description -->
                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea class="form-control"
                                name="description"
                                placeholder="Enter Description"
                                required></textarea>

                        </div>


                        <!-- Price -->
                        <div class="mb-3">

                            <label class="form-label">
                                Price
                            </label>

                            <input type="number"
                                class="form-control"
                                name="price"
                                placeholder="Enter Price"
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
                                accept="image/*"
                                required>

                        </div>


                        <!-- Category -->
                        <div class="mb-3">

                            <label class="form-label">
                                Category
                            </label>

                            <select class="form-control"
                                name="category_id"
                                required>

                                <option value="">
                                    Select Category
                                </option>

                                <?php foreach ($categories as $c) { ?>

                                    <option value="<?php echo $c['category_id']; ?>">

                                        <?php echo htmlspecialchars($c['category_name']); ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>


                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn btn-primary float-end">

                            Submit

                        </button>


                    </form>

                </div>

            </div>

        </div>

    </div>
    <!-- Add Product Modal End -->


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php include(__DIR__ . "/template/common/script.php"); ?>


</body>

</html>
```