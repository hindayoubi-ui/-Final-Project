<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HA Home Store - Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">

    <div class="row justify-content-center w-100">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4 p-md-5">

                    <!-- Logo -->

                    <div class="text-center mb-4">

                        <i class="bi bi-house-heart-fill text-warning"
                           style="font-size: 55px;">
                        </i>

                        <h2 class="fw-bold mt-2">
                            HA Home Store
                        </h2>

                        <p class="text-muted">
                            Welcome to Admin Dashboard
                        </p>

                    </div>


                    <!-- Login -->

                    <form action="login_process.php" method="POST">

                        <!-- Username -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Username
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>

                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    placeholder="Enter your username"
                                    required>

                            </div>

                        </div>


                        <!-- Password -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required>

                            </div>

                        </div>


                        <!-- Button -->

                        <button
                            type="submit"
                            class="btn btn-warning w-100 py-2 fw-semibold">

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Login

                        </button>

                    </form>


                    <!-- Footer -->

                    <div class="text-center mt-4">

                        <small class="text-muted">
                            HA Home Store Admin Dashboard
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>