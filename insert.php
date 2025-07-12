<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Handle file upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if not exists
    }
    $imageName = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . time() . "_" . $imageName; // Unique name

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO stock (category, name, price, image_path) VALUES ('$category', '$name', '$price', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "Stock item inserted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

$conn->close();
?>