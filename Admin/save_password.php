<?php

require('../conn.php');

if (
    isset($_POST['users_id']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm_password'])
) {

    $id = $_POST['users_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check passwords
    if ($password !== $confirm_password) {
        echo "<script>
                alert('Passwords do not match!');
                window.history.back();
              </script>";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users
        SET password = ?, updated_at = CURRENT_TIMESTAMP
        WHERE users_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("si", $hashed_password, $id);

        if ($stmt->execute()) {

            echo "<script>
                    alert('Password updated successfully!');
                    window.location.href = 'users.php';
                  </script>";
            exit;
        } else {

            echo "Error updating password: " . $stmt->error;
        }
    } else {

        echo "Prepare failed: " . $conn->error;
    }
} else {

    echo "Please fill all fields.";
}
