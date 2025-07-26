# Books API Documentation

Welcome to the Laravel 12 Books API! This is a simple RESTful API for managing books with JWT authentication.

## Authentication

This API uses JWT (JSON Web Tokens) for authentication. All book endpoints require a valid JWT token.

### Getting Started

1. **Register a new user** to get your first token
2. **Login** to get a new token
3. **Include the token** in the Authorization header for all protected requests

### Authentication Endpoints

#### Register User
**POST** `/api/auth/register`

Creates a new user account and returns a JWT token.

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response:**
```json
{
    "message": "User successfully registered",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2025-01-20T10:00:00.000000Z",
        "updated_at": "2025-01-20T10:00:00.000000Z"
    },
    "authorization": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
        "type": "bearer"
    }
}
```

#### Login
**POST** `/api/auth/login`

Authenticates a user and returns a JWT token.

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

#### Get User Profile
**GET** `/api/auth/user-profile`

Returns the authenticated user's profile information.

**Headers:**
```
Authorization: Bearer {your_jwt_token}
```

**Response:**
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2025-01-20T10:00:00.000000Z",
    "updated_at": "2025-01-20T10:00:00.000000Z"
}
```

#### Refresh Token
**POST** `/api/auth/refresh`

Refreshes the JWT token.

**Headers:**
```
Authorization: Bearer {your_jwt_token}
```

**Response:**
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

#### Logout
**POST** `/api/auth/logout`

Invalidates the current JWT token.

**Headers:**
```
Authorization: Bearer {your_jwt_token}
```

**Response:**
```json
{
    "message": "User successfully signed out"
}
```

### Using JWT Tokens

For all protected endpoints, include the JWT token in the Authorization header:

```
Authorization: Bearer {your_jwt_token}
```

**Example with cURL:**
```bash
curl -X GET "http://localhost:8000/api/books" \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." \
  -H "Content-Type: application/json"
```

### Error Responses

#### Unauthorized (401)
```json
{
    "status": "Token is Invalid"
}
```

```json
{
    "status": "Token is Expired"
}
```

```json
{
    "status": "Authorization Token not found"
}
```

## Base URL
```
https://books-api.test
```

## Protected Endpoints

All book endpoints require JWT authentication. Include the token in the Authorization header.

### 1. Get All Books
**GET** `/api/books`

Returns a paginated list of all books.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "The Great Gatsby",
            "author": "F. Scott Fitzgerald",
            "description": "A story of the fabulously wealthy Jay Gatsby...",
            "isbn": "9780743273565",
            "published_year": 1925,
            "price": "12.99",
            "created_at": "2025-07-19T12:37:24.000000Z",
            "updated_at": "2025-07-19T12:37:24.000000Z"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 5
    }
}
```

### 2. Get Single Book
**GET** `/api/books/{id}`

Returns a specific book by ID.

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "The Great Gatsby",
        "author": "F. Scott Fitzgerald",
        "description": "A story of the fabulously wealthy Jay Gatsby...",
        "isbn": "9780743273565",
        "published_year": 1925,
        "price": "12.99",
        "created_at": "2025-07-19T12:37:24.000000Z",
        "updated_at": "2025-07-19T12:37:24.000000Z"
    }
}
```

### 3. Create New Book
**POST** `/api/books`

Creates a new book.

**Request Body:**
```json
{
    "title": "New Book Title",
    "author": "Author Name",
    "description": "Book description (optional)",
    "isbn": "9781234567890",
    "published_year": 2024,
    "price": 19.99
}
```

**Response:**
```json
{
    "success": true,
    "message": "Book created successfully",
    "data": {
        "id": 6,
        "title": "New Book Title",
        "author": "Author Name",
        "description": "Book description",
        "isbn": "9781234567890",
        "published_year": 2024,
        "price": "19.99",
        "created_at": "2025-07-19T12:37:24.000000Z",
        "updated_at": "2025-07-19T12:37:24.000000Z"
    }
}
```

### 4. Update Book
**PUT** `/api/books/{id}`

Updates an existing book.

**Request Body:**
```json
{
    "title": "Updated Book Title",
    "author": "Updated Author Name",
    "price": 24.99
}
```

**Response:**
```json
{
    "success": true,
    "message": "Book updated successfully",
    "data": {
        "id": 1,
        "title": "Updated Book Title",
        "author": "Updated Author Name",
        "description": "A story of the fabulously wealthy Jay Gatsby...",
        "isbn": "9780743273565",
        "published_year": 1925,
        "price": "24.99",
        "created_at": "2025-07-19T12:37:24.000000Z",
        "updated_at": "2025-07-19T12:37:24.000000Z"
    }
}
```

### 5. Delete Book
**DELETE** `/api/books/{id}`

Deletes a book.

**Response:**
```json
{
    "success": true,
    "message": "Book deleted successfully"
}
```

### 6. Search Books
**GET** `/api/books/search?q={search_term}`

Searches books by title, author, or description.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "The Great Gatsby",
            "author": "F. Scott Fitzgerald",
            "description": "A story of the fabulously wealthy Jay Gatsby...",
            "isbn": "9780743273565",
            "published_year": 1925,
            "price": "12.99",
            "created_at": "2025-07-19T12:37:24.000000Z",
            "updated_at": "2025-07-19T12:37:24.000000Z"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 1
    }
}
```

## Validation Rules

- **title**: Required, string, max 255 characters
- **author**: Required, string, max 255 characters
- **description**: Optional, string
- **isbn**: Optional, string, max 13 characters, must be unique
- **published_year**: Optional, integer, between 1800 and current year + 1
- **price**: Optional, numeric, between 0 and 999999.99

## Error Responses

### Validation Error (422)
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "title": ["The title field is required."],
        "author": ["The author field is required."]
    }
}
```

### Not Found Error (404)
```json
{
    "message": "No query results for model [App\\Models\\Book] 999"
}
```

### Server Error (500)
```json
{
    "success": false,
    "message": "Failed to create book",
    "error": "Error details"
}
```

## Testing the API

You can test the API using tools like:
- **Postman**
- **Insomnia**
- **cURL**
- **Thunder Client** (VS Code extension)

### Example cURL Commands

1. **Get all books:**
   ```bash
   curl -X GET https://books-api.test/api/books
   ```

2. **Create a new book:**
   ```bash
   curl -X POST https://books-api.test/api/books \
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
   curl -X GET "https://books-api.test/api/books/search?q=gatsby"
   ```

## Laravel Concepts Used

1. **Models**: Eloquent ORM with fillable fields and validation rules
2. **Controllers**: RESTful controller with proper error handling
3. **Migrations**: Database schema definition
4. **Seeders**: Sample data population
5. **Routes**: API route definitions
6. **Validation**: Request validation with custom rules
7. **JSON Responses**: Consistent API response format

## Next Steps

To extend this API, you could:
1. Add authentication (Laravel Sanctum)
2. Add more complex relationships (authors, categories, etc.)
3. Implement file uploads for book covers
4. Add rate limiting
5. Create API resources for better response formatting
6. Add caching for better performance 