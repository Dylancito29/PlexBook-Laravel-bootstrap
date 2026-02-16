# 🚀 Project Roadmap: Library Management System

This document outlines the features and improvements planned to transform this CRUD project into a professional-grade portfolio piece for GitHub.

## ✅ Phase 1: UX/UI Polish (The "Feel")
Modernize the user interface to provide better feedback and interaction.
- [ ] **SweetAlert2 Integration**: Replace standard flash messages (`alert-success`, `alert-danger`) with modern "Toast" notifications.
- [ ] **Confirmation Dialogs**: Use SweetAlert2 for critical actions (Deleting a book, Returning a loan) instead of browser defaults.
- [ ] **Loading States**: Add spinners to buttons when forms are submitted to prevent double-clicks.

## 🛠 Phase 2: User Experience (The "User")
Allow users to manage their own account and interaction.
- [ ] **Profile Management**: Create a view where users can update their Name and change their Password.
- [ ] **Avatar Identification**: Allow users to upload a profile picture (or keep using initials generated dynamically).
- [ ] **Book Reviews (Optional)**: Allow users to leave a 1-5 star rating on books they have borrowed.

## 🔧 Phase 3: Advanced Administration (The "Admin")
Give administrators full control over the system's data.
- [ ] **Category Management**: Create a CRUD for Categories (currently they might be hardcoded or seeded).
- [ ] **User Management**: Admin panel to see all registered users and ability to "Ban" or delete them.
- [ ] **Stock History**: Log when stock is added or removed (simplified audit trail).

## 📊 Phase 4: Data Visualization (The "Wow" Factor)
Make the Admin Dashboard look improved with charts.
- [ ] **Charts.js Integration**: Add a chart showing "Loans per Month".
- [ ] **Top Books Widget**: Show a list of the top 5 most borrowed books.

## 📝 Phase 5: Documentation & Presentation (The "Repo")
Prepare the repository for public viewing on GitHub.
- [ ] **Polished README.md**:
    - High-quality screenshots/GIFs of the app in action.
    - List of technologies used (Laravel 7, Bootstrap 5, MySQL).
    - Step-by-step installation instructions.
- [ ] **Robust Database Seeder**: Ensure `php artisan db:seed` fills the app with realistic data for anyone testing it.

---

### 🎯 Current Focus: Phase 1
We will start by integrating **SweetAlert2** to make the application feel more responsive and modern.
