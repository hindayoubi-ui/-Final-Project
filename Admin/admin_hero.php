<?php

session_start();





// Include the database connection
include("../conn.php");

// Select all data from the hero table
$sql = "SELECT * FROM hero";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query failed
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display the query result for debugging
// var_dump($result);


// Get all rows from the hero table
// We will use fetch_assoc() inside the while loop below.

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

                        <!-- Page title and Add button -->
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <h3 class="page-title">
                                Home Carousel
                            </h3>

                            <!-- Button to add a new carousel slide -->
                            <a href="add_hero.php" class="btn btn-warning">

                                <i class="mdi mdi-plus"></i>

                                Add Carousel

                            </a>

                        </div>


                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">
                                    Home Carousel
                                </h4>


                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Title</th>

                                                <th>Description</th>

                                                <th>Image</th>

                                                <th>Created At</th>

                                                <th>Actions</th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php

                                            // Loop through all rows in the hero table
                                            while ($row = $result->fetch_assoc()) {

                                                // Display the current row for debugging
                                                // var_dump($row);

                                            ?>

                                                <tr>

                                                    <!-- Display Hero ID -->
                                                    <td>
                                                        <?php echo $row['hero_id']; ?>
                                                    </td>


                                                    <!-- Display Hero Title -->
                                                    <td>
                                                        <?php echo $row['title']; ?>
                                                    </td>


                                                    <!-- Display Hero Description -->
                                                    <td>
                                                        <?php echo $row['description']; ?>
                                                    </td>


                                                    <!-- Display Hero Image -->
                                                    <td>

                                                        <img
                                                            src="../Client/images/<?php echo $row['hero_image']; ?>"
                                                            width="100"
                                                            height="60"
                                                            style="object-fit: cover;"
                                                            alt="<?php echo $row['title']; ?>">

                                                    </td>
                                                     <!-- Display time-->
                                                    <td> <?php echo $row['created_at']; ?>


                                                    </td>






                                                    <!-- Edit and Delete buttons -->
                                                    <td>

                                                        <!-- Edit button -->
                                                        <a
                                                            href="edit_hero.php?id=<?php echo $row['hero_id']; ?>"
                                                            class="btn btn-sm btn-outline-success">

                                                            <i class="bi bi-pencil"></i>

                                                            Edit

                                                        </a>


                                                        <!-- Delete button -->
                                                        <a
                                                            href="delete_hero.php?id=<?php echo $row['hero_id']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this carousel slide?');">

                                                            <i class="mdi mdi-delete"></i>

                                                            Delete

                                                        </a>

                                                    </td>

                                                </tr>

                                            <?php

                                            }

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

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
```