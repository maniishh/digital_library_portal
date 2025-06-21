# 📚 Digital Library Portal (PHP + MySQL)

This project is a **seat booking and management system** for a Digital Library built using PHP, MySQL, and Tailwind CSS. It allows students to book seats, upload ID proofs, make payments, and lets admins manage seat allocation, track payments, and monitor bookings.

---

![image](https://github.com/user-attachments/assets/c5c8d8df-7f99-4796-be2e-179be2ab032d)
------------------------------------------------------------------------------------------
![image](https://github.com/user-attachments/assets/1101efd4-9d1e-4ffe-a0e1-5d6ee45e3b54)



## 📁 Table of Contents!


- [Features](#features)
- [Tech Stack](#tech-stack)
- [Database Structure](#database-structure)
- [Installation](#installation)
- [Admin Panel](#admin-panel)
- [Student Panel](#student-panel)
- [Folder Structure](#folder-structure)
- [Screenshots](#screenshots)
- [License](#license)

---

## ✨ Features

### Admin
- ✅ Add/Edit/Delete Seats
- ✅ Approve or Reject Bookings
- ✅ View Student Details
- ✅ Auto-expiry of sessions after 1 month
- ✅ See Payment Summaries
- ✅ Export bookings as CSV

### Student
- 🧑 Register/Login
- 🪑 Book Seat
- 📎 Upload ID Proof
- 💵 Pay full or partial amount
- 📜 View Status

---

## 🛠 Tech Stack

- **Frontend:** HTML, Tailwind CSS, JavaScript
- **Backend:** PHP (Core PHP, No Framework)
- **Database:** MySQL
- **Server:** XAMPP / Apache

---

## 🧱 Database Structure

Here are the key tables used:

### 1. `table_students`
| Column         | Type         | Description               |
|----------------|--------------|---------------------------|
| id             | INT (PK)     | Student ID                |
| name           | VARCHAR      | Full Name                 |
| email          | VARCHAR      | Email ID                  |
| phone          | VARCHAR      | Phone                     |
| password       | VARCHAR      | Hashed Password           |
| profile_photo  | VARCHAR      | Profile Image Path        |
| created_at     | TIMESTAMP    | Joined On                 |

---

### 2. `table_seats`
| Column         | Type       | Description              |
|----------------|------------|--------------------------|
| seat_id        | INT (PK)   | Seat ID                  |
| seat_number    | VARCHAR    | Seat Label (e.g., 1, 2)  |
| shift          | VARCHAR    | Morning/Evening          |
| start_time     | TIME       | Start Time               |
| end_time       | TIME       | End Time                 |
| price          | DECIMAL    | Seat Price               |
| is_active      | BOOLEAN    | 1=Active, 0=Inactive     |

---

### 3. `table_bookings`
| Column         | Type       | Description                  |
|----------------|------------|------------------------------|
| id             | INT (PK)   | Booking ID                   |
| student_id     | INT (FK)   | From `table_students`        |
| seat_id        | INT (FK)   | From `table_seats`           |
| shift          | VARCHAR    | Shift                        |
| start_time     | TIME       | Shift Start                  |
| end_time       | TIME       | Shift End                    |
| from_date      | DATE       | Session Start Date           |
| till_date      | DATE       | Session End (auto 1 month)   |
| id_proof       | VARCHAR    | File Path to Uploaded Proof  |
| price          | DECIMAL    | Total Price                  |
| paid_amount    | DECIMAL    | Paid Amount                  |
| status         | ENUM       | `approved`, `pending`        |
| approval_status| ENUM       | Admin Status                 |
| created_at     | TIMESTAMP  | When booked                  |

---

### 4. `table_payments`
| Column         | Type       | Description                  |
|----------------|------------|------------------------------|
| id             | INT (PK)   | Payment ID                   |
| student_id     | INT (FK)   | From `table_students`        |
| booking_id     | INT (FK)   | From `table_bookings`        |
| amount         | DECIMAL    | Paid Amount                  |
| remaining_amount | DECIMAL  | Remaining Amount             |
| status         | ENUM       | `paid`, `pending`            |
| payment_type   | VARCHAR    | `manual`, etc.               |
| method         | VARCHAR    | `cash`, `online`, etc.       |
| payment_date   | DATETIME   | Paid On                      |

---

## ⚙️ Installation

1. **Clone Repository**  
   ```bash
   git clone https://github.com/developervikki/digital-library-portal.git
   cd digital-library-portal
   ```

2. **Import Database**  
   - Create a database: `digital_library_db`
   - Import `database.sql` using phpMyAdmin or CLI

3. **Configure DB**  
   Edit `/includes/db.php` with your DB credentials:
   ```php
   $conn = new mysqli("localhost", "root", "", "digital_library_db");
   ```

4. **Run XAMPP**  
   - Start Apache & MySQL
   - Visit: [http://localhost/digital-library-portal](http://localhost/digital-library-portal)

---

## 🔐 Admin Panel

- URL: `/admin/`
- Default credentials:
  - **Username:** `admin`
  - **Password:** `admin123`

(Admin table assumed as `table_admins`)

---

## 🎓 Student Panel

- Register/Login at `/login.php`
- Book Seat from dashboard
- Upload ID Proof
- See Approval Status & Payment Info

---

## 📁 Folder Structure

```
digital-library-portal/
├── admin/
│   ├── bookings.php
│   ├── seats.php
│   └── payments.php
├── student/
│   ├── book-seat.php
│   └── dashboard.php
├── uploads/
│   ├── profiles/
│   └── id_proofs/
├── includes/
│   ├── db.php
│   ├── auth.php
│   ├── header.php
│   └── footer.php
├── login.php
├── register.php
└── README.md
```

---

## 📸 Screenshots



---

## 📝 License

This project is open source. Free to use and modify. Attribution appreciated!

---

## 👨‍💻 Author

Built by **Vikash Yadav**  

