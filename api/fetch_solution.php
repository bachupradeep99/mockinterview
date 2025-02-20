<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'You must log in first.']);
    exit;
}

include('db.php'); 

// Get the logged-in user ID
$user_id = $_SESSION['user_id'];

$sql = "SELECT `feedback`, `score` FROM `user_answers` WHERE `user_id` = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['error' => 'Error preparing SQL: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$answers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Determine result based on score
        $row['result'] = ($row['score'] >= 50) ? 'Pass' : 'Fail';
        $answers[] = $row;
    }
} else {
    echo json_encode(['message' => 'No answers found.', 'score' => 0]);
    exit;
}

header('Content-Type: application/json');
echo json_encode($answers);
$stmt->close();
$conn->close();
?>
