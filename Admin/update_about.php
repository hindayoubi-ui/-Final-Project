
<?php
include("../conn.php");

if (
    isset($_POST['about_id']) &&
    isset($_POST['title']) &&
    isset($_POST['english_text']) &&
    isset($_POST['arabic_text']) &&
    isset($_POST['french_text']) &&
    isset($_POST['quote_english']) &&
    isset($_POST['quote_arabic']) &&
    isset($_POST['quote_french'])
) {

    $about_id = $_POST['about_id'];
    $title = $_POST['title'];
    $english_text = $_POST['english_text'];
    $arabic_text = $_POST['arabic_text'];
    $french_text = $_POST['french_text'];
    $quote_english = $_POST['quote_english'];
    $quote_arabic = $_POST['quote_arabic'];
    $quote_french = $_POST['quote_french'];

    $sql = "UPDATE about_page
            SET title = ?,
                english_text = ?,
                arabic_text = ?,
                french_text = ?,
                quote_english = ?,
                quote_arabic = ?,
                quote_french = ?
            WHERE about_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssssi",
        $title,
        $english_text,
        $arabic_text,
        $french_text,
        $quote_english,
        $quote_arabic,
        $quote_french,
        $about_id
    );

    if ($stmt->execute()) {

        echo "<script>
            alert('Updated Successfully!');
            window.location.href='admin_about.php';
          </script>";
    } else {

        echo "Update failed: " . $stmt->error;
    }
} else {

    echo "Missing required fields.";
}
?>