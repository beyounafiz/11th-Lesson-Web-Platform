<?php
// dindex.php
require 'config.php';

// If this page should be protected, uncomment:
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit;
// }

// Simply render the original dindex.html template
include __DIR__ . '/templates/dindex.html';
