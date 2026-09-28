<?php

session_start();

require('../conn.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include("template/common/head.php"); ?>

<body>

    <div class="container-scroller">

        <!-- Navbar -->
        <?php include("template/common/navbar.php"); ?>

        <div class="container-fluid page-body-wrapper">

            <!-- Sidebar -->
            <?php include("template/common/sidebar.php"); ?>

            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title mb-0">Users</h4>

                                        <button type="button"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addUserModal">
                                            <i class="mdi mdi-account-plus"></i>
                                            Add User
                                        </button>
                                    </div>

                                    <!-- Users Table -->
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php foreach ($users as $user) { ?>

                                                    <tr>

                                                        <td>
                                                            <?php echo htmlspecialchars($user['usersname']); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo htmlspecialchars($user['role']); ?>
                                                        </td>

                                                        <td>
                                                            <?php echo htmlspecialchars($user['created_at']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($user['updated_at'] ?? '-'); ?>
                                                        </td>


                                                        <td>

                                                            <a href="update_form_user.php?id=<?php echo $user['users_id']; ?>"
                                                                class="btn btn-success btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                                Edit
                                                            </a>

                                                            <a href="delete_user.php?id=<?php echo $user['users_id']; ?>"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this user?');">
                                                                <i class="mdi mdi-delete"></i>
                                                                Delete
                                                            </a>

                                                            <a href="update_password.php?id=<?php echo $user['users_id']; ?>"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="mdi mdi-key"></i>
                                                                Password
                                                            </a>

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

                <!-- Footer -->
                <?php include("template/common/footer.php"); ?>

            </div>
            <!-- Main Panel End -->

        </div>
    </div>


    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1"
        aria-labelledby="addUserModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="addUserModalLabel">
                        Add User
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <form action="insert_users.php" method="POST">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Username</label>

                            <input type="text"
                                class="form-control"
                                name="username"
                                placeholder="Enter username"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>

                            <input type="password"
                                class="form-control"
                                name="password"
                                placeholder="Enter password"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Role</label>

                            <select class="form-control"
                                name="role"
                                required>

                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>

                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-primary">
                            Add User
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    <?php include("template/common/script.php"); ?>

</body>

</html>