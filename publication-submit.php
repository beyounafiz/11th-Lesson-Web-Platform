<?php
// publication-submit.php
require 'config.php';

// Optional: only logged-in users can publish
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit;
// }

// Helper: get current user_id if logged in
$user_id = null;
if (isset($_SESSION['email'])) {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$_SESSION['email']]);
    $u = $stmt->fetch();
    if ($u) {
        $user_id = $u['id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $contentType = trim($_POST['content-type'] ?? '');
    $file        = $_FILES['file-upload'] ?? null;

    // Basic validation
    if (!$title || !$description || !$contentType || !$file) {
        header('Location: publication.php');
        exit;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        // File upload error; you could handle this better
        header('Location: publication.php');
        exit;
    }

    // Ensure uploads directory exists
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Build a safe file name
    $originalName = basename($file['name']);
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
    $targetPath = $uploadDir . $safeName;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        header('Location: publication.php');
        exit;
    }

    // Store relative path in DB
    $relativePath = 'uploads/' . $safeName;

    // Insert into publications table
    $sql = 'INSERT INTO publications (user_id, title, description, content_type, file_path)
            VALUES (?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $title, $description, $contentType, $relativePath]); // [web:82][web:88]

    // Show the thank-you page
    include __DIR__ . '/templates/publication-submit.html';
    exit;
}

// If not POST, go back to form
header('Location: publication.php');
exit;
