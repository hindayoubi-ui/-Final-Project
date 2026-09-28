<?php

// Connect to HA Home Store database
include("../conn.php");

?>

<!-- head -->
<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

    <div class="container-scroller">

        <!-- navbar -->
        <?php include(__DIR__ . "/template/common/navbar.php"); ?>
        <!-- end navbar -->


        <div class="container-fluid page-body-wrapper">

            <!-- sidebar -->
            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>
            <!-- end sidebar -->


            <!-- main-panel -->
            <div class="main-panel">

                <!-- content-wrapper -->
                <div class="content-wrapper">

                    <!-- Add Furniture Product Content -->
                    <div class="container-fluid">

                        <!-- Page title -->
                        <h3 class="page-title mb-4">
                            Add Furniture Product
                        </h3>


                        <!-- Add Product Card -->
                        <div class="card">

                            <div class="card-body">

                                <!-- Card title -->
                                <h4 class="card-title">
                                    Furniture Product Information
                                </h4>


                                <!--
                                    Product form

                                    enctype="multipart/form-data"
                                    is required because we are uploading an image.
                                -->

                                <form
                                    method="POST"
                                    action="save_furniture.php"
                                    enctype="multipart/form-data">


                                    <!-- Product Name -->
                                    <div class="form-group">

                                        <label>
                                            Product Name
                                        </label>

                                        <input
                                            type="text"
                                            name="fname"
                                            class="form-control"
                                            placeholder="Enter product name"
                                            required>

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
                                            placeholder="Enter price"
                                            required>

                                    </div>


                                    <!-- Product Image -->
                                    <div class="form-group">

                                        <label>
                                            Product Image
                                        </label>

                                        <!--
                                            The user chooses an image
                                            from the computer.
                                        -->

                                        <input
                                            type="file"
                                            name="f_image"
                                            class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            required>

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
                                            placeholder="Enter product description"
                                            required></textarea>

                                    </div>


                                    <!-- Add Product Button -->
                                    <button
                                        type="submit"
                                        class="btn btn-warning">

                                        <!-- Save icon -->
                                        <i class="mdi mdi-content-save"></i>

                                        <!-- Button text -->
                                        Add Product

                                    </button>


                                    <!-- Cancel Button -->
                                    <a
                                        href="admin_furniture.php"
                                        class="btn btn-light">

                                        Cancel

                                    </a>


                                </form>

                            </div>

                        </div>

                    </div>
                    <!-- end Add Furniture Product Content -->

                </div>
                <!-- end content-wrapper -->


                <!-- footer -->
                <?php include(__DIR__ . "/template/common/footer.php"); ?>
                <!-- end footer -->

            </div>
            <!-- end main-panel -->

        </div>
        <!-- end page-body-wrapper -->

    </div>
    <!-- end container-scroller -->


    <!-- scripts -->
    <?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>