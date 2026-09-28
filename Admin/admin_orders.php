<?php

include("../conn.php");

$sql = "SELECT * FROM orders ORDER BY order_id DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders - HA Admin</title>

    <link rel="stylesheet"
        href="/HA-homestore/Admin/template/dist/assets/vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet"
        href="/HA-homestore/Admin/template/dist/assets/vendors/ti-icons/css/themify-icons.css">

    <link rel="stylesheet"
        href="/HA-homestore/Admin/template/dist/assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet"
        href="/HA-homestore/Admin/template/dist/assets/css/style.css">

</head>

<body>

<div class="container-scroller">

    <?php include("template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <?php include("template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <h3 class="mb-4">
                    Orders
                    <i class="mdi mdi-cart-outline"></i>
                </h3>

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">
                            Customer Orders
                        </h4>

                        <div class="table-responsive">

                            <table class="table table-bordered">

                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Quantity</th>
                                        <th>Created At</th>
                                    </tr>

                                </thead>

                                <tbody>

                                <?php

                                while ($order = $result->fetch_assoc()) {

                                ?>

                                    <tr>

                                        <td>
                                            <?php echo $order['order_id']; ?>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($order['name']); ?>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($order['location']); ?>
                                        </td>

                                        <td>
                                            <?php echo $order['date']; ?>
                                        </td>

                                        <td>
                                            <?php echo $order['time']; ?>
                                        </td>

                                        <td>
                                            <?php echo $order['quantity']; ?>
                                        </td>

                                        <td>
                                            <?php echo $order['created_at']; ?>
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

            <?php include("template/common/footer.php"); ?>

        </div>

    </div>

</div>

<?php include("template/common/script.php"); ?>

</body>

</html>