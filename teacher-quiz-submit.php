<?php
// teacher-quiz-submit.php
require 'config.php';

// Optional: only logged-in users can create questions
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question       = trim($_POST['question'] ?? '');
    $option1        = trim($_POST['option1'] ?? '');
    $option2        = trim($_POST['option2'] ?? '');
    $option3        = trim($_POST['option3'] ?? '');
    $correct_answer = trim($_POST['correct_answer'] ?? '');

    if ($question && $option1 && $option2 && $option3 && $correct_answer) {
        $sql = 'INSERT INTO quiz_questions (question, option1, option2, option3, correct_answer)
                VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question, $option1, $option2, $option3, $correct_answer]); // [web:82][web:88]

        // After saving, go back to quiz page
        header('Location: quiz.php');
        exit;
    } else {
        // Missing data: you could add error handling or messages here
        header('Location: quiz.php');
        exit;
    }
}

// If someone opens this file directly, just redirect
header('Location: quiz.php');
exit;
