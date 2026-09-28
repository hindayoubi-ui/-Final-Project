<?php


include("../conn.php");

if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['feedback'])
) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $feedback = trim($_POST['feedback']);

    // Validation

    if (empty($name)) {
        die("Name is required.");
    }

    if (empty($email)) {
        die("Email is required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (empty($feedback)) {
        die("Feedback is required.");
    }


    // Prepare Statement

    $sql = "INSERT INTO contact (name, email, feedback)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    // Bind Parameters

    $stmt->bind_param("sss",$name, $email,$feedback);
        
       
    // Execute

    if ($stmt->execute()) {

        echo "<script>
                alert('Feedback Sent Successfully!');
                window.location.href='contact.php';
              </script>";

    } else {

        echo "Insert failed: " . $stmt->error;

    }

} else {

    echo "Required fields are missing.";

}

?>