<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are present
    if (isset($_POST['question'], $_POST['category'])) {
        $question = htmlspecialchars(trim($_POST['question']));
        $category = htmlspecialchars(trim($_POST['category'])); // Either 'fresher' or 'working professional'

        try {
            // Insert question into the database
            $sql = "INSERT INTO questions (question, category) VALUES (:question, :category)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':question', $question);
            $stmt->bindParam(':category', $category);

            if ($stmt->execute()) {
                echo json_encode(["message" => "Question added successfully."]);
            } else {
                echo json_encode(["message" => "Failed to add question."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["message" => "Database error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "All fields are required."]);
    }
} else {
    echo json_encode(["message" => "Invalid request method."]);
}
?>
