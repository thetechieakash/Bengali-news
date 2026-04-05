# Bengali News Portal (CodeIgniter 4)

A modern **Bengali News Portal CMS** built using **CodeIgniter 4**, designed for publishing news articles, managing categories, tags, comments, advertisements, and user messages.

This project includes an **admin dashboard** for content management and a **frontend news portal** for readers.

---

## 🚀 Features

### Frontend

* News article listing
* Category, sub-category and child category navigation
* Mega menu navigation
* Article detail page
* Post comments with **Google reCAPTCHA v3 protection**
* Contact form with spam protection
* Tag based article filtering
* Advertisement placement system
* Responsive news layout

### Admin Panel

* Dashboard
* Manage Categories / Subcategories / Child Categories
* Manage News Posts
* Manage Tags
* Manage Advertisements
* Manage Contact Messages
* Manage Comments (approve / reject)
* DataTables powered listings
* AJAX operations for CRUD
* Secure form handling

### Security

* CSRF protection
* reCAPTCHA v3 verification
* AJAX request validation
* Input validation
* Spam protection for comments and contact forms
* IP and user agent logging

---

## 🛠 Tech Stack

| Technology          | Usage                  |
| ------------------- | ---------------------- |
| PHP                 | Backend                |
| CodeIgniter 4       | MVC Framework          |
| MySQL               | Database               |
| jQuery              | AJAX / UI interactions |
| Bootstrap           | UI framework           |
| DataTables          | Admin data tables      |
| SweetAlert2         | Confirmation dialogs   |
| Google reCAPTCHA v3 | Spam protection        |

---

## 📂 Project Structure

```
app
 ├ Controllers
 │   ├ Admin
 │   └ User
 │
 ├ Models
 │
 ├ Views
 │   ├ admin
 │   └ user
 │
 ├ Libraries
 │   └ RecaptchaService.php
 │
 ├ Database
 │   └ Migrations
 │
public
 ├ assets
 └ uploads
```

---

## ⚙️ Installation

### 1️⃣ Clone Repository

```bash
git clone https://github.com/thetechieakash/Bengali-news.git
cd bengali-news-portal
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

---

### 3️⃣ Configure Environment

Copy `.env.example`:

```bash
cp env .env
```

Update database configuration:

```
database.default.hostname = localhost
database.default.database = your_database
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

---

### 4️⃣ Configure reCAPTCHA

Add your keys in `.env`:

```
GOOGLE_RECAPTCHA_KEY=
GOOGLE_RECAPTCHA_SECRET=
```

---

### 5️⃣ Run Migrations

```bash
php spark migrate
```

---

### 6️⃣ Run Development Server

```bash
php spark serve
```

Open in browser:

```
http://localhost:8080
```

---

## 📌 Important Modules

### News Posts

Posts can have:

* Category
* Subcategory
* Child Category
* Tags
* Author
* Featured Image

---

### Tag System

Tags are stored using a **pivot table**:

```
tags
news_post_tag
```

Foreign keys are configured with **ON DELETE CASCADE** to maintain integrity.

---

### Comments

Comments include:

* Name
* Email
* Comment
* Post reference
* IP address
* User agent
* reCAPTCHA score

Comments require **admin approval** before appearing publicly.

---

### Contact Messages

Visitors can send messages through the contact form.

Stored data includes:

* Name
* Email
* Phone
* Subject
* Message
* IP Address
* User Agent

Admins can **view and delete messages** from the dashboard.

---

## 🔒 Security

The system includes multiple security layers:

* CSRF tokens
* Google reCAPTCHA v3
* Server-side validation
* AJAX request checks
* Database prepared queries
* Spam prevention

---

## 📊 Admin UI Features

* DataTables listing
* AJAX CRUD operations
* SweetAlert confirmations
* Modal views
* Responsive dashboard

---

## 🧑‍💻 Author

**Akash Halder**

Developer of this Bengali News Portal CMS.

---

## 📜 License

This project is open-source and available under the **MIT License**.

---

## ⭐ Support

If you find this project useful, please consider giving it a **star on GitHub**.
