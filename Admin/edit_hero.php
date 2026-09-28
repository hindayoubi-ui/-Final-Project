
<?php

// Include the database connection
include("../conn.php");

// Check if the Hero ID is available in the URL
if (isset($_GET['id'])) {

    // Get the Hero ID from the URL
    $hero_id = (int) $_GET['id'];

    // Check if the ID is valid
    if ($hero_id <= 0) {
        die("Invalid Hero ID.");
    }

    // Select the Hero data using the ID
    $sql = "SELECT * FROM hero WHERE hero_id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if prepare failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the Hero ID
    $stmt->bind_param("i", $hero_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Get the Hero row
    $hero = $result->fetch_assoc();

    // Display the data for debugging
    // var_dump($hero);

    // Check if the Hero exists
    if (!$hero) {
        die("Hero slide not found.");
    }

    // Close the statement
    $stmt->close();

} else {

    // Display an error if the ID is missing
    die("Hero ID is missing.");

}

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
                        Edit Carousel Slide
                    </h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">
                                Carousel Information
                            </h4>

                            <!--
                                Form for editing the Carousel slide.
                                The data will be sent to update_hero.php.
                            -->
                            <form
                                method="POST"
                                action="update_hero.php"
                                enctype="multipart/form-data"
                            >

                                <!--
                                    Hidden Hero ID.
                                    This tells update_hero.php which row to update.
                                -->
                                <input
                                    type="hidden"
                                    name="hero_id"
                                    value="<?php echo $hero['hero_id']; ?>"
                                >


                                <!-- Hero Title -->
                                <div class="form-group">

                                    <label>Title</label>

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($hero['title']); ?>"
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
                                        required
                                    ><?php echo htmlspecialchars($hero['description']); ?></textarea>

                                </div>


                                <!-- Current Image -->
                                <div class="form-group">

                                    <label>Current Image</label>

                                    <br>

                                    <img
                                        src="../Client/images/<?php echo $hero['hero_image']; ?>"
                                        width="200"
                                        height="120"
                                        style="object-fit: cover;"
                                        alt="<?php echo htmlspecialchars($hero['title']); ?>"
                                    >

                                </div>


                                <!-- New Hero Image -->
                                <div class="form-group">

                                    <label>New Image (Optional)</label>

                                    <input
                                        type="file"
                                        name="hero_image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                    >

                                    <small class="form-text text-muted">
                                        Leave empty if you want to keep the current image.
                                    </small>

                                </div>


                                <!-- Update button -->
                                <button
                                    type="submit"
                                    class="btn btn-warning"
                                >

                                    <i class="mdi mdi-content-save"></i>

                                    Update Carousel

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


            <!-- Include Admin Footer -->
            <?php include(__DIR__ . "/template/common/footer.php"); ?>

        </div>

    </div>

</div>


<!-- Include Admin JavaScript -->
<?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>
