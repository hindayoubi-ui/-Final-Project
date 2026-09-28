
<?php
include("../conn.php");

if (!isset($_GET['id'])) {
    die("About ID is missing.");
}

$about_id = $_GET['id'];

$sql = "SELECT * FROM about_page WHERE about_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $about_id);
$stmt->execute();

$result = $stmt->get_result();
$about = $result->fetch_assoc();

if (!$about) {
    die("About page not found.");
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

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Edit About Page</h4>

                                <form action="update_about.php" method="POST">

                                    <input type="hidden"
                                           name="about_id"
                                           value="<?php echo $about['about_id']; ?>">

                                    <div class="form-group">
                                        <label>Title</label>

                                        <input type="text"
                                               name="title"
                                               class="form-control"
                                               value="<?php echo htmlspecialchars($about['title']); ?>"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>English Text</label>

                                        <textarea name="english_text"
                                                  class="form-control"
                                                  rows="4"
                                                  required><?php echo htmlspecialchars($about['english_text']); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Arabic Text</label>

                                        <textarea name="arabic_text"
                                                  class="form-control"
                                                  rows="4"
                                                  required><?php echo htmlspecialchars($about['arabic_text']); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>French Text</label>

                                        <textarea name="french_text"
                                                  class="form-control"
                                                  rows="4"
                                                  required><?php echo htmlspecialchars($about['french_text']); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>English Quote</label>

                                        <input type="text"
                                               name="quote_english"
                                               class="form-control"
                                               value="<?php echo htmlspecialchars($about['quote_english']); ?>"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Arabic Quote</label>

                                        <input type="text"
                                               name="quote_arabic"
                                               class="form-control"
                                               value="<?php echo htmlspecialchars($about['quote_arabic']); ?>"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>French Quote</label>

                                        <input type="text"
                                               name="quote_french"
                                               class="form-control"
                                               value="<?php echo htmlspecialchars($about['quote_french']); ?>"
                                               required>
                                    </div>

                                    <button type="submit" class="btn btn-warning">
                                        Update About Page
                                    </button>

                                    <a href="admin_about.php" class="btn btn-secondary">
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