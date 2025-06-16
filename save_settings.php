<?php
// save_settings.php

include 'includes/db.php'; // adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guard_name = $_POST['guard_name'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    // Simple validation
    if (!empty($guard_name) && !empty($department) && !empty($contact) && !empty($status)) {
        $stmt = $conn->prepare("INSERT INTO guard_settings (guard_name, department, contact, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $guard_name, $department, $contact, $status);

        if ($stmt->execute()) {
            echo "<script>alert('Settings saved successfully!'); window.location.href='settings.html';</script>";
        } else {
            echo "<script>alert('Failed to save settings.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    }

    $conn->close();
} else {
    header("Location: settings.html");
    exit();
}
?>
