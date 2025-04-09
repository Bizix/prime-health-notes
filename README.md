# 🩺 PrimeHealthNotes

This is a full-stack evaluation task for PrimeHealth. The application allows users to view, add, and filter notes for a specific patient.

---

## 🧰 Built With

- **Laravel 12.7.2** (Backend framework)
- **Vue 3** with `<script setup>` (Frontend framework)
- **Vite** (Dev server & build tool)
- **Tailwind CSS v4.1.3** (Utility-first styling, zero-config via new engine)
- **SQLite** (Lightweight database for quick setup)

---

## ⚠️ Security Note

While this project is intended for demo purposes and does not include real patient data, in a production healthcare setting I would ensure that:

- No PHI is cached without encryption
- All endpoints are authenticated and scoped
- Logs do not expose sensitive data
- All transmission is over HTTPS and environment variables are properly configured

---

## 📸 Features

- View a list of notes for a patient
- Add a new note (title + content)
- Filter notes by title keyword
- Paginated note results (5 per page)
- (Bonus) Generate a mock summary of all notes
- (Bonus) Fully componentized frontend (NoteForm, NoteCard, Pagination, LoadingIndicator)
- (Bonus) Service class pattern for clean controller logic

---

## ⚙️ Project Setup

### ✅ Requirements

- PHP ^8.1
- Composer
- Node.js and npm
- Git
- Laravel CLI (optional)

---

### 🛠️ Backend (Laravel)

1. **Clone the repo**
   ```bash
   git clone https://github.com/your-username/prime-health-notes.git
   cd prime-health-notes

2. **Install dependencies**
   ```bash
   composer install

3. **Create and configure .env**
   ```bash
   cp .env.example .env
   php artisan key:generate

4. **Use SQLite (already configured)**
   Make sure the file database/database.sqlite exists. If not, create it:
   ```bash
   touch database/database.sqlite

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed

6. **Start the backend server**
   ```bash
   php artisan serve


### Frontend (Vue 3 + Tailwind)
1. **Navigate to the frontend directory (if separate), or from root**
   ```bash
   npm install
   npm run dev

### Tech Highlights
- Refactored controller logic into a dedicated service layer (NoteService)
- Modular Vue components for reusability and readability
- Mobile responsive layout with smart Tailwind utility usage
- Async loading indicators for all user-facing actions
- API-driven search and pagination
- Simple but readable code structure for easy evaluation


