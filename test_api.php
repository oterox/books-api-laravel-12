<?php

/**
 * Simple test script for the Books API
 * Run this script to test all API endpoints
 */

$baseUrl = 'https://books-api.test/api/books';

echo "🧪 Testing Books API\n";
echo "===================\n\n";

// Test 1: Get all books
echo "1. Testing GET /api/books (Get all books)\n";
$response = file_get_contents($baseUrl);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success! Found " . count($data['data']) . " books\n";
    if (!empty($data['data'])) {
        echo "   First book: " . $data['data'][0]['title'] . " by " . $data['data'][0]['author'] . "\n";
    }
} else {
    echo "❌ Failed to get books\n";
}
echo "\n";

// Test 2: Get single book
echo "2. Testing GET /api/books/1 (Get single book)\n";
$response = file_get_contents($baseUrl . '/1');
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success! Book: " . $data['data']['title'] . "\n";
} else {
    echo "❌ Failed to get book\n";
}
echo "\n";

// Test 3: Search books
echo "3. Testing GET /api/books/search?q=gatsby (Search books)\n";
$response = file_get_contents($baseUrl . '/search?q=gatsby');
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success! Found " . count($data['data']) . " matching books\n";
} else {
    echo "❌ Failed to search books\n";
}
echo "\n";

// Test 4: Create new book
echo "4. Testing POST /api/books (Create new book)\n";
$newBook = [
    'title' => 'Test Book from PHP',
    'author' => 'Test Author',
    'description' => 'A test book created via PHP script',
    'isbn' => '9781234567892',
    'published_year' => 2024,
    'price' => 16.99
];

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($newBook)
    ]
]);

$response = file_get_contents($baseUrl, false, $context);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success! Created book: " . $data['data']['title'] . "\n";
    $newBookId = $data['data']['id'];
} else {
    echo "❌ Failed to create book\n";
    if (isset($data['errors'])) {
        print_r($data['errors']);
    }
    $newBookId = null;
}
echo "\n";

// Test 5: Update book (if creation was successful)
if ($newBookId) {
    echo "5. Testing PUT /api/books/{$newBookId} (Update book)\n";
    $updateData = [
        'title' => 'Updated Test Book',
        'author' => 'Test Author',
        'price' => 19.99
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'PUT',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($updateData)
        ]
    ]);

    $response = file_get_contents($baseUrl . '/' . $newBookId, false, $context);
    $data = json_decode($response, true);

    if ($data && isset($data['success']) && $data['success']) {
        echo "✅ Success! Updated book: " . $data['data']['title'] . " (Price: $" . $data['data']['price'] . ")\n";
    } else {
        echo "❌ Failed to update book\n";
    }
    echo "\n";

    // Test 6: Delete book
    echo "6. Testing DELETE /api/books/{$newBookId} (Delete book)\n";
    $context = stream_context_create([
        'http' => [
            'method' => 'DELETE'
        ]
    ]);

    $response = file_get_contents($baseUrl . '/' . $newBookId, false, $context);
    $data = json_decode($response, true);

    if ($data && isset($data['success']) && $data['success']) {
        echo "✅ Success! Book deleted\n";
    } else {
        echo "❌ Failed to delete book\n";
    }
    echo "\n";
}

echo "🎉 API testing completed!\n";
echo "You can now use tools like Postman or curl to test the API further.\n";
echo "Check the API_DOCUMENTATION.md file for detailed usage instructions.\n"; 