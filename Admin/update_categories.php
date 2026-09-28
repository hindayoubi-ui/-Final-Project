<?php

include("../conn.php");

if ($_POST) {

    $category_id = (int) $_POST['category_id'];
    $category_name = trim($_POST['category_name']);

    // Check required fields
    if ($category_id <= 0 || $category_name === '') {
        die("Category ID and category name are required.");
    }

    // Check if another category has the same name
    $sql = "SELECT category_id
            FROM categories
            WHERE category_name = ?
            AND category_id != ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "si",
        $category_name,
        $category_id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        die("Category already exists.");

    } else {

        // Update category
        $sql = "UPDATE categories
                SET category_name = ?
                WHERE category_id = ?";

        $updateStmt = $conn->prepare($sql);

        $updateStmt->bind_param(
            "si",
            $category_name,
            $category_id
        );

        if ($updateStmt->execute()) {

            header("Location: categories.php");
            exit;

        } else {

            echo "Error updating category: " . $updateStmt->error;
        }

        $updateStmt->close();
    }

    $stmt->close();
}

?>