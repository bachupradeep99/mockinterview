<?php
session_start();
include 'db.php';

header('Content-Type: application/json'); // Ensure JSON response

$response = ['success' => false];

$user_id = $_SESSION['user_id'] ?? $_POST['user_id'];

if (!isset($_POST['question_id'], $_POST['skill'], $_POST['user_answer'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$question_ids = $_POST['question_id'];
$skills = $_POST['skill'];
$user_answers = $_POST['user_answer'];

for ($i = 0; $i < count($question_ids); $i++) {
    $question_id = mysqli_real_escape_string($conn, $question_ids[$i]);
    $skill = mysqli_real_escape_string($conn, $skills[$i]);
    $user_answer = mysqli_real_escape_string($conn, $user_answers[$i]);

    $query = "INSERT INTO user_answers (question_id, skill, user_answer, user_id) 
              VALUES ('$question_id', '$skill', '$user_answer', '$user_id')";

    if (!mysqli_query($conn, $query)) {
        echo json_encode(['success' => false, 'message' => 'Database insert error']);
        exit;
    }
}

// **Find your correct Python and script paths**
$pythonPath = "C:\\Program Files\\Python311\\python.exe";
$scriptPath = "C:\\xampp\\htdocs\\mockinterview\\evaluate.py";
$command = escapeshellcmd("\"$pythonPath\" \"$scriptPath\" $user_id 2>&1");
$output = shell_exec($command);
file_put_contents("eval_log.txt", $output, FILE_APPEND);


if ($output === null) {
    echo json_encode(['success' => false, 'message' => 'Evaluation failed']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Evaluation completed']);
?>
