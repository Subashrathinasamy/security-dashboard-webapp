<?php
include("includes/db_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Patrol & Scan Reports</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    /* Navbar right buttons */
    .navbar-right {
      position: relative;
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .navbar-right button {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      position: relative;
    }
    /* Dropdown menu style */
    .dropdown-content {
      position: absolute;
      top: 40px;
      right: 0;
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: 220px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      padding: 10px;
      z-index: 1000;
      display: none;
    }
    .dropdown-content a, .dropdown-content p {
      display: block;
      padding: 8px 12px;
      color: #333;
      text-decoration: none;
      cursor: pointer;
      font-size: 0.9rem;
    }
    .dropdown-content a:hover {
      background-color: #f0f0f0;
    }
    .dropdown-content.visible {
      display: block;
    }
    /* Report title styling */
    .report-title {
      font-size: 26px;
      font-weight: bold;
      margin: 30px 0 20px;
      color: #2c3e50;
      text-align: center;
    }
    /* Table styling */
    table {
      width: 95%;
      margin: 0 auto 40px;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #2c3e50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    /* Form styling */
    form {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="date"] {
      padding: 6px 10px;
      margin: 0 8px;
    }
    button[type="submit"] {
      padding: 6px 12px;
      background-color: green;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <h2 onclick="location.href='landing.html'" style="color: red; font-weight: 900; font-size: 24px; cursor: pointer;">KOSO</h2>
    </div>
    <nav class="top-nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="scan_reports.php" class="active">Reports</a></li>
        <li><a href="departments.html">Departments</a></li>
        <li><a href="guards.php">Security Guards</a></li>
        <li><a href="settings.html">Settings</a></li>
        <li><a href="about.html">About Us</a></li>
      </ul>
    </nav>
    <div class="navbar-right">
      <button id="notification-btn" title="Notifications">🔔</button>
      <div id="notification-dropdown" class="dropdown-content">
        <p>No new notifications.</p>
      </div>
      <button id="user-btn" title="User Profile">👤</button>
      <div id="user-dropdown" class="dropdown-content">
        <a href="#">Profile</a>
        <a href="#">Settings</a>
        <a href="#" id="logout-btn">Logout</a>
      </div>
    </div>
  </header>

  <!-- Sidebar -->
  <aside class="sidebar">
    <ul>
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="departments.html">Departments</a></li>
      <li><a href="guards.php">Security Guards</a></li>
      <li><a href="scan.html">QR Scanner</a></li>
      <li><a href="scan_reports.php" class="active">Reports</a></li>
      <li><a href="settings.html">Settings</a></li>
      <li><a href="about.html">About Us</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="report-title">Scan Reports</div>

    <!-- Search Form -->
    <form method="GET">
      <label for="start_date">From:</label>
      <input type="date" name="start_date" id="start_date" required value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">
      <label for="end_date">To:</label>
      <input type="date" name="end_date" id="end_date" required value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">
      <button type="submit">Search</button>
    </form>

    <!-- Reports Table -->
    <table>
      <tr>
        <th>GUARD NAME</th>
        <th>DEPARTMENT</th>
        <th>DATE & TIME</th>
        <th>SCAN RESULT</th>
        <th>STATUS</th>
        <th>LOCATION</th>
      </tr>

      <?php
      // Prepare SQL query based on date filters
      if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
          $start_date = $conn->real_escape_string($_GET['start_date']);
          $end_date = $conn->real_escape_string($_GET['end_date']);

          // Validate dates for safety (basic check)
          if (strtotime($start_date) && strtotime($end_date) && $start_date <= $end_date) {
              $sql = "SELECT * FROM scan_reports WHERE DATE(datetime) BETWEEN '$start_date' AND '$end_date' ORDER BY datetime DESC";
          } else {
              echo "<tr><td colspan='6'>Invalid date range selected.</td></tr>";
              $sql = null;
          }
      } else {
          $sql = "SELECT * FROM scan_reports ORDER BY datetime DESC";
      }

      if ($sql) {
          $result = $conn->query($sql);
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                      <td>" . htmlspecialchars($row['guard_name']) . "</td>
                      <td>" . htmlspecialchars($row['department']) . "</td>
                      <td>" . htmlspecialchars($row['datetime']) . "</td>
                      <td>" . htmlspecialchars($row['scan_result']) . "</td>
                      <td>" . htmlspecialchars($row['status']) . "</td>
                      <td>" . htmlspecialchars($row['location']) . "</td>
                  </tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No scan data found for the selected dates.</td></tr>";
          }
      }
      ?>
    </table>
  </main>

  <!-- Scripts -->
  <script src="assets/js/script.js"></script>
  <script>
    // Dropdown toggling scripts
    const notificationBtn = document.getElementById('notification-btn');
    const userBtn = document.getElementById('user-btn');
    const notificationDropdown = document.getElementById('notification-dropdown');
    const userDropdown = document.getElementById('user-dropdown');

    notificationBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      notificationDropdown.classList.toggle('visible');
      userDropdown.classList.remove('visible');
    });

    userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      userDropdown.classList.toggle('visible');
      notificationDropdown.classList.remove('visible');
    });

    window.addEventListener('click', () => {
      notificationDropdown.classList.remove('visible');
      userDropdown.classList.remove('visible');
    });

    document.getElementById('logout-btn').addEventListener('click', (e) => {
      e.preventDefault();
      alert("Logging out...");
      // Add your logout code here
    });
  </script>
</body>
</html>
