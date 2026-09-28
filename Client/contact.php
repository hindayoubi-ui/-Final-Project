<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact - HA Home Store</title>

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

            <div class="collapse navbar-collapse"
                id="collapsibleNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="index.php"> Home <i class="bi bi-house-heart-fill"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="products.php"> Products <i class="bi bi-bag"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="about.php"> About <i class="bi bi-info-circle"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link active" href="contact.php"> Contact <i class="bi bi-envelope"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="cart.php">Cart <i class="bi bi-cart"></i></a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- Contact Section -->
    <section class="py-5 mt-5">

        <div class="container">

            <!-- Title -->
            <div class="text-center mb-5">

                <h2 class="fw-bold"> Contact Us
                    <i class="bi bi-envelope fs-2"></i>
                </h2>

                <p class="text-muted">
                    We would love to hear from you.
                </p>

            </div>


            <div class="row g-5">


                <!-- Contact Information -->
                <div class="col-md-5">

                    <h4 class="fw-bold mb-4">
                        Get In Touch
                    </h4>


                    <!-- Location -->
                    <div class="d-flex mb-4">

                        <i class="bi bi-geo-alt fs-3 text-warning me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1">
                                Location
                            </h6>

                            <p class="text-muted mb-0">
                                Tripoli, Lebanon
                            </p>

                        </div>

                    </div>


                    <!-- Phone -->
                    <div class="d-flex mb-4">

                        <i class="bi bi-telephone fs-3 text-warning me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1">
                                Phone
                            </h6>

                            <p class="text-muted mb-0">
                                +961 70 000 000
                            </p>

                        </div>

                    </div>


                    <!-- Email -->
                    <div class="d-flex mb-4">

                        <i class="bi bi-envelope fs-3 text-warning me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1"> Email</h6>

                            <p class="text-muted mb-0">
                                info@hahomestore.com
                            </p>

                        </div>

                    </div>


                    <!-- Working Hours -->
                    <div class="d-flex mb-4">

                        <i class="bi bi-clock fs-3 text-warning me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1"> Working Hours </h6>

                            <p class="text-muted mb-0">
                                Monday - Thursday
                                from 9:00 AM to 3:00 PM
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Contact Form -->
                <div class="col-md-7">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body p-4">

                            <h4 class="fw-bold mb-4">Share your feedback </h4>

                            <form action="save_contact.php" method="POST">

                                <!-- Name -->
                                <div class="mb-3">

                                    <label for="name" class="form-label">
                                        <i class="bi bi-person"></i> Name
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        placeholder="Enter your name"
                                        required>

                                </div>


                                <!-- Email -->
                                <div class="mb-3">

                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> Email
                                    </label>

                                    <input type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        placeholder="Enter your email"
                                        required>

                                </div>


                                <!-- Feedback -->
                                <div class="mb-3">

                                    <label for="feedback" class="form-label">
                                        <i class="bi bi-pencil"></i> Feedback
                                    </label>

                                    <textarea
                                        class="form-control"
                                        id="feedback"
                                        name="feedback"
                                        rows="5"
                                        placeholder="Your Feedback"
                                        required></textarea>

                                </div>


                                <!-- Button -->
                                <div class="text-end">

                                    <button type="submit" class="btn btn-orange">
                                        <i class="bi bi-send"></i> Send
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="bg-secondary text-dark w-100">

        <div class="container-fluid text-center py-3">

            <p class="text-dark mb-0">
                &copy; 2026 HA Home Store. All rights reserved.
            </p>

            <i class="bi bi-calendar3"></i>
            <span id="footerdate"></span>

            <span class="mx-2">|</span>

            <i class="bi bi-clock"></i>
            <span id="footertime"></span>

        </div>

    </footer>


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