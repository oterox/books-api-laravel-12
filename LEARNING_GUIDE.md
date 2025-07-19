# 🎓 Laravel 12 Learning Guide for WordPress Developers

Welcome to your Laravel learning journey! This guide will help you understand Laravel concepts by comparing them to WordPress development.

## 🏗️ What We Built

We created a **Books API** - a RESTful API for managing books with full CRUD operations (Create, Read, Update, Delete). This is similar to building a custom WordPress plugin with REST API endpoints.

## 🔄 WordPress vs Laravel Concepts

### 1. **Models (Eloquent ORM)**
**WordPress:** Custom post types, `WP_Query`, `get_posts()`
**Laravel:** Eloquent Models, relationships, query builders

```php
// WordPress way
$books = get_posts([
    'post_type' => 'book',
    'posts_per_page' => 10
]);

// Laravel way
$books = Book::latest()->paginate(10);
```

### 2. **Controllers**
**WordPress:** Template files, `functions.php`, plugin files
**Laravel:** Dedicated controller classes with specific methods

```php
// WordPress way (in functions.php)
function handle_book_api() {
    if ($_POST['action'] === 'create_book') {
        // Create book logic
    }
}

// Laravel way (in BookController.php)
public function store(Request $request) {
    $book = Book::create($request->validated());
    return response()->json(['success' => true, 'data' => $book]);
}
```

### 3. **Database**
**WordPress:** `$wpdb`, SQL queries, plugin activation hooks
**Laravel:** Migrations, seeders, Eloquent ORM

```php
// WordPress way
global $wpdb;
$wpdb->query("CREATE TABLE {$wpdb->prefix}books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
)");

// Laravel way (in migration)
Schema::create('books', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->timestamps();
});
```

### 4. **Routing**
**WordPress:** `add_action('wp_ajax_*')`, `add_rewrite_rule()`
**Laravel:** Route definitions in `routes/web.php`

```php
// WordPress way
add_action('wp_ajax_get_books', 'get_books_callback');
add_action('wp_ajax_nopriv_get_books', 'get_books_callback');

// Laravel way
Route::get('/api/books', [BookController::class, 'index']);
```

### 5. **Validation**
**WordPress:** Manual validation, `sanitize_text_field()`
**Laravel:** Built-in validation with rules

```php
// WordPress way
if (empty($_POST['title'])) {
    wp_die('Title is required');
}
$title = sanitize_text_field($_POST['title']);

// Laravel way
$request->validate([
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255'
]);
```

## 📁 Project Structure Explained

```
books-api/
├── app/
│   ├── Http/Controllers/
│   │   └── BookController.php    # Handles HTTP requests (like WordPress actions)
│   └── Models/
│       └── Book.php              # Database model (like custom post type)
├── database/
│   ├── migrations/               # Database schema (like plugin activation)
│   └── seeders/                  # Sample data (like default content)
├── routes/
│   └── web.php                   # URL routing (like rewrite rules)
└── public/                       # Web accessible files (like wp-content)
```

## 🚀 How to Test Your API

### Method 1: Browser Interface
1. Start Laragon
2. Navigate to: `http://books-api.test/test.html`
3. Use the interactive interface to test all endpoints

### Method 2: Command Line
```bash
# Get all books
curl http://books-api.test/api/books

# Create a book
curl -X POST http://books-api.test/api/books \
  -H "Content-Type: application/json" \
  -d '{"title":"My Book","author":"Me"}'
```

### Method 3: Postman/Insomnia
Import the endpoints from `API_DOCUMENTATION.md`

## 🎯 Key Laravel Commands

```bash
# Create model, migration, and controller
php artisan make:model Book -mcr

# Run database migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed --class=BookSeeder

# Start development server
php artisan serve

# Clear cache
php artisan cache:clear

# List all routes
php artisan route:list
```

## 🔧 Common Laravel Patterns

### 1. **Model with Validation Rules**
```php
class Book extends Model
{
    protected $fillable = ['title', 'author', 'description'];
    
    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255'
        ];
    }
}
```

### 2. **Controller with Error Handling**
```php
public function store(Request $request): JsonResponse
{
    try {
        $validated = $request->validate(Book::rules());
        $book = Book::create($validated);
        
        return response()->json([
            'success' => true,
            'data' => $book
        ], 201);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    }
}
```

### 3. **API Routes**
```php
Route::prefix('api/books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::get('/{book}', [BookController::class, 'show']);
    Route::put('/{book}', [BookController::class, 'update']);
    Route::delete('/{book}', [BookController::class, 'destroy']);
});
```

## 🎓 Learning Path

### Beginner Level (What we built)
1. ✅ Basic CRUD operations
2. ✅ Model relationships
3. ✅ API responses
4. ✅ Validation
5. ✅ Database migrations

### Intermediate Level (Next steps)
1. **Authentication** - Laravel Sanctum
2. **API Resources** - Better response formatting
3. **Middleware** - Request/response processing
4. **Testing** - PHPUnit tests
5. **Caching** - Redis/Memcached

### Advanced Level
1. **Queues** - Background job processing
2. **Events** - Event-driven architecture
3. **Policies** - Authorization
4. **API Versioning** - Multiple API versions
5. **Rate Limiting** - API protection

## 🔍 Debugging Tips

### 1. **Check Laravel Logs**
```bash
tail -f storage/logs/laravel.log
```

### 2. **Use Laravel Debugbar**
```bash
composer require barryvdh/laravel-debugbar --dev
```

### 3. **Artisan Tinker**
```bash
php artisan tinker
>>> Book::all();
```

### 4. **Route List**
```bash
php artisan route:list
```

## 🛠️ Common Issues & Solutions

### Issue: "Class not found"
**Solution:** Run `composer dump-autoload`

### Issue: "Database connection failed"
**Solution:** Check `.env` file and database credentials

### Issue: "Route not found"
**Solution:** Clear route cache with `php artisan route:clear`

### Issue: "Permission denied"
**Solution:** Set proper permissions on `storage/` and `bootstrap/cache/`

## 📚 Additional Resources

1. **Laravel Documentation**: https://laravel.com/docs
2. **Laracasts**: https://laracasts.com
3. **Laravel News**: https://laravel-news.com
4. **Laravel Discord**: https://discord.gg/laravel

## 🎉 Congratulations!

You've successfully built your first Laravel API! This foundation will help you understand:

- **MVC Architecture** (Model-View-Controller)
- **RESTful API Design**
- **Database Management** with migrations
- **Request Validation**
- **Error Handling**
- **JSON Responses**

Remember: Laravel is powerful but also opinionated. Embrace its conventions, and you'll find development much faster and more enjoyable than WordPress!

Happy coding! 🚀 