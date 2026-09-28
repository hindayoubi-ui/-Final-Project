
<?php

session_start();

// Include the database connection
include("../conn.php");

// Select all data from the home_intro table
$sql = "SELECT * FROM home_intro";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query failed
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display the result for debugging
// var_dump($result);exit;

// Get one row from the result
$row = $result->fetch_assoc();

// Display the fetched row for debugging
//var_dump($row);exit;

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
                        Home Intro
                    </h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">
                                Home Intro Information
                            </h4>

                            <?php

                            // Check if there is data in the table
                            if ($row) {

                            ?>

                                <!-- Display the Home Intro title -->
                                <h3>
                                    <?php echo $row['title']; ?>
                                </h3>

                                <!-- Display the Home Intro description -->
                                <p>
                                    <?php echo $row['description']; ?>
                                </p>

                            <?php

                            } else {

                                // Display this message if no data exists
                                echo "<p>No Home Intro data found.</p>";

                            }

                            ?>

                            <!-- Button to edit the Home Intro -->
                            <a href="edit_home_intro.php" class="btn btn-warning">
                                <i class="mdi mdi-pencil"></i>
                                Edit Home Intro
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Include the Admin Footer -->
            <?php include(__DIR__ . "/template/common/footer.php"); ?>

        </div>
    </div>
</div>

<!-- Include the Admin JavaScript files -->
<?php include(__DIR__ . "/template/common/script.php"); ?>

</body>
</html>

