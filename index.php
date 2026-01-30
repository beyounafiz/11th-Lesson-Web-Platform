<?php
// index.php
require 'config.php';

// If user already logged in, you may redirect to dashboard
// if (isset($_SESSION['email'])) {
//     header('Location: dashboard.php');
//     exit;
// }

// Just render the original index.html from templates
include __DIR__ . '/templates/index.html';
