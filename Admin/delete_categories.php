<?php

include("../conn.php");

if (isset($_GET['category_id'])) {

    $category_id = (int) $_GET['category_id'];

    $sql = "DELETE FROM categories WHERE category_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $category_id);

    if ($stmt->execute()) {

        header("Location: categories.php");
        exit;
    } else {

        echo "Error deleting category: " . $stmt->error;
    }

    $stmt->close();
} else {

    die("Category ID not provided.");
}
