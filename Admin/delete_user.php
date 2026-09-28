<?php

require('../conn.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE users_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            echo "<script>
                    alert('User deleted successfully!');
                    window.location.href = 'users.php';
                  </script>";
            exit;

        } else {

            echo "Error deleting user: " . $stmt->error;

        }

    } else {

        echo "Prepare failed: " . $conn->error;

    }

} else {

    echo "User ID is missing.";

}
?>