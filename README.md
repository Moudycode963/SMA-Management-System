# 🛡️ Security Shift Management System

![PHP Version](https://img.shields.io/badge/php-8.2-777BB4?style=flat&logo=php)
![Database](https://img.shields.io/badge/mysql-8.0-4479A1?style=flat&logo=mysql)
![Docker](https://img.shields.io/badge/docker-compose-2496ED?style=flat&logo=docker)
![Status](https://img.shields.io/badge/status-beta-orange)

## 📖 About The Project

This project addresses common challenges in the security industry: unclear shift planning, lack of attendance verification, and inefficient communication during emergencies.

The system consists of two main components:
1.  **Management Dashboard:** A web interface for CEOs/Planners to assign shifts, view live personnel locations on a map, and manage incidents.
2.  **Employee Mobile App:** A web-based mobile view for security guards to view schedules, check in via GPS verification, and trigger SOS alerts.

> **Note for Recruiters:** This project was built without a heavy framework (like Laravel) to demonstrate a deep understanding of **Core PHP**, **OOP Patterns**, **MVC Architecture**, and **Clean Code** principles.

---

## 🚀 Key Features

### 👮 For Security Guards (Mobile Web App)
* **Secure Login:** Role-based authentication.
* **GPS-Verified Check-in:** Clocking in is restricted to a **50m radius** of the assigned location.
* **SOS Panic Button:** Instantly triggers a red alert on the dashboard with real-time coordinates.
* **Shift History:** Overview of upcoming and past shifts.

### 🏢 For Management (Dashboard)
* **Live Map View:** Real-time tracking of all active guards using Google Maps API.
* **Status Indicators:** Visual feedback for On-Site (Green), Late (Yellow), SOS (Red), and Offline (Gray).
* **Shift Planning:** Drag-and-drop style allocation of shifts to personnel.
* **Automated Alerts:** Notifications for missed check-ins or emergencies.

---

## 🛠️ Technical Stack

This project follows a strict **MVC (Model-View-Controller)** architectural pattern.

* **Backend:** PHP 8.2 (Native, OOP-heavy)
* **Database:** MySQL 8.0
* **Frontend:** HTML5, CSS3, Vanilla JavaScript
* **API:** Google Maps Platform
* **Infrastructure:** Docker & Docker Compose (Apache Webserver)
* **Dependency Management:** Composer (PSR-4 Autoloading)

### Design Patterns Used
* **Singleton Pattern:** Used for the Database connection to ensure resource efficiency.
* **MVC Pattern:** Separation of business logic (Controllers), data access (Models), and UI (Views).
* **Dependency Injection:** (Planned/Implemented) for better testability.

---

## 🐳 Getting Started (Docker)

To run this project locally, you need Docker and Docker Compose installed.

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/YOUR_USERNAME/security-project.git](https://github.com/YOUR_USERNAME/security-project.git)
    cd security-project
    ```

2.  **Configure Environment**
    Copy the example environment file and add your database credentials and Google Maps API key.
    ```bash
    cp .env.example .env
    ```

3.  **Start Containers**
    Build and run the application.
    ```bash
    docker-compose up -d --build
    ```

4.  **Access the Application**
    * **Web App:** `http://localhost:8080`
    * **phpMyAdmin:** `http://localhost:8081`

---

## 📂 Project Structure

```text
/app
├── Config/         # Database & App Configuration
├── Controllers/    # Logic handling (MVC)
├── Models/         # Data Access Objects
├── Views/          # HTML Templates
/docker             # Docker configuration files
/public             # Web root (Entry point)
