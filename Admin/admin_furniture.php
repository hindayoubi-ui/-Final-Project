<?php

// Connect to the database 
// conn.php is one folder outside the Admin folder 
include "../conn.php";


// Get all furniture products from the database 
$sql = "SELECT * FROM furniture";

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

                    <!-- Furniture Products Content -->
                    <div class="container-fluid">

                        <!-- Page title -->
                        <h3 class="page-title mb-4">
                            Furniture Products
                        </h3>


                        <!-- Add Furniture Product button -->
                        <div class="mb-4">

                            <!-- Add Furniture Product Button -->
                            <button>
                                <a
                                    href="add_furniture.php"
                                    class="btn btn-warning">

                                    <!-- Plus icon -->
                                    <i class="mdi mdi-plus"></i>

                                    <!-- Button text -->
                                    Add Furniture Product

                                </a>
                            </button>

                        </div>

                    </div>


                    <!-- Furniture Products Card -->
                    <div class="card">

                        <div class="card-body">

                            <!-- Card title -->
                            <h4 class="card-title">
                                Furniture Products List
                            </h4>


                            <!-- Responsive table -->
                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <!-- Table header -->
                                    <thead>

                                        <tr>

                                            <th> ID</th>
                                               
                                    
                                            <th> Name </th>

                                        
                                            <th> Price</th>
                                               
                                            <th> Image</th>
                                               
                                    
                                            <th> Description</th>
                                               
                                            <th>Created At</th>

                                            <th>  Actions </th>
                                              
                                           

                                        </tr>

                                    </thead>


                                    <!-- Table body -->
                                    <tbody>

                                        <?php

                                        // Loop through all furniture products 
                                        while ($row = $result->fetch_assoc()) {

                                        ?>

                                            <tr>

                                                <!-- Product ID -->
                                                <td><?php echo $row['furniture_id']; ?> </td>
                                                    
                                            
                                                <!-- Product name -->
                                                <td> <?php echo $row['fname']; ?>  </td>
                                                   
                                              
                                                <!-- Product price -->
                                                <td> $<?php echo $row['price']; ?> </td>
                                                   
                                               


                                                <!-- Product image -->
                                                <td>

                                                    <img
                                                        src="../Client/images/<?php echo $row['f_image']; ?>"
                                                        width="70"
                                                        height="70"
                                                        style="object-fit: cover;"
                                                        alt="<?php echo $row['fname']; ?>">

                                                </td>


                                                <!-- Product description -->
                                                <td> <?php echo $row['description']; ?> </td>
                                                   
                                            
                                                <td> <?php echo $row['created_at']; ?> </td>


                                                <!-- Action buttons -->
                                                <td>

                                                    <!-- Edit button -->
                                                    <a
                                                        href="edit_furniture.php?id=<?php echo $row['furniture_id']; ?>"
                                                        class="btn btn-sm btn-outline-success"
                                                        title="Edit">

                                                        <!-- Edit icon -->
                                                        <i class="bi bi-pencil"></i> Edit

                                                    </a>


                                                    <!-- Delete button -->
                                                    <a
                                                        href="delete_furniture.php?id=<?php echo $row['furniture_id']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        title="delete"
                                                        onclick="return confirm('Are you sure you want to delete this product?');">

                                                        <!-- Delete icon -->
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
                <!-- end Furniture Products Content -->

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