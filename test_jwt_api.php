<?php

/**
 * JWT Authentication Test Script
 * 
 * This script demonstrates how to use the JWT authentication with the Books API
 */

$baseUrl = 'http://localhost:8000/api';

echo "=== JWT Authentication Test ===\n\n";

// Test 1: Register a new user
echo "1. Testing User Registration...\n";
$registerData = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123'
];

$registerResponse = makeRequest($baseUrl . '/auth/register', 'POST', $registerData);
echo "Register Response: " . $registerResponse['status'] . "\n";
if ($registerResponse['status'] === 201) {
    $registerData = json_decode($registerResponse['body'], true);
    $token = $registerData['authorization']['token'];
    echo "Token received: " . substr($token, 0, 20) . "...\n\n";
} else {
    echo "Register failed: " . $registerResponse['body'] . "\n\n";
    exit;
}

// Test 2: Login with the user
echo "2. Testing User Login...\n";
$loginData = [
    'email' => 'test@example.com',
    'password' => 'password123'
];

$loginResponse = makeRequest($baseUrl . '/auth/login', 'POST', $loginData);
echo "Login Response: " . $loginResponse['status'] . "\n";
if ($loginResponse['status'] === 200) {
    $loginData = json_decode($loginResponse['body'], true);
    $token = $loginData['access_token'];
    echo "Login successful, token: " . substr($token, 0, 20) . "...\n\n";
} else {
    echo "Login failed: " . $loginResponse['body'] . "\n\n";
    exit;
}

// Test 3: Get user profile (protected route)
echo "3. Testing Protected Route (User Profile)...\n";
$profileResponse = makeRequest($baseUrl . '/auth/user-profile', 'GET', [], $token);
echo "Profile Response: " . $profileResponse['status'] . "\n";
if ($profileResponse['status'] === 200) {
    $profileData = json_decode($profileResponse['body'], true);
    echo "User Profile: " . $profileData['name'] . " (" . $profileData['email'] . ")\n\n";
} else {
    echo "Profile access failed: " . $profileResponse['body'] . "\n\n";
}

// Test 4: Access books API (protected route)
echo "4. Testing Books API (Protected Route)...\n";
$booksResponse = makeRequest($baseUrl . '/books', 'GET', [], $token);
echo "Books Response: " . $booksResponse['status'] . "\n";
if ($booksResponse['status'] === 200) {
    $booksData = json_decode($booksResponse['body'], true);
    echo "Books count: " . count($booksData['data']) . "\n\n";
} else {
    echo "Books access failed: " . $booksResponse['body'] . "\n\n";
}

// Test 5: Try to access books without token (should fail)
echo "5. Testing Books API without Token (Should Fail)...\n";
$booksNoTokenResponse = makeRequest($baseUrl . '/books', 'GET', []);
echo "Books (No Token) Response: " . $booksNoTokenResponse['status'] . "\n";
if ($booksNoTokenResponse['status'] === 401) {
    echo "Correctly blocked access without token\n\n";
} else {
    echo "Unexpected response: " . $booksNoTokenResponse['body'] . "\n\n";
}

// Test 6: Logout
echo "6. Testing Logout...\n";
$logoutResponse = makeRequest($baseUrl . '/auth/logout', 'POST', [], $token);
echo "Logout Response: " . $logoutResponse['status'] . "\n";
if ($logoutResponse['status'] === 200) {
    echo "Logout successful\n\n";
} else {
    echo "Logout failed: " . $logoutResponse['body'] . "\n\n";
}

echo "=== Test Complete ===\n";

/**
 * Helper function to make HTTP requests
 */
function makeRequest($url, $method = 'GET', $data = [], $token = null) {
    $ch = curl_init();
    
    $headers = ['Content-Type: application/json'];
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'body' => $response
    ];
} 