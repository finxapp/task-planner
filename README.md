# 📝 Task Planner Application (Laravel)

A simple and powerful Task Planner built with Laravel, featuring authentication, task management, role-based access, soft deletes, and CI/CD integration.

---

## 🚀 Features

### 🔐 Authentication
- User Registration
- User Login & Logout
- Password hashing for security

### ✅ Task Management (CRUD)
- Create tasks
- View tasks
- Edit tasks
- Delete tasks (Soft Delete)

### 🛡️ Validation & Security
- Backend validation for all forms
- Display validation errors on frontend
- Input sanitization using `strip_tags`
- CSRF protection (Laravel default)

### ✍️ Rich Text Editor
- Integrated **TinyMCE** for task descriptions
- Allows formatted content (bold, lists, etc.)

### 🗑️ Soft Delete System
- Tasks are not permanently deleted
- Stored using `deleted_at`
- Can be restored by supervisor

### 👨‍💼 Role-Based Access (RBAC)
- **User**
  - Manage only their own tasks
- **Supervisor**
  - View all users' tasks
  - View deleted tasks
  - Restore deleted tasks
  - Delete any task

### 🔄 CI/CD Integration
- GitHub Actions workflow
- Automated testing on push
- MySQL service for CI testing

---

## 🧰 Tech Stack

- PHP 8.3
- Laravel 12
- MySQL
- TailwindCSS
- PHPUnit
- GitHub Actions (CI/CD)

---

## ⚙️ Installation Guide

### 1. Clone Repository

```bash
git clone git@github.com:finxhub/task-planner.git
cd task-planner 
```
### 2. Installation Dependencies
```bash 
composer install
```

### 3. Setup Environment

```bash 
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database 

**Update .env**

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=task_planner
- DB_USERNAME=laravel_user
- DB_PASSWORD=password


### 5. Create Database 

```bash
mysql -u laravel_user -p

CREATE DATABASE task_planner;
```

### 6. Run Migrations

```bash 
php artisan migrate
```
### 7. Start Development Server

```bash 
php artisan migrate
```

**Visit:**
- http://127.0.0.1:8000



## 👨‍💼 Creating a Supervisor

**Run:**

```bash 
php artisan tinker
```

**Then:**

```bash 
$user = App\Models\User::find(1);
$user->role = 'supervisor';
$user->save();
```