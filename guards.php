<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Security Dashboard - Guards</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
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

    /* Guard Table Styling */
    .guard-table-section {
      padding: 20px;
    }
    table.guard-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    table.guard-table th, table.guard-table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    table.guard-table th {
      background-color: #2c3e50;
      color: white;
    }
    .add-button {
      display: inline-block;
      margin: 20px 0;
      padding: 10px 20px;
      background-color:#2c3e50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
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
        <li><a href="scan_reports.php">Reports</a></li>
        <li><a href="departments.html">Departments</a></li>
        <li><a href="guards.php" class="active">Security Guards</a></li>
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
      <li><a href="guards.php" class="active">Security Guards</a></li>
      <li><a href="scan.html">QR Scanner</a></li>
      <li><a href="scan_reports.php">Reports</a></li>
      <li><a href="settings.html">Settings</a></li>
      <li><a href="about.html">About Us</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <section class="guard-table-section">
      <h2 style="text-align: center;">Guard Records</h2>
      <div style="text-align: center;">
        <a href="settings.html" class="add-button">Add New Guard</a>
      </div>

      <table class="guard-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Guard Name</th>
            <th>Department</th>
            <th>Contact</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM guards";
        $result = $conn->query($sql);
        if ($result->num_rows > 0):
          while($row = $result->fetch_assoc()):
        ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['contact']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
          </tr>
        <?php
          endwhile;
        else:
        ?>
          <tr><td colspan="5">No records found</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>

  <footer style="background-color: #2c3e50; color: #ffffffcc; text-align: center; padding: 20px 15px; font-size: 0.9rem; position: relative; bottom: 0; width: 100%; box-shadow: inset 0 1px 0 #3f5168;">
    <p>&copy; 2025 <strong>KOSO India Pvt. Ltd.</strong> All rights reserved.</p>
    <p style="margin-top: 5px; font-size: 0.8rem; color: #ffffff88;">Designed &amp; Developed with ❤️ by KOSO IT Team</p>
  </footer>

  <!-- Scripts -->
  <script src="assets/js/script.js"></script>
  <script>
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
      alert('Logging out...');
    });
  </script>

</body>
</html>
