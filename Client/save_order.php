
<?php

include("../conn.php");

if (
    isset($_POST['name']) &&
    isset($_POST['location']) &&
    isset($_POST['date']) &&
    isset($_POST['time']) &&
    isset($_POST['quantity'])
) {

    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $quantity = $_POST['quantity'];

    // Validation

    if (empty($name)) {
        die("Name is required.");
    }

    if (empty($location)) {
        die("Location is required.");
    }

    if (empty($date)) {
        die("Date is required.");
    }

    if (empty($time)) {
        die("Time is required.");
    }

    if (empty($quantity) || $quantity < 1) {
        die("Quantity must be at least 1.");
    }

    // Prepare Statement

    $sql = "INSERT INTO orders
            (name, location, date, time, quantity)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind Parameters

    $stmt->bind_param(
        "ssssi",
        $name,
        $location,
        $date,
        $time,
        $quantity
    );

    // Execute

    if ($stmt->execute()) {

        echo "<script>
                alert('Order Placed Successfully!');
                window.location.href='products.php';
              </script>";

    } else {

        echo "Insert failed: " . $stmt->error;
    }

} else {

    echo "Required fields are missing.";
}

?>

