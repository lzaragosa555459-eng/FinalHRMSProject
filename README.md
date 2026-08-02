# 💼 Human Resource Management System (HRMS)

A Human Resource Management System (HRMS) built with **Laravel** and **MySQL** to help organizations manage employees, attendance, payroll, and organizational data through a centralized web application.

The system replaces manual paper-based processes with a digital solution that improves efficiency, minimizes data redundancy, and provides role-based access for HR staff and employees.

---

## ✨ Features

### 👨‍💼 HR Administrator
- Dashboard with system statistics
- Employee Management (CRUD)
- Department & Position Management
- Attendance Management
- Payroll Management
- Leave Request Management
- User Management
- Role-Based Access Control

### 👨‍💻 Employee
- Secure Login
- View Personal Information
- View Attendance Records
- View Payroll Information
- Submit Leave Requests

---

## 🛠️ Built With

- Laravel
- PHP
- MySQL
- Blade
- Bootstrap
- JavaScript
- AJAX
- HTML5
- CSS3

---

## 📂 Project Structure

```
app/
database/
public/
resources/
routes/
storage/
```

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/hrms.git
```

### 2. Go to the project directory

```bash
cd hrms
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Install JavaScript dependencies

```bash
npm install
```

### 5. Create the environment file

```bash
cp .env.example .env
```

If you're using Windows:

```bash
copy .env.example .env
```

### 6. Generate the application key

```bash
php artisan key:generate
```

### 7. Configure your database

Open `.env` and update the following:

```env
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Run migrations and seeders

```bash
php artisan migrate --seed
```

### 9. Create the storage link

```bash
php artisan storage:link
```

### 10. Start the development server

```bash
php artisan serve
```

### 11. Run Vite

```bash
npm run dev
```

The application should now be available at:

```
http://127.0.0.1:8000
```

---

## 📸 Screenshots

### Dashboard

<img width="1906" height="1053" alt="Screenshot 2026-04-23 164054" src="https://github.com/user-attachments/assets/af3bb5be-7c1e-42f7-996e-60cdfaad123c" />

### Employee Management

<img width="1902" height="1149" alt="Screenshot 2026-04-23 165503" src="https://github.com/user-attachments/assets/dafb848a-be49-47d4-baed-5920ab3cb689" />

### Payroll

<img width="1918" height="990" alt="Screenshot 2026-05-19 212120" src="https://github.com/user-attachments/assets/4ee1ef58-cc68-4901-aba3-ebcc76cb60e1" />

---

## 📊 Database Design

### Entity Relationship Diagram (ERD)

<img width="1777" height="936" alt="Screenshot 2026-05-20 214736" src="https://github.com/user-attachments/assets/343e4f5d-d7cd-40bc-a036-8b38493a3151" />

---

## 📅 Development Timeline

<img width="1832" height="335" alt="Screenshot 2026-05-20 221501" src="https://github.com/user-attachments/assets/d691c8cb-742b-48b4-89e2-52a0e9622de5" />

---

## 🔐 Default Login

Administrator

```
Email:
admin@example.com

Password:
password
```

Employee

```
Email:
employee@example.com

Password:
password
```

---

## 👨‍💻 Developer

Created by **Liz Zaragosa**

BS Information Technology | Second year Project
