# Event Management System with Livewire

This is a Laravel 12 project that includes user authentication, event management, and RSVP functionality using Livewire and Bootstrap.

## Features
- **User Authentication** (Login, Register, Logout)
- **Event Management** (Add, Edit, List, and RSVP to events)
- **Real-time Updates** using Livewire's `dispatch()`
- **Pagination** for efficient data handling
- **Validation** for secure and error-free data entry

---

## Installation Instructions

### 1. Clone the Repository
```bash
git clone <repository-url>
cd <project-folder>
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Create the `.env` File
Copy the `.env.example` file and update the database credentials:
```bash
cp .env.example .env
```

Add your database credentials in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations and Seed Database
```bash
php artisan migrate --seed
```

### 6. Run the Development Server
```bash
php artisan serve
```

### 7. Run Vite for Asset Compilation (Required for Bootstrap & Livewire)
```bash
npm run dev
```

---

## Usage

### User Authentication
- Visit `/register` to create a new account.
- Visit `/login` to log in as a registered user.

### Event Management
- After logging in, users can:
  - **Create Events** with a name and a future date.
  - **RSVP** to an event with live attendee count updates.
  - **Withdraw RSVP** if no longer attending.
---

## Testing
To run PHPUnit tests for the project:
```bash
php artisan test
```
The tests cover:
- Event creation
- RSVP functionality
- Validation rules

---

## Troubleshooting
If you encounter issues:
1. Clear cache and config:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:clear
   ```
2. Check database connection settings in `.env`.
3. Ensure `npm run dev` is running for proper UI rendering.

---

## Future Improvements
- Adding email notifications for RSVP confirmations.
- Enhancing the UI with better responsiveness.

---

## License
This project is licensed under the MIT License.

---



