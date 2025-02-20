<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php'); // Make sure db.php uses MySQLi, not PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['mobile'], $_POST['password'], $_POST['location'])) {
        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $last_name = htmlspecialchars(trim($_POST['last_name']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mobile = htmlspecialchars(trim($_POST['mobile']));
        $password = trim($_POST['password']);
        $location = htmlspecialchars(trim($_POST['location']));

        // Check if the email already exists
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["success" => false, "message" => "Email already exists."]);
            exit;
        }

        // Insert new user data
        $sql = "INSERT INTO users (first_name, last_name, email, mobile, password, location) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $mobile, $password, $location);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Registration successful!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to register user."]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
