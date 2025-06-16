<?php
include 'includes/db.php';

$sql = "SELECT guard_name, department, contact, status FROM guard_settings ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['guard_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['department']) . "</td>";
    echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='4' style='text-align:center;'>No guards found.</td></tr>";
}

$conn->close();
?>
