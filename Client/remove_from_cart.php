<?php

include("../conn.php");

if (isset($_GET['id'])) {

    $cart_id = $_GET['id'];

    $sql = "DELETE FROM cart WHERE cart_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {

        header("Location: cart.php");
        exit;

    } else {

        echo "Delete failed: " . $stmt->error;
    }

} else {

    echo "Cart ID is missing.";
}

?>