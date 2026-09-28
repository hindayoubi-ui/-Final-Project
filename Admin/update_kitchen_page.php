```php
<?php

// Include the database connection
include("../conn.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the data sent from the form
    $page_id = $_POST['page_id'];
    $title = $_POST['title'];
    $welcome_text = $_POST['welcome_text'];

    // Display the received data for debugging
    // var_dump($page_id);
    // var_dump($title);
    // var_dump($welcome_text);

    // SQL query to update Kitchen Page
    $sql = "UPDATE kitchen_page
            SET title = ?, welcome_text = ?
            WHERE page_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssi", $title, $welcome_text, $page_id);

    if ($stmt->execute()) {

        echo "
        <script>
            alert('✓ Kitchen Page updated successfully!');
            window.location.href = 'admin_kitchen_page.php';
        </script>
        ";

        exit;
    } else {

        die("Error updating Kitchen Page: " . $stmt->error);
    }

    $stmt->close();
}
?>
```