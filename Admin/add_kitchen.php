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

                    <!-- Add Kitchen Product Content -->
                    <div class="container-fluid">

                        <!-- Page title -->
                        <h3 class="page-title mb-4">
                            Add Kitchen Product
                        </h3>


                        <!-- Add Product Card -->
                        <div class="card">

                            <div class="card-body">

                                <!-- Card title -->
                                <h4 class="card-title">
                                    Kitchen Product Information
                                </h4>


                                <!--
                                    Product form

                                    enctype="multipart/form-data"
                                    is required because we are uploading an image.
                                -->

                                <form
                                    method="POST"
                                    action="save_kitchen.php"
                                    enctype="multipart/form-data">


                                    <!-- Product Name -->
                                    <div class="form-group">

                                        <label>
                                            Product Name
                                        </label>

                                        <input
                                            type="text"
                                            name="kname"
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
                                            name="k_image"
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
                                        href="admin_kitchen.php"
                                        class="btn btn-light">

                                        Cancel

                                    </a>


                                </form>

                            </div>

                        </div>

                    </div>
                    <!-- end Add Kitchen Product Content -->

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