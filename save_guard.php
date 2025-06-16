<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $sql = "INSERT INTO guards (name, department, contact, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $department, $contact, $status);

    if ($stmt->execute()) {
        header("Location: guards.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
