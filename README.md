# WebcornPHP
Production-style backend system built with Laravel demonstrating scalable API architecture, domain-driven design principles, and real-world business workflows.
A modern, full-stack web application built with **Laravel 9** and **Vite**, designed for high performance and scalability.

---

## 📋 Overview

WebcornPHP is a robust web application framework combining the power of **Laravel 9** for backend development with **Vite** for ultra-fast frontend builds. This project demonstrates best practices in modern PHP web development, including API development, authentication, real-time features, and comprehensive testing.

---

## ✨ Key Features

- **Laravel 9 Framework** - Latest stable version with elegant, expressive syntax
- **API Authentication** - Built-in Sanctum integration for token-based API security
- **Interactive Dashboard** - Custom dashboard interface for user management and analytics
- **Vite Build Tool** - Lightning-fast development and production builds
- **Modern PHP** - PHP 8.0.2+ for type hints, nullsafe operators, and named arguments
- **Database Migrations** - Schema management with database agnostic migrations
- **Eloquent ORM** - Expressive database abstraction layer for clean data management
- **Background Jobs** - Robust job queue processing for async operations
- **Real-time Broadcasting** - WebSocket support for real-time events
- **Comprehensive Testing** - PHPUnit and Mockery for unit and feature testing
- **Code Quality** - Laravel Pint for code style consistency

---

## 🛠 Tech Stack

### Backend
- **PHP 8.0+** - Modern, type-safe programming language
- **Laravel 9.19+** - World's most elegant PHP framework
- **Guzzle HTTP 7.8** - Powerful HTTP client
- **Laravel Sanctum 3.0** - Token-based API authentication
- **Laravel Tinker** - Interactive REPL for debugging

### Frontend
- **Vite** - Next-generation frontend build tool
- **Modern JavaScript/CSS** - ES6+ modules and CSS3 features

### Database
- **Database Agnostic** - Works with MySQL, PostgreSQL, SQLite, and more
- **Eloquent Migrations** - Version-controlled database schema

### Development & Testing
- **PHPUnit 9.5+** - Industry-standard testing framework
- **Mockery 1.4+** - Mocking library for PHP
- **Laravel Pint 1.0+** - PHP code style fixer
- **FakerPHP 1.9+** - Test data generation
- **Laravel Sail** - Docker development environment

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.0.2 or higher
- Composer
- Node.js & npm (for Vite)
- MySQL/PostgreSQL (or SQLite)

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/sorarose99/webcornphp.git
   cd webcornphp
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   Edit `.env` and add your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=webcornphp
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

7. **Build Assets with Vite**
   ```bash
   npm run dev    # Development with hot reload
   npm run build  # Production build
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser.

---

## 📁 Project Structure

```
webcornphp/
├── app/
│   ├── Console/          # Artisan commands
│   ├── Exceptions/       # Custom exception handlers
│   ├── Http/
│   │   ├── Controllers/  # Application controllers
│   │   ├── Middleware/   # HTTP middleware
│   │   └── Kernel.php    # HTTP kernel configuration
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── bootstrap/            # Framework initialization
├── config/              # Application configuration
├── database/
│   ├── migrations/      # Database migrations
│   ├── seeders/         # Database seeding
│   └── factories/       # Model factories for testing
├── resources/
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   └── views/          # Blade templates
├── routes/             # Application routes
├── dashboard/          # Dashboard components
├── storage/            # Application storage
├── tests/              # Test suites
├── public/             # Web-accessible files
├── composer.json       # PHP dependencies
├── vite.config.js      # Vite configuration
└── phpunit.xml         # PHPUnit configuration
```

---

## 🔌 API Endpoints

WebcornPHP comes with a secure API built using Laravel Sanctum. All API endpoints require token authentication.

### Authentication
- `POST /api/login` - User login (returns API token)
- `POST /api/register` - User registration
- `POST /api/logout` - User logout

*Additional endpoints depend on your specific implementation*

---

## 🧪 Testing

Run the test suite to ensure code quality and reliability:

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/YourTest.php
```

Tests use **PHPUnit** and **Mockery** for comprehensive coverage.

---

## 📊 Database

### Running Migrations
```bash
php artisan migrate          # Run all migrations
php artisan migrate:rollback # Rollback last batch
php artisan migrate:refresh  # Rollback and re-run all
```

### Seeding Data
```bash
php artisan db:seed
```

---

## 🎨 Frontend Development

### Vite Configuration
Vite is configured for optimal development and production builds:

```bash
npm run dev    # Start development server with hot module replacement (HMR)
npm run build  # Create optimized production bundle
```

---

## 🔐 Security

- **API Authentication**: Protected endpoints using Laravel Sanctum
- **CSRF Protection**: Built-in CSRF token validation
- **SQL Injection Prevention**: Parameterized queries via Eloquent ORM
- **XSS Protection**: Blade template escaping by default
- **Password Hashing**: Bcrypt password hashing with Laravel's Hash facade

---

## 🚦 Code Quality

Maintain code consistency with Laravel Pint:

```bash
composer pint        # Fix code style issues automatically
composer pint --test # Test code style without changes
```

---

## 📦 Dependencies Management

### Add New Dependency
```bash
composer require vendor/package
```

### Update Dependencies
```bash
composer update
```

### View Installed Packages
```bash
composer show
```

---

## 🐛 Troubleshooting

### Common Issues

**Issue: `APP_KEY not set`**
```bash
php artisan key:generate
```

**Issue: Database connection errors**
- Verify `.env` database credentials
- Ensure database server is running
- Run `php artisan migrate`

**Issue: Node modules missing**
```bash
npm install
npm run dev
```

---

## 📚 Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Laravel Bootcamp**: https://bootcamp.laravel.com
- **Vite Documentation**: https://vitejs.dev
- **Eloquent ORM**: https://laravel.com/docs/eloquent
- **Laravel Sanctum**: https://laravel.com/docs/sanctum

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style
Please ensure your code follows PSR-12 standards and passes Laravel Pint checks.

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](https://opensource.org/licenses/MIT) file for details.

---

## 👨‍💻 Author

**sorarose99** - [GitHub Profile](https://github.com/sorarose99)

---

## 💡 Future Enhancements

- [ ] GraphQL API support
- [ ] WebSocket real-time features expansion
- [ ] Advanced caching strategies
- [ ] Multi-language support
- [ ] Progressive Web App (PWA) capabilities
- [ ] Admin panel with advanced analytics

---

## 📞 Support

For issues, questions, or suggestions, please open an [issue on GitHub](https://github.com/sorarose99/webcornphp/issues).

---

**Built with ❤️ by sorarose99**
