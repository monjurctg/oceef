<?php

// Simple script to mark migration as run
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ocecf";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
    $stmt->execute(['0001_01_01_000000_create_users_table', 1]);

    echo "Migration marked as run successfully\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}