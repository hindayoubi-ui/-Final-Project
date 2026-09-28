<?php

require('../conn.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE users_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

} else {

    echo "User ID is missing.";
    exit;

}
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

                    <div class="col-md-8 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Edit User</h4>

                                <form action="update_user.php" method="POST">

                                    <input type="hidden"
                                           name="users_id"
                                           value="<?php echo $user['users_id']; ?>">

                                    <div class="form-group">
                                        <label>Username</label>

                                        <input type="text"
                                               class="form-control"
                                               name="username"
                                               value="<?php echo htmlspecialchars($user['usersname']); ?>"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>

                                        <select class="form-control"
                                                name="role"
                                                required>

                                            <option value="admin"
                                                <?php if ($user['role'] == 'admin') echo 'selected'; ?>>
                                                Admin
                                            </option>

                                            <option value="user"
                                                <?php if ($user['role'] == 'user') echo 'selected'; ?>>
                                                User
                                            </option>

                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="btn btn-warning">
                                        Update User
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