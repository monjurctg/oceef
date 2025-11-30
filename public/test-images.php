<?php
// Test image accessibility in cPanel environment
echo "<h1>Image Accessibility Test</h1>";

// Test logo
echo "<h2>Logo Test</h2>";
$logoPath = 'logo.png';
if (file_exists($logoPath)) {
    echo "<p style='color: green;'>✓ Logo file exists</p>";
    echo "<img src='/logo.png' alt='Logo' style='max-width: 200px; border: 1px solid #ccc;'>";
} else {
    echo "<p style='color: red;'>✗ Logo file does not exist</p>";
}

echo "<hr>";

// Test storage directory
echo "<h2>Storage Directory Test</h2>";
$storagePath = 'storage';
if (is_dir($storagePath)) {
    echo "<p style='color: green;'>✓ Storage directory exists</p>";
} else {
    echo "<p style='color: red;'>✗ Storage directory does not exist</p>";
}

// Test specific image from JSON data
echo "<h2>Specific Image Test</h2>";
$imageFile = 'storage/app/public/1764158877_passport_6926ed9dc4093.jpg';
if (file_exists($imageFile)) {
    echo "<p style='color: green;'>✓ Sample passport photo exists</p>";
    echo "<img src='/storage/1764158877_passport_6926ed9dc4093.jpg' alt='Sample Passport' style='max-width: 200px; border: 1px solid #ccc;'>";
} else {
    echo "<p style='color: red;'>✗ Sample passport photo does not exist</p>";
}

echo "<hr>";

// Show server info
echo "<h2>Server Information</h2>";
echo "<p>Document Root: <code>" . ($_SERVER['DOCUMENT_ROOT'] ?? 'Not set') . "</code></p>";
echo "<p>Request URI: <code>" . ($_SERVER['REQUEST_URI'] ?? 'Not set') . "</code></p>";
?>