<?php

session_start();


// Connect to the database
// conn.php is one folder above the Client folder.
include("../conn.php");

// Get the latest product background
$sql_background = "SELECT background_image
                   FROM product_background
                   ORDER BY background_id DESC
                   LIMIT 1";

$result_background = $conn->query($sql_background);

if ($result_background && $result_background->num_rows > 0) {

    $background = $result_background->fetch_assoc();

    $background_image = $background['background_image'];

} else {

    // Default background
    $background_image = "bg.jpeg";
}

?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HA Home Store</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">

    <!-- Bootstrap JS -->
    <script src="bootstrap.js"></script>

    <!-- Your CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top">

        <div class="container">

            <a class="navbar-brand" href="index.php">
                HA
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav ms-auto">

                    <!-- Home -->
                    <li class="nav-item border-end">

                        <a class="nav-link" href="index.php">
                            Home
                            <i class="bi bi-house-heart-fill"></i>
                        </a>

                    </li>


                    <!-- Products -->
                    <li class="nav-item border-end">

                        <a class="nav-link active" href="products.php">
                            Products
                            <i class="bi bi-bag"></i>
                        </a>

                    </li>


                    <!-- About -->
                    <li class="nav-item border-end">

                        <a class="nav-link" href="about.php">
                            About
                            <i class="bi bi-info-circle"></i>
                        </a>

                    </li>


                    <!-- Contact -->
                    <li class="nav-item border-end">

                        <a class="nav-link" href="contact.php">
                            Contact
                            <i class="bi bi-envelope"></i>
                        </a>

                    </li>


                    <!-- Cart -->
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


    <!-- Products background -->
    <div class="products-background" 
    style="background-image: url('images/<?php echo htmlspecialchars($background_image); ?>');">


        <!-- Categories Buttons Container -->
        <div class="d-flex justify-content-center align-items-center gap-4 mt-5 pt-4 flex-wrap">

            <?php

            // Get all categories from the categories table
            $sql = "SELECT category_id, category_name
                    FROM categories
                    ORDER BY category_id ASC";

            // Execute the SQL query
            $result = $conn->query($sql);

            // Check if categories were found
            if ($result && $result->num_rows > 0) {

                // Loop through each category
                while ($category = $result->fetch_assoc()) {

                    // Check the category name
                    if ($category['category_name'] == 'Kitchen') {

                        $link = "kitchen.php";
                    } elseif ($category['category_name'] == 'Furniture') {

                        $link = "furniture.php";
                    } else {

                        $link = "category.php?id=" . $category['category_id'];
                    }

            ?>

                    <!-- Category Button -->
                    <a href="<?php echo $link; ?>"
                        class="btn btn-orange">

                        <?php echo htmlspecialchars($category['category_name']); ?>

                    </a>

            <?php

                }
            } else {

                echo "<p>No categories found.</p>";
            }

            ?>

        </div>

        
        <!-- Cart Order Modal -->
       

    </div>



     <div class="modal fade"
            id="cartorderModal"
            tabindex="-1"
            aria-labelledby="cartorderModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">
                <form action="save_order.php" method="POST">
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
                                    name="name"
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

                        </div>


                        <!-- Modal Footer -->
                        <div class="modal-footer">

                            <!-- Close Button -->
                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Close

                            </button>


                            <!-- Place Order Button -->
                            <button type="button"
                                class="btn btn-warning text-dark fw-bold"
                                onclick="alert('BUTTON WORKS'); return false;">

                                <i class="bi bi-check-circle"></i>

                                Place Order

                            </button>

                        </div>

                </form>

            </div>

        </div>






    <!-- Footer -->
    <footer class="bg-secondary text-dark w-100 fixed-bottom">

        <div class="container-fluid text-center py-3">

            <!-- Copyright -->
            <p class="text-dark mb-0">

                &copy;
                <span id="currentYear"></span>

                HA Home Store.
                All rights reserved.

            </p>


            <!-- Current Date -->
            <i class="bi bi-calendar3"></i>

            <span id="footerdate"></span>

            <span class="mx-2">|</span>


            <!-- Current Time -->
            <i class="bi bi-clock"></i>

            <span id="footertime"></span>

        </div>

    </footer>


    <!-- JavaScript for date and time -->
    <script>
        function updateDateTime() {

            const now = new Date();

            // Display current date
            document.getElementById("footerdate").textContent =
                now.toLocaleDateString();

            // Display current time
            document.getElementById("footertime").textContent =
                now.toLocaleTimeString();

        }

        // Run the function when the page loads
        updateDateTime();

        // Update the time every second
        setInterval(updateDateTime, 1000);

        // Display the current year automatically
        document.getElementById("currentYear").textContent =
            new Date().getFullYear();
    </script>


</body>

</html>