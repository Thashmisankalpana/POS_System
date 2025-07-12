<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : "";

$sql = "SELECT * FROM stock";
if ($category != "") {
    $sql .= " WHERE category = '$category'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="item-card" data-name="' . $row["name"] . '" data-price="' . $row["price"] . '">
                <img src="' . $row["image_path"] . '" alt="' . $row["name"] . '">
                <p>' . $row["name"] . '</p>
                <p>$' . $row["price"] . '</p>
              </div>';
    }
}

$conn->close();
?>
