# 🌍 TravelLog – Personal Travel Diary Web App (PHP + MySQL)

TravelLog is a modern, responsive, and user-friendly **travel diary application** built using **PHP, MySQL, TailwindCSS, and HTML**.  
It allows users to record, manage, and revisit all of their travel memories in one place.

This project demonstrates CRUD operations, authentication, UI design, and database connectivity — making it perfect for college submissions and personal portfolios.

---

## 🚀 Features

### 🔒 User Authentication
- Secure registration & login system  
- Password hashing using `password_hash()`  
- Session-based user management  

### 📝 Trip Management (CRUD)
- Add new trips  
- View complete trip details  
- Edit existing trips  
- Delete trips with confirmation  
- Only the owner can edit/delete their trips  

### 🔍 Search System
- Search trips by title or destination  
- Filter results dynamically  

### 🎨 Modern UI (Tailwind CSS)
- Fully responsive layout  
- Orange + Amber modern theme  
- Clean header, footer, cards, and layout  

### 🗂️ Database Design
- `users` table  
- `trips` table with foreign key  
- Proper normalization and indexing  

---

## 🛠️ Tech Stack

| Component | Technology |
|----------|------------|
| Frontend | HTML, TailwindCSS |
| Backend  | PHP |
| Database | MySQL |
| Server   | XAMPP / Apache |
| Version Control | Git & GitHub |

---

## 📂 Project Structure

TravelLog/
│── add_trip.php
│── edit_trip.php
│── delete_trip.php
│── delete_trip_action.php
│── view_trip.php
│── index.php
│── login.php
│── register.php
│── header.php
│── footer.php
│── db.php
│── uploads/ (if enabled for images)
│── README.md

---

## 🗄️ Database Schema

### **Table: users**
```sql
id INT PRIMARY KEY AUTO_INCREMENT
username VARCHAR(255)
email VARCHAR(255)
password VARCHAR(255)

Table: trips
id INT PRIMARY KEY AUTO_INCREMENT
user_id INT (FK → users.id)
title VARCHAR(255)
destination VARCHAR(255)
travel_date DATE
description TEXT


⚙️ How to Run Locally
1️⃣ Install XAMPP
Download & install XAMPP → Start Apache and MySQL.
2️⃣ Move Project to htdocs
Copy the project folder to:
C:/xampp/htdocs/TravelLog/

3️⃣ Create Database
Open in browser:
http://localhost/phpmyadmin/

Create database:
travellog

Import SQL or create tables manually.
4️⃣ Configure Database (db.php)
$host = "127........";
$user = "....";
$pass = "";
$db   = "trav......";
$port = 33..; // If using custom port

5️⃣ Run the Application
In your browser:
http://localhost/TravelLog/


🎉 Screenshots (Optional)
You can add screenshots for better presentation:
/screenshots/homepage.png
/screenshots/add_trip.png
/screenshots/view_trip.png


🔮 Future Enhancements


Image upload for trips


Pagination & filtering


Profile page for users


Travel categories


Dark mode toggle


Admin dashboard



🤝 Contributing
Contributions, issues, and feature requests are welcome!
Feel free to open a pull request.

📄 License
This project is open-source and available under the MIT License.

✨ Author
Satyam Sharma
TravelLog Project — PHP + MySQL + TailwindCSS

