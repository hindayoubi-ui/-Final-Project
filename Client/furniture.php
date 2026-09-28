<?php

// Connect to the database
// conn.php is one folder above the Client folder.
include "../conn.php";

// Get furniture products from database
$sql = "SELECT * FROM furniture";
$result = $conn->query($sql);

// Check if query worked
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Get Furniture page information
$page_sql = "SELECT * FROM furniture_page";
$page_result = $conn->query($page_sql);

// Check if page query worked
if (!$page_result) {
    die("Page query failed: " . $conn->error);
}

// Get the page title and welcome text
$page = $page_result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Furniture - HA Home Store</title>

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

                            Cart
                            <i class="bi bi-cart"></i>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>



    <!-- Furniture Background -->
    <div class="furniture-background">


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

                        Furniture

                    </li>

                </ol>

            </nav>

        </div>



        <!-- Furniture Section -->
        <section class="py-5">

            <div class="container">


                <!-- Furniture page title and welcome text -->
                <div class="text-center mb-5">

                    <h2 class="fw-bold text-dark">

                        <?php echo $page['title']; ?>

                        <i class="bi bi-house fs-2"></i>

                    </h2>


                    <p class="text-muted fst-italic fs-2">

                        "<?php echo $page['welcome_text']; ?>"

                    </p>

                </div>



                <!-- Furniture Products -->
                <div class="row g-4">


                    <?php

                    // Repeat the card for each furniture product
                    while ($row = $result->fetch_assoc()) {

                    ?>


                        <!-- Furniture Product Card -->
                        <div class="col-md-6 col-lg-4">

                            <div class="card h-100 border-0 shadow-sm">


                                <!-- Display product image -->
                                <img src="images/<?php echo $row['f_image']; ?>"
                                    class="card-img-top"
                                    alt="<?php echo $row['fname']; ?>">


                                <div class="card-body">


                                    <!-- Product name and price -->
                                    <div class="d-flex justify-content-between align-items-center">


                                        <!-- Product name -->
                                        <h5 class="card-title fw-bold mb-0">

                                            <?php echo $row['fname']; ?>

                                        </h5>


                                        <!-- Product price -->
                                        <span class="badge bg-warning text-dark">

                                            $<?php echo $row['price']; ?>

                                        </span>


                                    </div>


                                    <!-- Product description -->
                                    <p class="card-text text-muted mt-2">

                                        <?php echo $row['description']; ?>

                                    </p>


                                    <!-- Open Cart Order Modal -->
                                    <a href="#"
                                        class="btn btn-outline-dark btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cartorderModal">

                                        View Details

                                    </a>


                                </div>

                            </div>

                        </div>


                    <?php

                    // End of while loop
                    }

                    ?>


                </div>

            </div>

        </section>

    </div>



    <!-- Footer -->
    <footer class="bg-secondary text-dark w-100">

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



    <!-- Date & Time JavaScript -->
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


                <!-- Modal Header -->
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



                <!-- Modal Body -->
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



                <!-- Modal Footer -->
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