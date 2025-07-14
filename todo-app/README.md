# Laravel + Inertia.js + Vue.js 3 Todo App

A modern todo application built with Laravel backend, Inertia.js for seamless SPA experience, and Vue.js 3 frontend.

## ✨ Features

- ✅ Add, edit, delete todos
- ✅ Mark todos as complete/incomplete
- ✅ Real-time updates without page refresh
- ✅ Beautiful, responsive UI with Tailwind CSS
- ✅ Form validation
- ✅ Modern tech stack

## 🛠 Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Vue.js 3 (Composition API)
- **Bridge:** Inertia.js
- **Styling:** Tailwind CSS
- **Database:** SQLite
- **Build Tool:** Vite

## 📋 Prerequisites

Make sure you have the following installed:

- **PHP 8.1+** with SQLite extension
- **Composer** (PHP package manager)
- **Node.js 16+** and **npm**

### Installing Prerequisites

#### macOS (using Homebrew)
```bash
brew install php composer node
```

#### Ubuntu/Debian
```bash
sudo apt update
sudo apt install php php-cli php-sqlite3 composer nodejs npm
```

#### Windows
- Download PHP from [php.net](https://www.php.net/downloads)
- Download Composer from [getcomposer.org](https://getcomposer.org/download/)
- Download Node.js from [nodejs.org](https://nodejs.org/)

## 🚀 Quick Start

### Option 1: Automated Setup
```bash
# Clone or download the project
git clone <your-repo> todo-app
cd todo-app

# Run the setup script
./setup.sh

# Start the server
php artisan serve
```

### Option 2: Manual Setup

1. **Install Dependencies**
   ```bash
   # Install PHP dependencies
   composer install
   
   # Install Node.js dependencies
   npm install
   ```

2. **Environment Setup**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

3. **Database Setup**
   ```bash
   # Create SQLite database
   touch database/database.sqlite
   
   # Run migrations
   php artisan migrate
   
   # (Optional) Add sample data
   php artisan db:seed --class=TodoSeeder
   ```

4. **Build Assets**
   ```bash
   # For production
   npm run build
   
   # OR for development with hot reload
   npm run dev
   ```

5. **Start Server**
   ```bash
   php artisan serve
   ```

## 🌐 Accessing the Application

Once the server is running, open your browser and navigate to:

**http://localhost:8000**

## 💻 Development

### Running in Development Mode

For the best development experience with hot module replacement:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server (optional):**
```bash
npm run dev
```

### Available Commands

```bash
# Laravel commands
php artisan migrate          # Run database migrations
php artisan migrate:fresh    # Fresh migration (clears data)
php artisan db:seed         # Seed database with sample data
php artisan tinker          # Laravel REPL
php artisan route:list      # View all routes

# Frontend commands
npm run dev                 # Development server with HMR
npm run build              # Production build
npm run preview            # Preview production build
```

## 🗄 Database

The application uses SQLite by default. The database file is located at:
```
database/database.sqlite
```

To reset the database:
```bash
php artisan migrate:fresh --seed
```

## 📁 Project Structure

```
todo-app/
├── app/
│   ├── Http/Controllers/TodoController.php
│   └── Models/Todo.php
├── database/
│   ├── migrations/
│   └── seeders/TodoSeeder.php
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   └── Pages/Todos/Index.vue
│   └── views/app.blade.php
├── routes/web.php
└── vite.config.js
```

## 🔧 Configuration

### Environment Variables

Key settings in `.env`:

```env
APP_NAME="Todo App"
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

### Vite Configuration

The Vite configuration in `vite.config.js` includes:
- Vue.js 3 support
- Inertia.js integration
- Tailwind CSS processing
- Hot module replacement

## 🚨 Troubleshooting

### Common Issues

1. **SQLite not found**
   ```bash
   # Install SQLite extension
   sudo apt install php-sqlite3  # Ubuntu/Debian
   brew install php             # macOS
   ```

2. **Permission errors**
   ```bash
   # Fix storage permissions
   chmod -R 775 storage bootstrap/cache
   ```

3. **Node.js version issues**
   ```bash
   # Check Node.js version
   node --version  # Should be 16+
   ```

4. **Composer issues**
   ```bash
   # Clear Composer cache
   composer clear-cache
   composer install
   ```

### Debugging

- Check Laravel logs: `storage/logs/laravel.log`
- Enable debug mode: Set `APP_DEBUG=true` in `.env`
- View routes: `php artisan route:list`

## 📝 API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/` | List todos |
| POST | `/todos` | Create todo |
| PUT | `/todos/{id}` | Update todo |
| PATCH | `/todos/{id}/toggle` | Toggle completion |
| DELETE | `/todos/{id}` | Delete todo |

## 🤝 Contributing

1. Fork the project
2. Create a feature branch
3. Make your changes
4. Run tests: `php artisan test`
5. Submit a pull request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

Built with ❤️ using Laravel, Inertia.js, and Vue.js 3
