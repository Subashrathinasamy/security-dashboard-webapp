# Security Dashboard Web Application

## Overview
This is a web-based Security Dashboard designed for monitoring and managing security patrols in an industrial environment. The application includes features such as:

- QR Code scanning for logging security checks  
- Department-wise patrol tracking  
- Reports showing recent scans and patrol status  
- Security guards management  
- Settings and About Us pages  
- Responsive design for desktop and mobile use  

## Features

- **QR Scanner:** Uses the device camera to scan QR codes presented by security staff at different departments.
- **Scan Logs:** Stores scan results locally (using browser LocalStorage) and displays them in the Reports section.
- **Dashboard:** Displays summary statistics including number of departments, security guards, completed patrols, and missed scans.
- **Responsive UI:** Clean layout with navbar, sidebar, and a main content area for different pages.
- **Modular Components:** Each section has its own HTML file. Consistent layout is maintained using a single CSS file.

## Technologies Used

- HTML5, CSS3, JavaScript (ES6)  
- [html5-qrcode](https://github.com/mebjas/html5-qrcode) for QR scanning  
- Chart.js for patrol status graphs  
- PHP & MySQL for backend database (scan saving, guard login, report fetching)

## Project Structure

├── index.html # Main dashboard
├── scan.html # QR Code scanner interface
├── reports.html # Scan reports and patrol status
├── settings.html # Add/Edit security guards and settings
├── guards.html # Display guard information
├── about.html # About KOSO India Steel Foundry
├── landing.html # Landing page for the application
│
├── css/
│ └── style.css # Central stylesheet
│
├── js/
│ └── script.js # All JavaScript functions and QR scanner logic
│
├── php/
│   ├── save_scan.php          # Backend to store scanned data
│   ├── fetch_reports.php      # Fetch scan data for reports
│   ├── login.php              # Guard login authentication
│   ├── logout.php             # Logout script
│   └── includes/
│       └── db.php             # MySQL database connection
│
├── img/ # Images, logos, icons
├── README.md # Project readme


## Usage

1. Launch `index.html` to open the dashboard.
2. Go to `scan.html` to scan QR codes with your device's camera.
3. View patrol scan history and status in `reports.html`.
4. Use the sidebar to access other pages: guards, settings, about, and departments.

## Notes

- Initially, scan data is saved in LocalStorage (offline).  
- When hosted with XAMPP or any PHP server, scan results are saved in a database via backend PHP.
- Compatible with desktops and mobile browsers.  
- Use of charts and dynamic tables gives a clear visual of patrol activity.

## Future Improvements

- Add admin login and user authentication system.
- Export reports to PDF/Excel.
- Add missed-scan alerts and department-wise filters.
- Integrate GPS tracking with scanned logs.
- Deploy project online with secure domain and HTTPS.

## Author

Subash R  
subashrathinasamy4@gmail.com  

## License

This project is licensed under the MIT License.
> This project was developed as part of an industrial training program at KOSO India Steel Foundry.

