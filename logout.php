<?php
// logout.php
require 'config.php';

// Clear all session data and destroy session
session_unset();
session_destroy();

// Redirect to login page (or index.php if you prefer)
header('Location: login.php');
exit;
