<?php
// dashboard-search.php
require 'config.php';

// If search page should only be visible to logged-in users:
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// For now this just renders the original dashboard-search.html.
// If you later add real search (e.g., searching quiz submissions),
// you can read $_GET or $_POST here and query the DB with $pdo.
include __DIR__ . '/templates/dashboard-search.html';
