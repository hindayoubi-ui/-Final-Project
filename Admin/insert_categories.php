<?php

// Connect to database
include("../conn.php");

session_start();

$users_id = $_SESSION['users_id'];

// Check if category name was submitted
if (isset($_POST['category_name'])) {

    // Get category name and remove extra spaces
    $category_name = trim($_POST['category_name']);

    // Check if category name is empty
    if ($category_name === '') {

        die("Category name is required.");
    }

    // Check if category already exists
    $sql = "SELECT category_id
            FROM categories
            WHERE category_name = ?";

    $stmt = $conn->prepare($sql);

    // var_dump($stmt);
    // exit;

    $stmt->bind_param("s", $category_name);

    $stmt->execute();

    $result = $stmt->get_result();

    // var_dump($result);
    // exit;

    // If category already exists
    if ($result->num_rows > 0) {

        die("Category already exists.");

    } else {

        // Insert new category
        $sql = "INSERT INTO categories (category_name, users_id)
                VALUES (?, ?)";

        $insertStmt = $conn->prepare($sql);

        // var_dump($insertStmt);
        // exit;

        $insertStmt->bind_param("si", $category_name, $users_id);

        // var_dump($category_name);
        // var_dump($users_id);
        // exit;

        // Execute insert
        if ($insertStmt->execute()) {

            // Display success message
            echo "Category added successfully!";

        } else {

            // Display error message if the insert fails
            echo "Error adding category: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $stmt->close();
}

?>