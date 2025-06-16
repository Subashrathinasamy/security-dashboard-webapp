<?php
header("Content-Type: application/json");
require_once("../includes/db_conn.php");

$data = json_decode(file_get_contents("php://input"), true);

$guard = $data["guard_name"];
$dept = $data["department"];
$dt = $data["datetime"];
$result = $data["scan_result"];
$status = $data["status"];
$location = $data["location"];

$sql = "INSERT INTO scans (guard_name, department, datetime, scan_result, status, location)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $guard, $dept, $dt, $result, $status, $location);

if ($stmt->execute()) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>
