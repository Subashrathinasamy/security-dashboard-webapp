<?php
include("includes/db.php");

// Query to count the guards
$sql = "SELECT COUNT(*) as guard_count FROM guards";
$result = $conn->query($sql);
$guard_count = 0;
if ($result) {
  $row = $result->fetch_assoc(); 
  $guard_count = $row['guard_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Security Dashboard - Home</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @keyframes fadein {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadein 1s ease-in;
    }

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

    .dashboard-summary {
      margin: 40px auto;
      background: #f9f9f9;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #2c3e50;
      max-width: 700px;
      line-height: 1.6;
      user-select: none;
      box-sizing: border-box;
    }

    .dashboard-summary h2 {
      font-size: 1.9rem;
      font-weight: 900;
      margin-bottom: 20px;
      color: rgb(38, 43, 81);
      text-shadow: 1px 1px 3px rgba(41, 36, 197, 0.1);
    }

    .dashboard-summary p {
      font-size: 1.1rem;
      margin-bottom: 25px;
      color: #34495e;
    }

    .dashboard-summary ul {
      padding-left: 25px;
      font-size: 1.1rem;
      color: #34495e;
      list-style: none;
    }

    .dashboard-summary ul li {
      margin-bottom: 15px;
      position: relative;
      padding-left: 30px;
      font-weight: 600;
    }

    .dashboard-summary ul li::before {
      content: "✅";
      position: absolute;
      left: 0;
      top: 0;
      font-size: 1.3rem;
      line-height: 1;
      color: #27ae60;
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
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="scan_reports.php">Reports</a></li>
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
      <li><a href="index.php" class="active">Dashboard</a></li>
      <li><a href="departments.html">Departments</a></li>
      <li><a href="guards.php">Security Guards</a></li>
      <li><a href="scan.html">QR Scanner</a></li>
      <li><a href="scan_reports.php">Reports</a></li>
      <li><a href="settings.html">Settings</a></li>
      <li><a href="about.html">About Us</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content fade-in">
    <section class="welcome-section fade-in">
      <h1>Welcome Back!</h1>
      <p>Here's your security patrol overview for today.</p>
    </section>

    <section class="stats-cards fade-in">
      <div class="card">
        <h3>Departments</h3>
        <p id="departments-count">7</p>
      </div>
      <div class="card">
        <h3>Security Guards</h3>
        <p id="guards-count"><?php echo $guard_count; ?></p>
      </div>
      <div class="card">
        <h3>Missed Scans</h3>
        <p id="missed-scans">--</p>
      </div>
    </section>

    <section class="dashboard-summary fade-in">
      <h2>Welcome to KOSO Security Dashboard</h2>
      <p>This portal provides a centralized system for monitoring the daily operations of security patrols across departments.</p>
      <ul>
        <li>Track security guard activity in real-time</li>
        <li>Monitor department-wise coverage and missed scans</li>
        <li>Access detailed scan reports and export them</li>
        <li>Maintain updated guard and department profiles</li>
      </ul>
    </section>
  </main>

  <!-- Footer -->
  <footer style="
    background-color: #2c3e50;
    color: #ffffffcc;
    text-align: center;
    padding: 20px 15px;
    font-size: 0.9rem;
    position: relative;
    bottom: 0;
    width: 100%;
    box-shadow: inset 0 1px 0 #3f5168;
    font-family: Arial, sans-serif;
    user-select: none;
  ">
    <p>&copy; 2025 <strong>KOSO India Pvt. Ltd.</strong> All rights reserved.</p>
    <p style="margin-top: 5px; font-size: 0.8rem; color: #ffffff88;">
      Designed &amp; Developed with ❤️ by KOSO IT Team
    </p>
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

    function handleLogout() {
      alert('Logging out...');
    }

    document.getElementById('logout-btn').addEventListener('click', (e) => {
      e.preventDefault();
      handleLogout();
    });
  </script>

</body>
</html>
