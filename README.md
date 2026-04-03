**README.md** style:

---

# 📘 Human Resource Management System (HRMS)

## 📖 Chapter 1: Introduction

The Human Resources (HR) staff plays a vital role in organizing a company by managing the entire employee lifecycle. This includes recruitment, training, compensation, benefits, and performance management.

However, many companies still rely on traditional methods such as paper-based records, which lead to data redundancy and time-consuming reporting processes. Additionally, some HR systems are overly complex, featuring information-dense interfaces that confuse users.

This project proposes a **Human Resource Management System (HRMS)** that minimizes redundancy and ensures data consistency using a database management system. It also applies **Human-Computer Interaction (HCI)** principles to create a user-friendly interface, especially for users with impairments and disabilities.

---

## 🎯 Purpose and Value Proposition

The system aims to improve efficiency for both employees and HR staff, contributing to smoother company operations and better organization.

### Key Benefits:

* Reduces human errors
* Provides real-time data
* Minimizes workload
* Improves system usability

The system is developed using **Laravel**, which enables faster development through clean code and built-in tools while maintaining high performance when optimized.

---

## 👥 Target Audience

The system is designed for:

### 🧑‍💼 HR Staff

* Access dashboard and system modules
* Manage employees
* Handle organization structure (departments & positions)
* Monitor attendance
* Manage payroll
* Perform CRUD operations (Create, Read, Update, Delete)

### 👨‍💻 Employees

* Access personal accounts
* View attendance records
* View payroll information

---

## ⚙️ Core Functionalities

### 👤 User Management (CRUD)

A complete system for managing users with Create, Read, Update, and Delete operations.
Uses **Laravel Eloquent** and **AJAX** for real-time updates without page refresh.

---

### 🔐 Role-Based Access Control

Implemented using **Laravel Middleware**:

* HR staff: Full system access
* Employees: Limited access (self-service only)

---

### 💰 Payroll System

* Automatically computes salaries, taxes, and deductions
* Uses **Blade templating** for clean and readable financial reports

---

### 🕒 Attendance & Leave Tracking

* Handles employee attendance and leave requests
* Provides real-time updates
* Includes form validation for accuracy
* Improves HR-employee communication

---

## 🛠️ Technical Feasibility & Laravel Components

The system is built using:

* **Laravel (MVC Architecture)**

  * Separates logic, data, and UI for better organization

* **Routing System**

  * Connects user actions to backend functions

* **MySQL Database + Eloquent ORM**

  * Simplifies data handling
  * Supports migrations and relationships

* **Blade Templating Engine**

  * Used for UI components like the sidebar

* **Artisan CLI**

  * Speeds up development and maintenance

---

# 📘 Chapter 2: System Design

## 🖼️ Wireframe

### 📊 Dashboard Page

**Purpose:**
Displays summary cards, statistics, and recent user activities.

---

## 🧾 Transaction Page (Forms)

### ➕ Add Transaction

**Purpose:**
Allows users to input and store employee data in the database.

---

### 🔘 Buttons

* **Save Button**
  Submits form data for processing and storage

* **Cancel Button**
  Clears inputs or redirects without saving

---

### 📝 Input Fields

* Accept user data such as:

  * Text
  * Numbers
  * Dates

---

### 🏷️ Labels

* Describe each input field
* Guide users and reduce confusion

---

## ✅ Form Processing

### ✔️ Validation

* Ensures required fields are filled
* Checks proper email format

---

### 📤 Submission

* Sends data via **POST request**
* Processed by a controller
* Stored in the database

---

### 💬 Feedback

* Displays success messages when saved
* Shows error messages if submission fails

---

## 🔍 Task Analysis

<img width="291" height="571" alt="FlowChart drawio" src="https://github.com/user-attachments/assets/c1469686-2e86-4349-baaa-cb809b47e286" />

### 👤 User: HR Staff

### 🎯 Goal: Add an Employee

### Step-by-Step Process:

1. User logs in using username and password
2. User is redirected to the dashboard
3. User selects the **Employee** module
4. User clicks the **Add** button
5. User inputs employee information
6. User reviews and confirms data
7. User clicks the **Save** button
8. System shows confirmation prompt

   * *“Are you sure you want to add an employee?”*
9. User selects **Yes**
10. System displays success message:

* *“Success: Added a new employee”*

---

## 📅 Gantt Chart

<img width="1180" height="326" alt="image" src="https://github.com/user-attachments/assets/588fb82e-d30f-4f88-a2a0-2accdd737da8" />


---

## 🗂️ Entity Relationship Diagram (ERD)

<img width="1051" height="901" alt="hrmsERD drawio" src="https://github.com/user-attachments/assets/3d134953-701f-476d-be46-3269cae2a7f9" />



---

If you want, I can also:

* Turn this into a **GitHub-ready README with badges + screenshots**
* Or generate a **clean ERD diagram image + Gantt chart** for you 👍
