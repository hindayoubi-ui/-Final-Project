<?php

// Connect to database
include("../conn.php");

// Get all categories from database here abel ma a3ml eno a3rf min 3m yzid categories
//$sql = "SELECT * FROM `categories`";
//$result = $conn->query($sql);


// Get all categories with the user who added them
$sql = "SELECT categories.*, users.usersname
        FROM categories
        INNER JOIN users
        ON categories.users_id = users.users_id";

$result = $conn->query($sql);

//var_dump($result);exit;




// Check if query worked
if (!$result) {
    die("Error getting categories: " . $conn->error);
}

// Convert result to array
$categories = $result->fetch_all(MYSQLI_ASSOC);

?>

<?php include(__DIR__ . "/template/common/head.php"); ?>

<body>

    <!-- Container Scroller Start -->
    <div class="container-scroller">


        <!-- Navbar Start -->
        <?php include(__DIR__ . "/template/common/navbar.php"); ?>
        <!-- Navbar End -->


        <!-- Page Body Wrapper Start -->
        <div class="container-fluid page-body-wrapper">


            <!-- Sidebar Start -->
            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>
            <!-- Sidebar End -->


            <!-- Main Panel Start -->
            <div class="main-panel">


                <!-- Content Wrapper Start -->
                <div class="content-wrapper">


                    <!-- Page Header Start -->
                    <div class="page-header">

                        <h3 class="page-title">

                            <span class="page-title-icon bg-gradient-primary text-white me-2">

                                <i class="mdi mdi-shape-outline"></i>

                            </span>

                            Categories

                        </h3>

                        <nav aria-label="breadcrumb">

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">

                                    Categories

                                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>

                                </li>

                            </ul>

                        </nav>

                    </div>
                    <!-- Page Header End -->


                    <!-- Add Category Button Start -->
                    <div class="row">

                        <div class="col-12">

                            <div class="d-flex justify-content-end mb-3">

                                <button type="button"
                                    class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">

                                    Add Category

                                </button>

                            </div>

                        </div>

                    </div>
                    <!-- Add Category Button End -->


                    <!-- Categories Table Start -->
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">
                                        Categories List
                                    </h4>


                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Category ID</th>
                                                    <th>Category Name</th>
                                                    <th>Created At</th>
                                                    <th>Added By</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($categories as $category) { ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo htmlspecialchars($category['category_id']); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo htmlspecialchars($category['category_name']); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo htmlspecialchars($category['created_at']); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo htmlspecialchars($category['usersname']); ?>
                                                        </td>

                                                        <td>
                                                            <a href="update_form_categories.php?category_id=<?php echo $category['category_id']; ?>"
                                                                class="btn btn-sm btn-outline-success">
                                                                Edit
                                                            </a>


                                                            <a href="delete_categories.php?category_id=<?php echo $category['category_id']; ?>"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this category?');">
                                                                Delete
                                                            </a>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Categories Table End -->


                </div>
                <!-- Content Wrapper End -->


                <!-- Footer Start -->
                <?php include(__DIR__ . "/template/common/footer.php"); ?>
                <!-- Footer End -->


            </div>
            <!-- Main Panel End -->


        </div>
        <!-- Page Body Wrapper End -->


    </div>
    <!-- Container Scroller End -->


    <!-- Add Category Modal Start -->
    <div class="modal fade"
        id="addCategoryModal"
        tabindex="-1"
        aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->
                <div class="modal-header">

                    <h5 class="modal-title"
                        id="addCategoryModalLabel">

                        Add Category

                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                    </button>

                </div>


                <!-- Modal Body -->
                <div class="modal-body">


                    <!-- Category Form -->
                    <form action="insert_categories.php" method="POST">


                        <!-- Category Name -->
                        <div class="mb-3">

                            <label class="form-label">
                                Category Name
                            </label>

                            <input type="text"
                                class="form-control"
                                name="category_name"
                                placeholder="Enter Category Name"
                                required
                                autocomplete="off">

                        </div>


                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn btn-primary float-end">

                            Submit

                        </button>


                    </form>

                </div>

            </div>

        </div>

    </div>
    <!-- Add Category Modal End -->


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php include(__DIR__ . "/template/common/script.php"); ?>


</body>

</html>