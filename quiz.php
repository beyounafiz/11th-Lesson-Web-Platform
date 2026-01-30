<?php
// quiz.php
require 'config.php';

// Require login to access quiz
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// In your original Flask app, you had (commented) Quiz.query.all()
// Since there is no Quiz table now, we just show the quiz page.
// Make sure the form in templates/quiz.html posts to submit.php.

include __DIR__ . '/templates/quiz.html';
