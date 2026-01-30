<?php
// help.php
require 'config.php';

// Help page can be public or protected.
// To require login, uncomment below:
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit;
// }

// Just render your original help.html template
include __DIR__ . '/templates/help.html';
