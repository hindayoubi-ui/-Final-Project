```php
<?php

// Include the database connection
include("../conn.php");

// Get the Home Intro data
$sql = "SELECT * FROM home_intro";

// Execute the query
$result = $conn->query($sql);

// Check if the query failed
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Get the first row from the table
$row = $result->fetch_assoc();

// Display the result for debugging
// var_dump($row);

?>

<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

<div class="container-scroller">

    <!-- Include Admin Navbar -->
    <?php include(__DIR__ . "/template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <!-- Include Admin Sidebar -->
        <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="container-fluid">

                    <h3 class="page-title mb-4">
                        Edit Home Intro
                    </h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">
                                Home Intro Information
                            </h4>

                            <?php if ($row) { ?>

                                <!--
                                    Form used to edit the Home Intro.
                                    The form sends the data to update_home_intro.php
                                -->
                                <form method="POST" action="update_home_intro.php">

                                    <!--
                                        Hidden input:
                                        We keep the ID so we know which row to update.
                                    -->
                                    <input
                                        type="hidden"
                                        name="intro_id"
                                        value="<?php echo $row['intro_id']; ?>"
                                    >

                                    <!-- Home Intro Title -->
                                    <div class="form-group">

                                        <label>Title</label>

                                        <input
                                            type="text"
                                            name="title"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($row['title']); ?>"
                                            required
                                        >

                                    </div>

                                    <!-- Home Intro Description -->
                                    <div class="form-group">

                                        <label>Description</label>

                                        <textarea
                                            name="description"
                                            class="form-control"
                                            rows="5"
                                            required
                                        ><?php echo htmlspecialchars($row['description']); ?></textarea>

                                    </div>

                                    <!-- Save button -->
                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >
                                        <i class="mdi mdi-content-save"></i>
                                        Update Home Intro
                                    </button>

                                    <!-- Cancel button -->
                                    <a
                                        href="home_intro.php"
                                        class="btn btn-light"
                                    >
                                        Cancel
                                    </a>

                                </form>

                            <?php } else { ?>

                                <!-- Display message if there is no data -->
                                <p>No Home Intro data found.</p>

                            <?php } ?>

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
```
