<?php

require('../conn.php');

if (!isset($_GET['id'])) {
    echo "User ID is missing.";
    exit;
}

$id = $_GET['id'];

?>

<?php include("template/common/head.php"); ?>

<body>

<div class="container-scroller">

    <?php include("template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <?php include("template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-md-6 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Change Password</h4>

                                <form action="save_password.php" method="POST">

                                    <input type="hidden"
                                           name="users_id"
                                           value="<?php echo $id; ?>">

                                    <div class="form-group">
                                        <label>New Password</label>

                                        <input type="password"
                                               class="form-control"
                                               name="password"
                                               placeholder="Enter new password"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>

                                        <input type="password"
                                               class="form-control"
                                               name="confirm_password"
                                               placeholder="Confirm new password"
                                               required>
                                    </div>

                                    <button type="submit"
                                            class="btn btn-warning">
                                        Change Password
                                    </button>

                                    <a href="users.php"
                                       class="btn btn-secondary">
                                        Cancel
                                    </a>

                                </form>

                            </div>

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