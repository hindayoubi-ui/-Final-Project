<?php

session_start();


include("../conn.php");

$sql = "SELECT * FROM contact";
$result = $conn->query($sql);
//var_dump($result);exit;

if (!$result) {
    die("Query failed: " . $conn->error);
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
                                    Contact Messages
                                </h4>

                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <thead>

                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Feedback</th>
                                                <th>Created At</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php while ($row = $result->fetch_assoc()) { ?>

                                                <tr>

                                                    <td>
                                                        <?php echo $row['contact_id']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row['name']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row['email']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row['feedback']; ?>
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