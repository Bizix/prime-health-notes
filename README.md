# 🩺 PrimeHealthNotes

This is a full-stack evaluation task for PrimeHealth. The application allows users to view, add, and filter notes for a specific patient.

Built with:
- **Laravel** (backend)
- **Vue 3 + Vite + Tailwind CSS** (frontend)
- **SQLite** (as the database)

---

## 📸 Features

- View a list of notes for a patient
- Add a new note (title + content)
- Filter notes by title keyword
- (Bonus) Generate a mock summary of all notes

---

## ⚙️ Project Setup

### ✅ Requirements
- PHP ^8.1
- Composer
- Node.js and npm
- Laravel CLI (optional)
- Git

---

### Backend (Laravel)
1. Clone the repo:
   ```bash
   git clone https://github.com/your-username/prime-health-notes.git
   cd prime-health-notes

2. Install dependencies:
   ```bash
   composer install

3. Create and configure .env:
   ```bash
   cp .env.example .env
   php artisan key:generate

4. Use SQLite (already configured):
   Make sure the file database/database.sqlite exists. If not, create it:
   ```bash
   touch database/database.sqlite

5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed

6. Start the backend server:
   ```bash
   php artisan serve


### Frontend (Vue 3 + Tailwind)
1. Navigate to the frontend directory (if separate), or from root:
   ```bash
   npm install
   npm run dev



