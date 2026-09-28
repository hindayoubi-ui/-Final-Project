```php
<?php

// Include the database connection
include("../conn.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the data sent from the form
    $intro_id = $_POST['intro_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Display the received data for debugging
    // var_dump($intro_id);
    // var_dump($title);
    // var_dump($description);

    // SQL query to update the Home Intro
    $sql = "UPDATE home_intro
            SET title = ?, description = ?
            WHERE intro_id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if prepare failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the values
    // ss = title and description are strings
    // i = intro_id is an integer
    $stmt->bind_param("ssi", $title, $description, $intro_id);

    // Execute the update
    if ($stmt->execute()) {

        echo "
        <script>
            alert('✓ Home Intro updated successfully!');
            window.location.href = 'home_intro.php';
        </script>
        ";

        exit;

    } else {

        die("Error updating Home Intro: " . $stmt->error);

    }

    // Close the statement
    $stmt->close();
}

?>
```
