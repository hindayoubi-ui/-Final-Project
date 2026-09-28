<?php
session_start();

include("../conn.php");

$sql = "SELECT product_background.*, users.usersname
        FROM product_background
        INNER JOIN users
        ON product_background.users_id = users.users_id";

$result = $conn->query($sql);
//var_dump($result);exit;

if (!$result) {
    die("Error getting backgrounds: " . $conn->error);
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

                                <h4 class="card-title">
                                    Product Backgrounds
                                </h4>

                                <p class="card-description">
                                    View all seasonal and other backgrounds.
                                </p>

                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <thead>

                                            <tr>
                                                <th>ID</th>
                                                <th>Occasion</th>
                                                <th>Background Image</th>
                                                <th>Added By</th>
                                                <th>Created At</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php while ($row = $result->fetch_assoc()) { ?>

                                                <tr>

                                                    <td>
                                                        <?php echo $row['background_id']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo htmlspecialchars($row['occasion']); ?>
                                                    </td>

                                                    <td>

                                                        <img src="../Client/images/<?php echo htmlspecialchars($row['background_image']); ?>"
                                                             width="150"
                                                             height="80"
                                                             style="object-fit: cover;">

                                                    </td>

                                                    <td>
                                                        <?php echo htmlspecialchars($row['usersname']); ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row['created_at']; ?>
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

            </div>

            <?php include(__DIR__ . "/template/common/footer.php"); ?>

        </div>

    </div>

</div>

<?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>