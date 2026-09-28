<?php

require('../conn.php');

if (
    isset($_POST['users_id']) &&
    isset($_POST['username']) &&
    isset($_POST['role'])
) {

    $id = $_POST['users_id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users
            SET usersname = ?, role = ?
            WHERE users_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("ssi", $username, $role, $id);

        if ($stmt->execute()) {

            echo "<script>
                    alert('User updated successfully!');
                    window.location.href = 'users.php';
                  </script>";
            exit;

        } else {

            echo "Error updating user: " . $stmt->error;

        }

    } else {

        echo "Prepare failed: " . $conn->error;

    }

} else {

    echo "Please fill all fields.";

}
?>