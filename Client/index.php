<?php

// index.php is inside the Client folder,
// while conn.php is one folder above (in the main HA-homestore folder).
// ../ means: go up one folder.
include("../conn.php");

$sql = "SELECT * FROM hero";
$result = $conn->query($sql);
$hero = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($hero);exit;

// Get the home intro information from the database
$sql2 = "SELECT * FROM home_intro";
$result2 = $conn->query($sql2);
// Store the home intro data in an array
$home_intro = $result2->fetch_assoc();
//var_dump($home_intro);exit;











?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HA Home Store</title>
    <link rel="stylesheet" href="bootstrap.css">
    <script src="bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top">
        <div class="container">

            <a class="navbar-brand " href="index.php"> HA </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item border-end active">
                        <a class="nav-link " href="index.php"> Home<i class="bi bi-house-heart-fill"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="products.php"> Products <i class="bi bi-bag"></i> </a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="about.php"> About <i class="bi bi-info-circle"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="contact.php">Contact <i class="bi bi-envelope"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="cart.php">Cart <i class="bi bi-cart"></i></a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- Carousel -->
    <div id="demo" class="carousel slide mb-5">

        <!-- Indicators/dots -->
        <!-- Create one indicator for each hero record from the database -->
        <div class="carousel-indicators">

            <?php foreach ($hero as $index => $h) { ?>

                <!-- The first indicator is active -->
                <button type="button"
                    data-bs-target="#demo"
                    data-bs-slide-to="<?= $index ?>"
                    class="<?= $index == 0 ? 'active' : '' ?>">
                </button>

            <?php } ?>

        </div>


        <!-- The slideshow/carousel -->
        <div class="carousel-inner">

            <!-- Loop through hero data from the database -->
            <?php foreach ($hero as $index => $h) { ?>

                <!-- The first slide is active -->
                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">

                    <!-- Display hero image from database -->
                    <img src="images/<?= htmlspecialchars($h['hero_image']) ?>"
                        alt="<?= htmlspecialchars($h['title']) ?>"
                        class="d-block w-100">

                    <!-- Display hero title and description from database -->
                    <div class="carousel-caption text-dark">

                        <h3><?= htmlspecialchars($h['title']) ?></h3>

                        <p><?= htmlspecialchars($h['description']) ?></p>

                    </div>

                </div>

            <?php } ?>

        </div>


        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#demo"
            data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
            type="button"
            data-bs-target="#demo"
            data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

    <!-- <div class="container-fluid mt-5"> -->
    <!-- <h3>Welcome to HA Home Store</h3> -->
    <!-- <p>Everything you need to make your home beautiful and comfortable.</p> -->
    <!-- </div> -->

    <!-- Home Intro Section -->
    <div class="container-fluid mt-5">
        <!-- Display the title from the database -->
        <h3><?= htmlspecialchars($home_intro['title']) ?></h3>

        <!-- Display the description from the database -->
        <p><?= htmlspecialchars($home_intro['description']) ?></p>

    </div>


    <!-- Cart Order Modal -->

    <div class="modal fade" id="cartorderModal" tabindex="-1"
        aria-labelledby="cartorderModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="cartorderModalLabel">
                        Cart <i class="bi bi-cart"></i>
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
                            <label for="customerName" class="form-label">
                                <i class="bi bi-person"></i> Name
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
                            <label for="location" class="form-label">
                                <i class="bi bi-geo-alt"></i> Location
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
                            <label for="orderDate" class="form-label">
                                <i class="bi bi-calendar"></i> Date
                            </label>

                            <input type="date"
                                class="form-control"
                                id="orderDate"
                                name="date"
                                required>
                        </div>

                        <!-- Time -->
                        <div class="mb-3">
                            <label for="orderTime" class="form-label">
                                <i class="bi bi-clock"></i> Time
                            </label>

                            <input type="time"
                                class="form-control"
                                id="orderTime"
                                name="time"
                                required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">
                                <i class="bi bi-123"></i> Quantity
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
                        <i class="bi bi-check-circle"></i> Place Order
                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- Footer -->
    <footer class="bg-secondary text-dark  w-100 fixed-bottom">
        <div class="container-fluid text-center py-3">
            <!-- Copyright -->
            <p class="text-dark mb-0">
                &copy; <span id="currentYear"></span> HA Home Store. All rights reserved. </p>

            <i class="bi bi-calendar3"></i>
            <span id="footerdate"></span>

            <span class="mx-2">|</span>

            <i class="bi bi-clock"></i>
            <span id="footertime"></span>

        </div>
    </footer>
    <!-- JavaScript <script> → بيجيب الوقت الحالي وبيحدّثه كل ثانية. krml hek hatet script -->
    <script>
        function updateDateTime() {
            const now = new Date();

            document.getElementById("footerdate").textContent =
                now.toLocaleDateString();

            document.getElementById("footertime").textContent =
                now.toLocaleTimeString();

            // toLocaleString() بتعطي التاريخ + الوقت مع بعض.
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
        // Display the current year automatically
        document.getElementById("currentYear").textContent = new Date().getFullYear();
    </script>


</body>

</html>