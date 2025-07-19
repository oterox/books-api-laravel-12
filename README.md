# Laravel 12 Books API

A simple RESTful API for managing books built with Laravel 12.

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+
- Composer
- Laragon (recommended for Windows)

### Installation

1. **Clone or download this project** to your Laragon `www` directory
2. **Navigate to the project directory:**
   ```bash
   cd C:\laragon\www\books-api
   ```

3. **Install dependencies:**
   ```bash
   C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe C:\laragon\bin\composer\composer.phar install
   ```

4. **Run migrations:**
   ```bash
   C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe artisan migrate
   ```

5. **Seed the database:**
   ```bash
   C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe artisan db:seed --class=BookSeeder
   ```

## 🌐 Accessing the API

### Option 1: Using Laragon (Recommended)
1. Start Laragon
2. Make sure Apache and MySQL are running
3. Access the API at: `https://books-api.test/api/books`
4. Access the test interface at: `https://books-api.test/test.html`

### Option 2: Using Laravel's Built-in Server
1. Start the development server:
   ```bash
   C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe artisan serve
   ```
2. Access the API at: `http://localhost:8000/api/books`

## 📚 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/books` | Get all books (paginated) |
| GET | `/api/books/{id}` | Get a specific book |
| POST | `/api/books` | Create a new book |
| PUT | `/api/books/{id}` | Update a book |
| DELETE | `/api/books/{id}` | Delete a book |
| GET | `/api/books/search?q={term}` | Search books |

## 🧪 Testing the API

### Using the Test Script
Run the included test script:
```bash
C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe test_api.php
```

### Using cURL Examples

1. **Get all books:**
   ```bash
   curl -X GET http://books-api.test/api/books
   ```

2. **Create a new book:**
   ```bash
   curl -X POST http://books-api.test/api/books \
     -H "Content-Type: application/json" \
     -d '{
       "title": "Test Book",
       "author": "Test Author",
       "description": "A test book",
       "isbn": "9781234567891",
       "published_year": 2024,
       "price": 15.99
     }'
   ```

3. **Search books:**
   ```bash
   curl -X GET "http://books-api.test/api/books/search?q=gatsby"
   ```

### Using Postman or Insomnia
Import these endpoints into your API testing tool:
- Base URL: `http://books-api.test/api/books`
- See `API_DOCUMENTATION.md` for detailed request/response examples

## 📖 Laravel Concepts Covered

This project demonstrates key Laravel concepts:

1. **Models & Eloquent ORM**
   - `Book` model with fillable fields
   - Attribute casting
   - Validation rules

2. **Controllers**
   - RESTful controller methods
   - Request validation
   - JSON responses
   - Error handling

3. **Database**
   - Migrations for schema definition
   - Seeders for sample data
   - SQLite database (for simplicity)

4. **Routing**
   - API route definitions
   - Route model binding

5. **Validation**
   - Custom validation rules
   - Error response formatting

## 🛠️ Project Structure

```
books-api/
├── app/
│   ├── Http/Controllers/
│   │   └── BookController.php    # API controller
│   └── Models/
│       └── Book.php              # Book model
├── database/
│   ├── migrations/
│   │   └── create_books_table.php
│   └── seeders/
│       └── BookSeeder.php        # Sample data
├── routes/
│   └── web.php                   # API routes
├── API_DOCUMENTATION.md          # Detailed API docs
├── test_api.php                  # Test script
└── README.md                     # This file
```

## 🔧 Configuration

The project uses SQLite by default for simplicity. To change the database:

1. Update `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=books_api
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. Create the database in Laragon's HeidiSQL

3. Run migrations again

## 🚀 Next Steps

To extend this API, consider adding:

1. **Authentication** using Laravel Sanctum
2. **API Resources** for better response formatting
3. **Rate Limiting** for API protection
4. **File Uploads** for book covers
5. **Relationships** (authors, categories, etc.)
6. **Caching** for better performance
7. **Testing** with PHPUnit

## 📝 Notes for WordPress Developers

Coming from WordPress development, here are some key differences:

1. **MVC Pattern**: Laravel follows Model-View-Controller pattern
2. **Eloquent ORM**: Similar to WordPress's WP_Query but more powerful
3. **Migrations**: Database version control (like WordPress database updates)
4. **Artisan CLI**: Command-line tools for common tasks
5. **Composer**: Dependency management (like npm for PHP)

## 🤝 Support

If you encounter any issues:
1. Check that Laragon is running properly
2. Verify PHP and Composer are in your PATH
3. Check the Laravel logs in `storage/logs/`
4. Ensure the database file exists and is writable

Happy coding! 🎉
