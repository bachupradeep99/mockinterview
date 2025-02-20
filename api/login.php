<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php'); // Make sure db.php uses MySQLi, not PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        // Prepare the SQL query
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the email parameter
            $stmt->bind_param("s", $email);

            // Execute the query
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Check if user exists and password matches
            if ($user && $password === $user['password']) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                echo json_encode(["success" => true, "message" => "Login successful!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Invalid email or password."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to prepare statement."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
