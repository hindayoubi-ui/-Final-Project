```php
<?php

// Include the database connection
include("../conn.php");

// Display the connection for debugging
// var_dump($conn);

?>

<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

<div class="container-scroller">

    <!-- Include the Admin Navbar -->
    <?php include(__DIR__ . "/template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <!-- Include the Admin Sidebar -->
        <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="container-fluid">

                    <!-- Page title -->
                    <h3 class="page-title mb-4">
                        Add Carousel Slide
                    </h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">
                                Carousel Information
                            </h4>

                            <!--
                                Form for adding a new Carousel slide.
                                The data will be sent to save_hero.php.
                                enctype is required because we are uploading an image.
                            -->
                            <form
                                method="POST"
                                action="save_hero.php"
                                enctype="multipart/form-data"
                            >

                                <!-- Hero Title -->
                                <div class="form-group">

                                    <label>Title</label>

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        placeholder="Enter carousel title"
                                        required
                                    >

                                </div>


                                <!-- Hero Description -->
                                <div class="form-group">

                                    <label>Description</label>

                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Enter carousel description"
                                        required
                                    ></textarea>

                                </div>


                                <!-- Hero Image -->
                                <div class="form-group">

                                    <label>Hero Image</label>

                                    <input
                                        type="file"
                                        name="hero_image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                        required
                                    >

                                </div>


                                <!-- Add button -->
                                <button
                                    type="submit"
                                    class="btn btn-warning"
                                >

                                    <i class="mdi mdi-content-save"></i>

                                    Add Carousel

                                </button>


                                <!-- Cancel button -->
                                <a
                                    href="admin_hero.php"
                                    class="btn btn-light"
                                >
                                    Cancel
                                </a>

                            </form>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Include the Admin Footer -->
            <?php include(__DIR__ . "/template/common/footer.php"); ?>

        </div>

    </div>

</div>


<!-- Include Admin JavaScript -->
<?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>
```
