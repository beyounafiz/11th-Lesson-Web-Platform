<?php
// publication.php
require 'config.php';

// If this page should only be visible to logged-in users, uncomment:
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit;
// }

// Just render your original publication.html template
include __DIR__ . '/templates/publication.html';
