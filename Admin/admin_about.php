<?php

session_start();


include("../conn.php");

$sql = "SELECT * FROM about_page";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$about = $result->fetch_assoc();
?>

<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

    <div class="container-scroller">

        <?php include(__DIR__ . "/template/common/navbar.php"); ?>

        <div class="container-fluid page-body-wrapper">

            <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">

                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">About Page</h4>

                                    <?php if ($about) { ?>
                                        <a href="edit_about.php?id=<?php echo $about['about_id']; ?>"
                                            class="btn btn-warning mb-3">
                                            <i class="mdi mdi-pencil"></i>
                                            Edit About Page
                                        </a>

                                        <div class="table-responsive">

                                            <table class="table table-bordered">

                                                <tr>
                                                    <th>ID</th>
                                                    <td>
                                                        <?php echo $about['about_id']; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Title</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['title']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>English Text</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['english_text']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Arabic Text</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['arabic_text']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>French Text</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['french_text']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>English Quote</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['quote_english']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Arabic Quote</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['quote_arabic']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>French Quote</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['quote_french']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Image</th>
                                                    <td>
                                                        <?php echo htmlspecialchars($about['about_image']); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Created At</th>
                                                    <td>
                                                        <?php echo $about['created_at']; ?>
                                                    </td>
                                                </tr>

                                            </table>

                                        </div>


                                    <?php } else { ?>

                                        <p>No About page data found.</p>

                                    <?php } ?>

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