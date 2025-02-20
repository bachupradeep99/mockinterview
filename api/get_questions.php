<?php
// get_questions.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$skill = $_GET['skill'];

// Prevent SQL injection
$skill = mysqli_real_escape_string($conn, $skill);

// Fetch questions from the relevant table
$sql = "SELECT id, question FROM " . strtolower($skill) . "_questions LIMIT 10";
$result = $conn->query($sql);

$questions = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

echo json_encode($questions);
$conn->close();
?>
