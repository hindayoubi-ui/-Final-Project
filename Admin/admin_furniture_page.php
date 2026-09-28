
<?php

session_start();

// Include the database connection
include("../conn.php");

// Get Furniture Page information from database
$sql = "SELECT * FROM furniture_page";
$result = $conn->query($sql);

// Check if the query worked
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Get the page information
$row = $result->fetch_assoc();

// var_dump($result);
// var_dump($row);

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

                    <h3 class="page-title mb-4">Furniture Page</h3>

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title">Furniture Page Information</h4>

                            <?php if ($row) { ?>

                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Welcome Text</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td>
                                                    <?php echo $row['page_id']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $row['title']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $row['welcome_text']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $row['created_at']; ?>
                                                </td>

                                                <td>
                                                    <a href="edit_furniture_page.php?id=<?php echo $row['page_id']; ?>"
                                                       class="btn btn-sm btn-outline-success">
                                                        <i class="bi bi-pencil"></i>
                                                        Edit
                                                    </a>
                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php } else { ?>

                                <p>No Furniture Page information found.</p>

                            <?php } ?>

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
