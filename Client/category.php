<?php

// Connect to the database
include("../conn.php");

// Get category ID from URL
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


// Get category information
$sql_category = "SELECT category_id, category_name
                 FROM categories
                 WHERE category_id = ?";

$stmt_category = $conn->prepare($sql_category);
$stmt_category->bind_param("i", $category_id);
$stmt_category->execute();

$category_result = $stmt_category->get_result();
$category = $category_result->fetch_assoc();


// If category does not exist
if (!$category) {
    die("Category not found.");
}


// Get products for this category
$sql_products = "SELECT *
                 FROM products
                 WHERE category_id = ?
                 ORDER BY product_id ASC";

$stmt_products = $conn->prepare($sql_products);
$stmt_products->bind_param("i", $category_id);
$stmt_products->execute();

$products = $stmt_products->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($category['category_name']); ?>
        - HA Home Store
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap JS -->
    <script src="bootstrap.js"></script>

</head>


<body>


    <!-- Navbar -->

    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top">

        <div class="container">

            <a class="navbar-brand" href="index.php">
                HA Home Store
            </a>


            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>


            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">

                        <a class="nav-link" href="index.php">
                            Home
                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link active" href="products.php">
                            Products
                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link" href="about.php">
                            About
                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link" href="contact.php">
                            Contact
                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link" href="cart.php">

                            <i class="bi bi-cart"></i>

                            Cart

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>



    <!-- Category Background -->

    <div class="kitchen-background">


        <!-- Breadcrumb -->

        <div class="container mt-5 pt-5">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item">

                        <a href="products.php">
                            Products
                        </a>

                    </li>


                    <li class="breadcrumb-item active"
                        aria-current="page">

                        <?php echo htmlspecialchars($category['category_name']); ?>

                    </li>

                </ol>

            </nav>

        </div>



        <!-- Category Products Section -->

        <section class="py-5">

            <div class="container">


                <!-- Category Title -->

                <div class="text-center mb-5">

                    <h2 class="fw-bold text-dark">

                        <?php echo htmlspecialchars($category['category_name']); ?>
                        Products

                    </h2>


                    <p class="text-muted fst-italic fs-2">

                        "Welcome to our
                        <?php echo htmlspecialchars($category['category_name']); ?>
                        products."

                    </p>

                </div>



                <!-- Products -->

              <!-- Products -->
<div class="row g-4">

    <?php if ($products->num_rows > 0) { ?>

        <?php while ($product = $products->fetch_assoc()) { ?>

            <!-- Product Card -->
            <div class="col-md-4 mb-4">

                <div class="card h-100">

                    <!-- Product Image -->
                    <?php if (!empty($product['products_image'])) { ?>

                        <img
                         src="../Admin/uploads/products/<?php echo htmlspecialchars($product['products_image']); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($product['product_name']); ?>">

                    <?php } ?>

                    <div class="card-body">

                        <!-- Product Name -->
                        <h5 class="card-title fw-bold">

                            <?php echo htmlspecialchars($product['product_name']); ?>

                        </h5>

                        <!-- Product Price -->
                        <p class="card-text">

                            <strong>
                                $<?php echo htmlspecialchars($product['price']); ?>
                            </strong>

                        </p>

                        <!-- Product Description -->
                        <p class="card-text">

                            <?php echo htmlspecialchars($product['description']); ?>

                        </p>

                        <!-- View Details Button -->
                        <a href="#"
                           class="btn btn-warning text-dark fw-bold"
                           data-bs-toggle="modal"
                           data-bs-target="#cartorderModal">

                            View Details

                        </a>

                    </div>

                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <!-- No Products -->
        <div class="col-12 text-center">

            <p class="text-dark fs-4">
                No products found in this category.
            </p>

        </div>

    <?php } ?>

</div>


    </div>



    <!-- Footer -->

    <footer class="bg-secondary text-dark w-100 fixed-bottom">

        <div class="container-fluid text-center py-3">


            <p class="text-dark mb-0">

                &copy; 2026 HA Home Store.
                All rights reserved.

            </p>


            <i class="bi bi-calendar3"></i>

            <span id="footerdate"></span>


            <span class="mx-2">|</span>


            <i class="bi bi-clock"></i>

            <span id="footertime"></span>


        </div>

    </footer>



    <!-- Date and Time -->

    <script>
        function updateDateTime() {

            const now = new Date();

            document.getElementById("footerdate").textContent =
                now.toLocaleDateString();

            document.getElementById("footertime").textContent =
                now.toLocaleTimeString();

        }

        updateDateTime();

        setInterval(updateDateTime, 1000);
    </script>



    <!-- Cart Order Modal -->

    <div class="modal fade"
        id="cartorderModal"
        tabindex="-1"
        aria-labelledby="cartorderModalLabel"
        aria-hidden="true">


        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">


                <!-- Header -->

                <div class="modal-header">

                    <h1 class="modal-title fs-5"
                        id="cartorderModalLabel">

                        Cart
                        <i class="bi bi-cart"></i>

                    </h1>


                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                    </button>

                </div>



                <!-- Body -->

                <div class="modal-body">

                    <form>


                        <!-- Name -->

                        <div class="mb-3">

                            <label for="customerName"
                                class="form-label">

                                <i class="bi bi-person"></i>
                                Name

                            </label>


                            <input type="text"
                                class="form-control"
                                id="customerName"
                                name="fname"
                                placeholder="Enter your name"
                                required>

                        </div>



                        <!-- Location -->

                        <div class="mb-3">

                            <label for="location"
                                class="form-label">

                                <i class="bi bi-geo-alt"></i>
                                Location

                            </label>


                            <input type="text"
                                class="form-control"
                                id="location"
                                name="location"
                                placeholder="Enter your address"
                                required>

                        </div>



                        <!-- Date -->

                        <div class="mb-3">

                            <label for="orderDate"
                                class="form-label">

                                <i class="bi bi-calendar"></i>
                                Date

                            </label>


                            <input type="date"
                                class="form-control"
                                id="orderDate"
                                name="date"
                                required>

                        </div>



                        <!-- Time -->

                        <div class="mb-3">

                            <label for="orderTime"
                                class="form-label">

                                <i class="bi bi-clock"></i>
                                Time

                            </label>


                            <input type="time"
                                class="form-control"
                                id="orderTime"
                                name="time"
                                required>

                        </div>



                        <!-- Quantity -->

                        <div class="mb-3">

                            <label for="quantity"
                                class="form-label">

                                <i class="bi bi-123"></i>
                                Quantity

                            </label>


                            <input type="number"
                                class="form-control"
                                id="quantity"
                                name="quantity"
                                min="1"
                                placeholder="Choose quantity"
                                required>

                        </div>



                       


                    </form>

                </div>



                <!-- Footer -->

                <div class="modal-footer">


                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>


                    <button type="button"
                        class="btn btn-warning text-dark fw-bold">

                        <i class="bi bi-check-circle"></i>

                        Place Order

                    </button>

                </div>

            </div>
        </div>
    </div>

</body>

</html>