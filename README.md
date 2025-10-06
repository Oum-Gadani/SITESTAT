# SiteStat - Website Uptime Monitoring Tool

SiteStat is a self-hosted website monitoring tool that provides a user-friendly dashboard to track the status of your websites. It features a PHP-based frontend for managing sites and users, and a powerful Node.js backend service that continuously checks your websites and sends email notifications when their status changes.

This project was developed as a college semester project by students of VPMP Polytechnic.

## Features

*   **User Authentication:** Secure user registration and login system.
*   **Monitoring Dashboard:** A clean interface to view the current status (UP/DOWN) of all your websites in real-time.
*   **TCP Ping Monitoring:** The backend service uses TCP pings to reliably check if a specific port on a website is open and responsive.
*   **Performance Metrics:** Calculates and displays minimum, maximum, and average response times for your sites.
*   **Automated Email Alerts:** Sends instant email notifications when a monitored site goes down or comes back up.
*   **Multi-Site & Multi-Email Support:**
    *   Add and manage multiple websites and specific ports to monitor.
    *   Manage a list of multiple email recipients who will receive status alerts.
*   **Downtime History:** Logs all downtime events with start and end times, and calculates the total duration of each outage.

## Technology Stack

*   **Frontend:** HTML, CSS, JavaScript, jQuery, Bootstrap
*   **Backend (Web Server):** WAMP/LAMP/MAMP (Apache, **MySQL**, **PHP**)
*   **Backend (Monitoring Service):** **Node.js**
    *   **Key Node.js Libraries:** `express`, `mysql`, `tcp-ping`, `nodemailer`.

## Prerequisites

Before you begin, ensure you have the following software installed on your machine:

1.  **A WAMP, LAMP, or MAMP Stack:** This is required to run the PHP web dashboard.
    *   [WampServer](https://www.wampserver.com/en/) (for Windows)
    *   [XAMPP](https://www.apachefriends.org/) (Cross-platform)
    *   [MAMP](https://www.mamp.info/en/mamp/) (for macOS)
2.  **Node.js and npm:** This is required to run the backend monitoring service.
    *   [Download Node.js](https://nodejs.org/)

## Setup and Installation

Follow these steps to get your SiteStat instance up and running.

### 1. Web Server and Project Files

1.  **Download/Clone the Repository:**
    ```bash
    git clone https://github.com/Oum-Gadani/SITESTAT.git
    ```
2.  **Move Files to Web Server:**
    Copy all the project files into your web server's root directory. This is typically `www` in WampServer or `htdocs` in XAMPP.

### 2. Database Setup

The project requires a MySQL database named `sitestat`.

1.  **Start MySQL:** Ensure the MySQL service from your WAMP/LAMP/XAMPP control panel is running.
2.  **Create the Database:** Open a database management tool like phpMyAdmin and create a new database with the name `sitestat`.
3.  **Create Tables:** Execute the following SQL script in your new `sitestat` database to create the necessary tables.

    ```sql
    --
    -- Table structure for table `users`
    --
    CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(50) NOT NULL,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `last_login` datetime DEFAULT NULL,
      `data_created` datetime NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    --
    -- Table structure for table `sites`
    --
    CREATE TABLE `sites` (
      `id` int(11) NOT NULL,
      `site` varchar(255) NOT NULL,
      `status` tinyint(1) NOT NULL DEFAULT 0,
      `maxMs` float DEFAULT 0,
      `minMs` float DEFAULT 0,
      `avgMs` float DEFAULT 0,
      `port` int(5) NOT NULL DEFAULT 80,
      KEY `id` (`id`),
      CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    --
    -- Table structure for table `mails`
    --
    CREATE TABLE `mails` (
      `id` int(11) NOT NULL,
      `mail` varchar(100) NOT NULL,
      KEY `id` (`id`),
      CONSTRAINT `mails_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    --
    -- Table structure for table `sitelog`
    --
    CREATE TABLE `sitelog` (
      `No` int(11) NOT NULL AUTO_INCREMENT,
      `id` int(11) NOT NULL,
      `site` varchar(255) NOT NULL,
      `port` int(5) NOT NULL,
      `downtime` datetime NOT NULL,
      `uptime` datetime DEFAULT NULL,
      `days` int(11) DEFAULT 0,
      `hours` int(11) DEFAULT 0,
      `minutes` int(11) DEFAULT 0,
      `seconds` int(11) DEFAULT 0,
      PRIMARY KEY (`No`),
      KEY `id` (`id`),
      CONSTRAINT `sitelog_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

### 3. Configure the Application

You need to update the database and email credentials in a few files.

1.  **PHP Database Connection:**
    *   Open `dbconnect.php`.
    *   If your MySQL username and password are not the default (`root` and empty), update this line:
        ```php
        $GLOBALS['db'] = mysqli_connect('localhost', 'your_username', 'your_password', 'sitestat');
        ```

2.  **Node.js Database Connection:**
    *   Open `ping/connection.js`.
    *   Update the connection details if needed:
        ```javascript
        var connection = mysql.createConnection({
            host: "localhost",
            user: "your_username",
            password: "your_password",
            database: "sitestat"
        });
        ```

3.  **Email Notifier Configuration (Very Important!):**
    *   Open `ping/mailTran.js`.
    *   You **must** update the `mtUser` and `mtPass` with your own email credentials.
    *   **For Gmail:** It is highly recommended to use an "App Password" instead of your regular password for security. You can generate one here: [Google App Passwords](https://myaccount.google.com/apppasswords).
        ```javascript
        var mailTran =
        {
            // ... other settings
            mtUser: 'your-email@gmail.com',   // CHANGE THIS
            mtPass: 'your-16-digit-app-password', // CHANGE THIS
            // ... other settings
        }
        ```

### 4. Install Node.js Dependencies

1.  Open your command prompt or terminal.
2.  Navigate to the `ping` directory inside your project folder:
    ```bash
    cd path/to/your/project/ping
    ```
3.  Run the following command to install all the required Node.js packages:
    ```bash
    npm install
    ```

## Running the Application

To use SiteStat, both the web server and the Node.js service must be running.

1.  **Start your WAMP/LAMP/XAMPP server.** Make sure Apache and MySQL are running.
2.  **Run the Node.js Monitoring Service:**
    *   Open a new terminal or command prompt.
    *   Navigate to the `ping` directory again.
    *   Start the service with the following command:
        ```bash
        node ping.js
        ```
    *   This terminal window must remain open for the monitoring service to continue running. For a more permanent solution, you can use a process manager like [PM2](https://pm2.keymetrics.io/).

3.  **Access the Dashboard:**
    *   Open your web browser and navigate to `http://localhost/your-project-folder/`.
    *   You can now sign up for an account, add sites to monitor, and add email addresses for notifications. The dashboard will automatically reflect the status changes detected by the `ping.js` service.

## Author

This project was created by Oum Gadani.

*   **LinkedIn:** [https://www.linkedin.com/in/oumgadani/](https://www.linkedin.com/in/oumgadani/)

## License

This project is licensed under the Apache License 2.0. See the `LICENSE` file for more details.