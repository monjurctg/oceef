<?php
// Check if files exist
echo "<h1>File Check</h1>";

// Check logo.png
$logoPath = 'public/logo.png';
if (file_exists($logoPath)) {
    echo "<p>✓ Logo exists: $logoPath</p>";
} else {
    echo "<p>✗ Logo missing: $logoPath</p>";
}

// Check storage directory
$storagePath = 'storage/app/public';
if (is_dir($storagePath)) {
    echo "<p>✓ Storage directory exists: $storagePath</p>";

    // List files in storage
    $files = scandir($storagePath);
    echo "<p>Files in storage:</p><ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li>$file</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p>✗ Storage directory missing: $storagePath</p>";
}

// Check specific passport photo
$passportPhoto = 'storage/app/public/1764158877_passport_6926ed9dc4093.jpg';
if (file_exists($passportPhoto)) {
    echo "<p>✓ Passport photo exists: $passportPhoto</p>";
} else {
    echo "<p>✗ Passport photo missing: $passportPhoto</p>";
}
?>