<?php

// Start the session
// We need the session to know which user is logged in.
session_start();

//to see the session data.
//var_dump($_SESSION);exit;


// Check if the user is logged in
// If there is no users_id in the session,
// redirect the user to the login page.
if (!isset($_SESSION['users_id'])) {

    header("Location: ../../login.php");
    exit;
}

// Connect to the database
// index.php is inside:
// HA-homestore/Admin/template/dist/
// So we need to go 3 folders back to reach conn.php.
include("../../../conn.php");

// Count Categories

// COUNT(*) counts the total number of rows
// inside the categories table.
$sql_categories = "SELECT COUNT(*) AS total_categories
                   FROM categories";


// Execute the SQL query.
$result_categories = $conn->query($sql_categories);


// Get the result as an associative array.
$row_categories = $result_categories->fetch_assoc();


// Store the total number of categories
// inside the $total_categories variable.
$total_categories = $row_categories['total_categories'];

//var_dump($row_categories);exit;
//var_dump($total_categories);exit;


// Count Products

// COUNT(*) counts the total number of products
// inside the products table.
$sql_products = "SELECT COUNT(*) AS total_products
                 FROM products";

// Execute the SQL query.
$result_products = $conn->query($sql_products);


// Get the result as an associative array.
$row_products = $result_products->fetch_assoc();


// Store the total number of products.
$total_products = $row_products['total_products'];

//var_dump($row_products);exit;
//var_dump($total_products);exit;


// Count Users
$sql_users = "SELECT COUNT(*) AS total_users
              FROM users";

$result_users = $conn->query($sql_users);

$row_users = $result_users->fetch_assoc();

$total_users = $row_users['total_users'];

// var_dump($row_users);exit
// var_dump($total_users);exit


//var_dump($total_categories);
//var_dump($total_products);
//var_dump($total_users);
//exit;

// Products Count By Category

// Get all categories from the database
// and count how many products belong to each category.

$sql_category_products = "
    SELECT
        categories.category_name,
        COUNT(products.product_id) AS total_products

    FROM categories

    LEFT JOIN products
        ON categories.category_id = products.category_id

    GROUP BY
        categories.category_id,
        categories.category_name
";

// Execute the SQL query
$result_category_products = $conn->query($sql_category_products);


// Get all results
$category_data = $result_category_products->fetch_all(MYSQLI_ASSOC);


// Arrays for the Pie Chart
$category_names = [];
$category_product_counts = [];


// Go through each category
foreach ($category_data as $category) {

    // Store category name
    $category_names[] = $category['category_name'];

    // Store number of products
    $category_product_counts[] = $category['total_products'];
}


//var_dump($category_names);
//var_dump($category_product_counts);
//exit;


?>


<!-- head -->
<?php include(__DIR__ . "/../common/head2.php"); ?>

<body>

    <div class="container-scroller">

        <!-- navbar -->
        <?php include(__DIR__ . "/../common/navbar.php"); ?>
        <!-- end navbar -->


        <div class="container-fluid page-body-wrapper">

            <!-- sidebar -->
            <?php include(__DIR__ . "/../common/sidebar.php"); ?>
            <!-- end sidebar -->


            <!-- main-panel -->
            <div class="main-panel">

                <!-- content-wrapper -->
                <div class="content-wrapper">

                    <!-- Dashboard Content -->
                    <p>
                        Welcome,
                        <strong>
                            <?php echo htmlspecialchars($_SESSION['usersname']); ?>
                        </strong>
                        to HA Home Store Admin Dashboard.
                    </p>

                    <!-- Dashboard Cards ( Query → Count → Variable → Display inside the card)-->
                    <div class="row">


                        <!-- Total Categories Card -->

                        <div class="col-md-4 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <!-- Card title -->
                                    <p class="card-title text-md-center text-xl-left">
                                        Total Categories
                                    </p>

                                    <!-- Display total categories -->
                                    <h3 class="mb-0">

                                        <?php echo $total_categories; ?>

                                    </h3>

                                </div>

                            </div>

                        </div>


                        <!-- Total Products Card -->

                        <div class="col-md-4 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <!-- Card title -->
                                    <p class="card-title text-md-center text-xl-left">
                                        Total Products
                                    </p>

                                    <!-- Display total products -->
                                    <h3 class="mb-0">

                                        <?php echo $total_products; ?>

                                    </h3>

                                </div>

                            </div>

                        </div>


                        <!-- Total Users Card -->

                        <div class="col-md-4 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <!-- Card title -->
                                    <p class="card-title text-md-center text-xl-left">
                                        Total Users
                                    </p>

                                    <!-- Display total users(html 3am ye3redon and php fo2 hasabon) -->
                                    <h3 class="mb-0">

                                        <?php echo $total_users; ?>

                                    </h3>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- End Dashboard Cards -->


                    <!--   Products by Category - Pie Chart -->
                       
                    <div class="row">

                        <div class="col-md-6 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <!-- Pie Chart Title -->

                                    <h4 class="card-title">
                                        Products by Category
                                    </h4>

                                    <p class="card-description">
                                        Number of products in each category
                                    </p>

                                    <!-- Canvas where Chart.js will draw the Pie Chart -->

                                    <canvas id="categoryProductsChart"></canvas>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- End Pie Chart -->


                    <!-- end Dashboard Content -->

                </div>
                <!-- end content-wrapper -->


                <!-- footer -->
                <?php include(__DIR__ . "/../common/footer.php"); ?>
                <!-- end footer -->

            </div>
            <!-- end main-panel -->

        </div>
        <!-- end page-body-wrapper -->

    </div>
    <!-- end container-scroller -->


    <!-- scripts -->
    <?php include(__DIR__ . "/../common/script.php"); ?>


    <!-- Pie Chart JavaScript -->
        
    

    <script>

        // Get category names from PHP
        const categoryNames =
            <?php echo json_encode($category_names); ?>;


        // Get product counts from PHP
        const categoryProductCounts =
            <?php echo json_encode($category_product_counts); ?>;


        // Get the canvas element
        const categoryProductsChart =
            document.getElementById('categoryProductsChart');


        // Create the Pie Chart
        new Chart(categoryProductsChart, {

            // Chart type
            type: 'pie',

            data: {

                // Category names will be the labels
                labels: categoryNames,

                datasets: [{

                    // Dataset label
                    label: 'Products',

                    // Product count for each category
                    data: categoryProductCounts,

                    // Border width
                    borderWidth: 1

                }]

            },

            options: {

                // Make the chart responsive
                responsive: true

            }

        });

    </script>


</body>

</html>