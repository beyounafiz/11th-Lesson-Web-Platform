<?php
// dashboard.php
require 'config.php';

// Require login
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Get logged-in user data
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$_SESSION['email']]);
$user = $stmt->fetch();

if (!$user) {
    // If user not found, force logout
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

// --- Option 1: keep template as pure HTML + simple replacements ---
// Load the original dashboard.html and replace Jinja-like variables
$dashboardPath = __DIR__ . '/templates/dashboard.html';
$html = file_get_contents($dashboardPath);

// Example: if original template had {{ user.name }}
$html = str_replace('{{ user.name }}', htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'), $html);

// If your template uses {{ email }} or similar, replace more tokens here:
// $html = str_replace('{{ user.email }}', htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'), $html);

echo $html;
