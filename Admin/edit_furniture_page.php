```php id="x8m1qv"
<?php

// Include the database connection
include("../conn.php");

// Get the page ID from the URL
if (isset($_GET['id'])) {

    $page_id = (int) $_GET['id'];

    // Get Furniture Page information
    $sql = "SELECT * FROM furniture_page WHERE page_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $page_id);
    $stmt->execute();

    $result = $stmt->get_result();

    // Get the page information
    $row = $result->fetch_assoc();

    // var_dump($row);

    if (!$row) {
        die("Furniture Page not found.");
    }

} else {

    die("Page ID is missing.");

}

?>

<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

<div class="container-scroller">

    <?php include(__DIR__ . "/template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="container-fluid">

                    <h3 class="page-title mb-4">Edit Furniture Page</h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">Furniture Page Information</h4>

                            <form method="POST" action="update_furniture_page.php">

                                <!-- Hidden Page ID -->
                                <input type="hidden"
                                       name="page_id"
                                       value="<?php echo $row['page_id']; ?>">

                                <div class="form-group">
                                    <label>Title</label>

                                    <input type="text"
                                           name="title"
                                           class="form-control"
                                           value="<?php echo htmlspecialchars($row['title']); ?>"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Welcome Text</label>

                                    <textarea name="welcome_text"
                                              class="form-control"
                                              rows="5"
                                              required><?php echo htmlspecialchars($row['welcome_text']); ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="mdi mdi-content-save"></i>
                                    Update Page
                                </button>

                                <a href="admin_furniture_page.php"
                                   class="btn btn-light">
                                    Cancel
                                </a>

                            </form>

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
```
