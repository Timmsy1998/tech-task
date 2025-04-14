## Backend dev tech task
### Objective
 Demonstrate your backend development skills by implementing a basic user management system.
 
### Task Description
 Build a CRUD (Create, Read, Update, Delete) application for managing users. The system should support the following functionality:
Required User Fields (for views and forms):
Name
Surname
Email
Phone
Country (selected from a predefined list)
Gender
Password
Repeat Password (for validation)
Optional Fields (not required for current implementation):
Selfie
Introduction
Additional Requirements:
Support image upload (e.g., for a user profile picture)
Enable country selection from a predefined country list

### Acceptance Criteria
- Fork the provided Git repository and implement the task within your fork
- Implement full CRUD functionality:
- Create user
- Update user
- View user details
- View user list
- Delete user
- Follow Test-Driven Development (TDD) principles
- Apply Domain-Driven Design (DDD) best practices
- Ensure code quality, readability, and maintainability
  
### Notes:
- Your submission will be evaluated based on code quality, adherence to best practices, and completeness of the task
- Thank you and good luck!

<hr />

### Hello, I'm James And This Is My Submission

- Thank you for the opportunity
- I have included a Database Seeder to seed the default admin user with the password: `password`

## 📋 Summary: Why These Actions Were Taken

This project was structured with a focus on **clean architecture**, **security**, and **real-world backend principles**. Below is a breakdown of the key actions and **why** they were implemented.

---

### ✅ 1. **Domain-Driven Design (DDD) Structure**

**Why:**  
To separate business logic from infrastructure and interface layers. Organizing logic into `Domain/User/Actions`, `Models`, and `Requests` improves testability, scalability, and maintainability.

---

### ✅ 2. **Manual Authentication System**

**Why:**  
To gain full control over authentication without relying on Laravel Breeze, Fortify, or Jetstream. This allows for a leaner app and a better understanding of how Laravel's session-based auth works under the hood.

- `/login` and `/logout` handled via custom controller  
- `Auth::attempt()` + `session()->regenerate()` used manually

---

### ✅ 3. **Form Request Validation with Authorization**

**Why:**  
To keep controllers thin and encapsulate both **data validation** and **authorization logic** directly in the request layer, in line with Laravel's best practices.

- `StoreUserRequest` ensures only admins can create users  
- `UpdateUserRequest` allows users to update themselves, or admins to update any user

---

### ✅ 4. **Policies for Access Control**

**Why:**  
To enforce granular user permissions using Laravel’s policy system — for example, restricting edit/delete actions to admins. This makes views and controllers cleaner using `@can`, `Gate::allows()`, and `$this->authorize()`.

---

### ✅ 5. **Admin Seeding for Quick Setup**

**Why:**  
To streamline testing and setup for developers. Seeding a default admin ensures there’s always an account available with full privileges to manage users immediately after install.

---

### ✅ 6. **Route Model Binding and Clean Controller Logic**

**Why:**  
To reduce boilerplate code by letting Laravel inject `User` models automatically into controllers and actions, resulting in elegant and readable method signatures.

---

### ✅ 7. **Tailwind + Modern Blade Layouts**

**Why:**  
To provide a modern UI without extra complexity or external UI kits. Tailwind allows for clean, component-ready markup that’s easy to expand or customize.

---

### ✅ 8. **Custom Country List + Gender Options**

**Why:**  
To provide a strict, validated selection of acceptable values for user attributes like country and gender. This prevents invalid data entry and ensures consistency in forms and views.
