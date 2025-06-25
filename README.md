# TravelLog
# 🧭 TravelLog: Discover, Share & Record Your Journeys

TravelLog is a lightweight, responsive PHP-based web application that allows users to register, log in, add personal travel logs (trip title, destination, date, description), and view a shared feed of all travel stories.

---

## 📌 Features

- ✅ User registration and login system (with password hashing)
- ✅ Add and store personal travel logs
- ✅ View travel entries from all users
- ✅ Responsive design using Tailwind CSS CDN
- ✅ Session management with login-based access control
- ✅ Built with PHP and MySQL (port 3307 support)

---

## 📁 Folder Structure

TravelLog/
│
├── db.php # Database connection file
├── header.php # Navigation bar (included in all pages)
├── index.php # Home page displaying all trips
├── register.php # User registration
├── login.php # User login
├── logout.php # User logout
└── add_trip.php # Add a new travel log

sql
Copy
Edit

---

## 🛠️ Local Setup Instructions (Using XAMPP)

### 1. Start Apache & MySQL (XAMPP Control Panel)
- Ensure **MySQL is running on port 3307** (change in `db.php` if needed)

### 2. Place Files
- Extract or clone all files into:  
  `C:\xampp\htdocs\TravelLog\`

### 3. Create Database

Open [http://localhost:3307/phpmyadmin](http://localhost:3307/phpmyadmin)  
Run this SQL in the **SQL tab**:

```sql
CREATE DATABASE travellog;

USE travellog;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255)
);

CREATE TABLE trips (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255),
  destination VARCHAR(255),
  travel_date DATE,
  description TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
4. Launch the Website
Open your browser and visit:

arduino
Copy
Edit
http://localhost:3307/TravelLog/
🔐 Default Configuration (db.php)
php
Copy
Edit
$host = "127.0.0.1";
$user = "root";
$pass = "";          // empty unless you set a password
$db   = "travellog";
$port = 3307;
📸 Screenshots
(Include screenshots of: login, register, add trip, view trips)

📈 Future Features (Optional)
Image uploads for trips

Search and filter by location

User profile pages

Edit/Delete trip entries

Google Maps integration

🙏 Credits
PHP & MySQL

Tailwind CSS via CDN

XAMPP

ChatGPT by OpenAI (assisted in code generation & documentation)

📝 License
This project is created for educational purposes and university project submission. You are free to modify and reuse it for non-commercial use.
