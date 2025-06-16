<?php
header('Content-Type: application/json');

// Include database connection
require_once '../includes/db.php';

// Get the JSON body from POST
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    isset($data['guard_name']) && isset($data['department']) &&
    isset($data['datetime']) && isset($data['scan_result']) &&
    isset($data['status']) && isset($data['location'])
) {
    $guard_name = $conn->real_escape_string($data['guard_name']);
    $department = $conn->real_escape_string($data['department']);
    $datetime = $conn->real_escape_string($data['datetime']);
    $scan_result = $conn->real_escape_string($data['scan_result']);
    $status = $conn->real_escape_string($data['status']);
    $location = $conn->real_escape_string($data['location']);

    $sql = "INSERT INTO scan_reports (guard_name, department, datetime, scan_result, status, location)
            VALUES ('$guard_name', '$department', '$datetime', '$scan_result', '$status', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Incomplete data"]);
}

$conn->close();
?>
fetch('save_scan.php', {
  method: 'POST',
  ...
})
