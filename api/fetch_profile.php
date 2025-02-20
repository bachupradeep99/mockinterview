<?php
session_start();
include "db.php";

header('Content-Type: application/json');  // Ensure JSON response

if (!isset($_SESSION['userid'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$userid = $_SESSION['userid'];

$userQuery = $conn->prepare("SELECT first_name, last_name, email, phone FROM user WHERE id = ?");
$userQuery->bind_param("i", $userid);
$userQuery->execute();
$userResult = $userQuery->get_result();

if ($userResult->num_rows > 0) {
    $userData = $userResult->fetch_assoc();
    
    $testQuery = $conn->prepare("SELECT skills_selected, score, feedback FROM user_answers WHERE userid = ?");
    $testQuery->bind_param("i", $userid);
    $testQuery->execute();
    $testResult = $testQuery->get_result();

    $tests = [];
    while ($row = $testResult->fetch_assoc()) {
        $tests[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "user" => $userData,
        "tests" => $tests
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "User not found in database."]);
}
?>
