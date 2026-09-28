<?php

include("../conn.php");

if (
    isset($_GET['type']) &&
    isset($_GET['id'])
) {

    $type = $_GET['type'];
    $id = $_GET['id'];


    // Kitchen Product
    if ($type == "kitchen") {

        $sql = "SELECT * FROM kitchen WHERE kitchen_id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows > 0) {

            $product = $result->fetch_assoc();


            // Insert product into cart
            $insert_sql = "INSERT INTO cart
                           (product_type, product_id, product_name, price, image, quantity)
                           VALUES (?, ?, ?, ?, ?, ?)";

            $insert_stmt = $conn->prepare($insert_sql);

            if (!$insert_stmt) {
                die("Prepare failed: " . $conn->error);
            }


            $quantity = 1;

            $insert_stmt->bind_param(
                "sisdsi",
                $type,
                $product['kitchen_id'],
                $product['kname'],
                $product['price'],
                $product['k_image'],
                $quantity
            );


            if ($insert_stmt->execute()) {

                header("Location: cart.php");
                exit;

            } else {

                echo "Insert failed: " . $insert_stmt->error;
            }

        } else {

            echo "Product not found.";
        }

    } else {

        echo "Invalid product type.";
    }

} else {

    echo "Required fields are missing.";
}

?>