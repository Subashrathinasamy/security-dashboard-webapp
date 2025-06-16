// script.js

document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.querySelector('.sidebar');
  const mainContent = document.querySelector('.main-content');

  // Create sidebar toggle button dynamically and add it to navbar
  const navbar = document.querySelector('.navbar');
  const toggleBtn = document.createElement('button');
  toggleBtn.id = 'sidebarToggle';
  toggleBtn.title = 'Toggle Sidebar';
  toggleBtn.innerHTML = '☰';
  toggleBtn.style.fontSize = '1.5rem';
  toggleBtn.style.marginLeft = '1rem';
  toggleBtn.style.background = 'none';
  toggleBtn.style.border = 'none';
  toggleBtn.style.color = 'white';
  toggleBtn.style.cursor = 'pointer';
  navbar.insertBefore(toggleBtn, navbar.children[1]); // insert after logo

  // Sidebar toggle handler
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
  });

  // Optional: show a greeting based on time
  const welcomeSection = document.querySelector('.welcome-section h1');
  if (welcomeSection) {
    const hour = new Date().getHours();
    let greeting = 'Welcome Back!';
    if (hour < 12) greeting = 'Good Morning!';
    else if (hour < 18) greeting = 'Good Afternoon!';
    else greeting = 'Good Evening!';
    welcomeSection.textContent = greeting;
  }

  // Logout button placeholder
  const logoutBtn = document.getElementById('logout-btn');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', (e) => {
      e.preventDefault();
      alert('Logout functionality will be implemented here.');
      // Add your logout logic here
    });
  }
});
