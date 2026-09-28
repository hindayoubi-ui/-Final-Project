<?php

require('../conn.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (usersname, password, role)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {

            echo "<script>
        alert('User added successfully!');
        window.location.href = 'users.php';  </script>";
    
            exit;

        } else {
            echo "Error adding user: " . $stmt->error;
        }
    } else {
        echo "Prepare failed: " . $conn->error;
    }
} else {
    echo "Please fill all fields.";
}
