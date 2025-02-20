<?php
session_start();
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $user_id = $_SESSION['user_id'];

    // Run the Python evaluation script
    $output = shell_exec("C:\Users\A\AppData\Roaming\Microsoft\Windows\Start Menu\Programs\Python 3.11 evaluate.py " . escapeshellarg($user_id));

    if ($output !== null) {
        echo json_encode(["success" => true, "message" => "Evaluation completed."]);
    } else {
        echo json_encode(["success" => false, "message" => "Evaluation script failed."]);
    }
}
?>
