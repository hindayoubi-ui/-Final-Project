<?php

// Connect to the database
// conn.php is one folder outside the Admin folder
include "../conn.php";


// Get all kitchen products from the database
$sql = "SELECT * FROM kitchen";

// Run the query
$result = $conn->query($sql);


// Check if the query worked
if (!$result) {
    die("Query failed: " . $conn->error);
}

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

                    <!-- Kitchen Products Content -->
                    <div class="container-fluid">

                        <!-- Page title -->
                        <h3 class="page-title mb-4">
                            Kitchen Products
                        </h3>


                        <!-- Add Kitchen Product button -->
                        <div class="mb-4">

                            <!-- Add Kitchen Product Button -->



                            <button>
                                <a href="add_kitchen.php" type="submit"
                                    class="btn btn-warning">


                                    <!-- Plus icon -->
                                    <i class="mdi mdi-plus"></i>
                                    <!-- Button text -->
                                    Add Kitchen Product
                                </a>

                            </button>

                        </div>





                    </div>


                    <!-- Kitchen Products Card -->
                    <div class="card">

                        <div class="card-body">

                            <!-- Card title -->
                            <h4 class="card-title">
                                Kitchen Products List
                            </h4>


                            <!-- Responsive table -->
                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <!-- Table header -->
                                    <thead>

                                        <tr>

                                            <th> ID </th>



                                            <th> Name </th>



                                            <th> Price </th>



                                            <th>Image </th>



                                            <th>Description </th>


                                            <th>Created At</th>

                                            <th> Actions </th>



                                        </tr>

                                    </thead>


                                    <!-- Table body -->
                                    <tbody>

                                        <?php

                                        // Loop through all kitchen products
                                        while ($row = $result->fetch_assoc()) {

                                        ?>

                                            <tr>

                                                <!-- Product ID -->
                                                <td>
                                                    <?php echo $row['kitchen_id']; ?>
                                                </td>


                                                <!-- Product name -->
                                                <td>
                                                    <?php echo $row['kname']; ?>
                                                </td>


                                                <!-- Product price -->
                                                <td>
                                                    $<?php echo $row['price']; ?>
                                                </td>


                                                <!-- Product image -->
                                                <td>

                                                    <img
                                                        src="../Client/images/<?php echo $row['k_image']; ?>"
                                                        width="70"
                                                        height="70"
                                                        style="object-fit: cover;"
                                                        alt="<?php echo $row['kname']; ?>">

                                                </td>


                                                <!-- Product description -->
                                                <td>
                                                    <?php echo $row['description']; ?>
                                                </td>

                                                <!-- Product creation time -->
                                                <td>
                                                    <?php echo $row['created_at']; ?>

                                                </td>






                                                <!-- Action buttons -->
                                                <td>

                                                    <!-- Edit button -->
                                                    <a
                                                        href="edit_kitchen.php?id=<?php echo $row['kitchen_id']; ?>"
                                                        class="btn btn-sm btn-outline-success"
                                                        title="Edit">

                                                        <!-- Edit icon -->
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>


                                                    <!-- Delete button -->
                                                    <a
                                                        href="delete_kitchen.php?id=<?php echo $row['kitchen_id']; ?>"
                                                        class="btn btn-danger btn-sm " title="delete"
                                                        onclick="return confirm('Are you sure you want to delete this product?');">

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
                <!-- end Kitchen Products Content -->

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