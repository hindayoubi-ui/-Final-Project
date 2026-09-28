<?php

include("../conn.php");

if (isset($_GET['category_id'])) {

    $category_id = (int) $_GET['category_id'];

    $sql = "SELECT * FROM categories WHERE category_id = $category_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $category = $result->fetch_assoc();

    } else {

        die("Category not found.");

    }

} else {

    die("Category ID not provided.");

}

?>

<?php include(__DIR__ . "/template/common/head.php"); ?>

<body>

    <div class="container-scroller">

        <?php include(__DIR__ . "/template/common/navbar.php"); ?>

        <div class="container-fluid page-body-wrapper">

            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

            <div class="main-panel">

                <div class="content-wrapper">

                    <div class="page-header">
                        <h3 class="page-title">
                            Edit Category
                        </h3>
                    </div>

                    <div class="row">

                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">
                                        Update Category
                                    </h4>

                                    <form action="update_categories.php" method="POST">

                                        <input type="hidden"
                                            name="category_id"
                                            value="<?php echo $category['category_id']; ?>">

                                        <div class="form-group">

                                            <label>Category Name</label>

                                            <input type="text"
                                                class="form-control"
                                                name="category_name"
                                                value="<?php echo htmlspecialchars($category['category_name']); ?>"
                                                required>

                                        </div>

                                        <div class="form-group">

                                            <label>Created At</label>

                                            <input type="text"
                                                class="form-control"
                                                value="<?php echo htmlspecialchars($category['created_at']); ?>"
                                                readonly>

                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary">
                                            Update
                                        </button>

                                        <a href="categories.php"
                                            class="btn btn-light">
                                            Cancel
                                        </a>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php include(__DIR__ . "/template/common/footer.php"); ?>

            </div>

        </div>

    </div>

    <?php include(__DIR__ . "/template/common/script.php"); ?>

</body>
</html>