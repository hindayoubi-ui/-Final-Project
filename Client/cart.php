<?php

include("../conn.php");

$sql = "SELECT * FROM cart ORDER BY cart_id DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart - HA Home Store</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

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


                    <!-- Home -->
                    <li class="nav-item border-end">

                        <a class="nav-link" href="index.php">

                            Home

                            <i class="bi bi-house-heart-fill"></i>

                        </a>

                    </li>


                    <!-- Products -->
                    <li class="nav-item border-end">

                        <a class="nav-link" href="products.php">

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

                        <a class="nav-link active" href="cart.php">

                            Cart

                            <i class="bi bi-cart"></i>

                        </a>

                    </li>


                </ul>

            </div>

        </div>

    </nav>



    <!-- Cart -->
    <section class="container mt-5 pt-5">


        <!-- Cart Title -->
        <div class="text-center mb-4">

            <h2 class="fw-bold">

                Your Cart

                <i class="bi bi-cart3"></i>

            </h2>


            <p class="text-muted fst-italic">

                Make sure your selected items are correct before ordering.

            </p>

        </div>



        <!-- Cart Table -->
        <div class="table-responsive">

            <table class="table table-bordered text-center align-middle">


                <thead class="table-secondary">

                    <tr>

                        <th>Product</th>

                        <th>Price</th>

                        <th>Quantity</th>

                        <th>Total</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>


                    <!-- Example Product -->
                    <?php

                    $total = 0;

                    while ($row = $result->fetch_assoc()) {

                        $item_total = $row['price'] * $row['quantity'];

                        $total += $item_total;

                    ?>

                        <tr>

                            <!-- Product -->
                            <td>

                                <img src="images/<?php echo $row['image']; ?>"
                                    width="70"
                                    height="70"
                                    style="object-fit: cover;"
                                    class="rounded">

                                <?php echo htmlspecialchars($row['product_name']); ?>

                            </td>


                            <!-- Price -->
                            <td>
                                $<?php echo $row['price']; ?>
                            </td>


                            <!-- Quantity -->
                            <td>

                                <?php echo $row['quantity']; ?>

                            </td>


                            <!-- Item Total -->
                            <td>
                                $<?php echo $item_total; ?>
                            </td>


                            <!-- Remove -->
                            <td>

                                <a href="remove_from_cart.php?id=<?php echo $row['cart_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete?');">

                                    <i class="bi bi-trash"></i>
                                    Remove

                                </a>

                            </td>

                        </tr>

                    <?php

                    }

                    ?>

                </tbody>

            </table>

        </div>



        <!-- Cart Total -->
        <div class="text-end mt-4">


            <h4> Total: $<?php echo $total; ?></h4>


            <!-- Place Order Button -->
            <button type="button"
                class="btn btn-orange mt-2"
                data-bs-toggle="modal"
                data-bs-target="#orderModal">

                <i class="bi bi-bag-check"></i>

                Place Order

            </button>


        </div>

    </section>



    <!-- Order Modal -->
    <div class="modal fade"
        id="orderModal"
        tabindex="-1"
        aria-labelledby="orderModalLabel"
        aria-hidden="true">


        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">


                <!-- Modal Header -->
                <div class="modal-header">

                    <h5 class="modal-title"
                        id="orderModalLabel">

                        Place Your Order

                        <i class="bi bi-bag-check"></i>

                    </h5>


                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                    </button>

                </div>



                <!-- Order Form -->
                <form action="save_order.php"
                    method="POST">


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

                            <label for="customerLocation"
                                class="form-label">

                                <i class="bi bi-geo-alt"></i>

                                Location

                            </label>


                            <input type="text"
                                class="form-control"
                                id="customerLocation"
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

                            <label for="orderQuantity"
                                class="form-label">

                                <i class="bi bi-123"></i>

                                Quantity

                            </label>


                            <input type="number"
                                class="form-control"
                                id="orderQuantity"
                                name="quantity"
                                min="1"
                                value="1"
                                required>

                        </div>


                    </div>



                    <!-- Modal Footer -->
                    <div class="modal-footer">


                        <!-- Close -->
                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Close

                        </button>



                        <!-- Place Order -->
                        <button type="submit"
                            class="btn btn-orange">

                            <i class="bi bi-check-circle"></i>

                            Place Order

                        </button>


                    </div>


                </form>


            </div>

        </div>

    </div>



    <!-- Footer -->
    <footer class="bg-secondary text-dark w-100 mt-5 fixed-bottom">


        <div class="container-fluid text-center py-3">


            <p class="text-dark mb-0">

                &copy; 2026 HA Home Store.

                All rights reserved.

            </p>


            <!-- Date -->
            <i class="bi bi-calendar3"></i>

            <span id="footerdate"></span>


            <span class="mx-2">|</span>


            <!-- Time -->
            <i class="bi bi-clock"></i>

            <span id="footertime"></span>


        </div>

    </footer>



    <!-- Bootstrap JS -->
    <script src="bootstrap.js"></script>



    <!-- Date & Time -->
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


</body>

</html>