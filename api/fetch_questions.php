<?php
include 'db.php';

// Allowed skills and their corresponding table names
$allowedSkills = [
    "html" => "httml_questions", 
    "css" => "css_questions", 
    "javascript" => "javascript_questions",
    "react" => "react_questions",
    "vue" => "vue_questions",
    "os" => "os_questions",
    "sql" => "sql_questions",
    "node.js" => "node_questions",
    "java" => "java_questions",
    "python" => "python_questions",
    "spring boot" => "springboot_questions",
    "django" => "django_questions",
    "tableau" => "tableau_questions",
    "mongodb" => "mongodb_questions",
    "express.js" => "express_questions",
    "c" => "c_questions",
    "data structure" => "ds_questions",
    "dbms" => "dbms_questions",
    "power bi" => "powerbi_questions",
    "aws" => "aws_questions",
    "docker" => "docker_questions",
    "kubernetes" => "kubernetes_questions",
    "terraform" => "terraform_questions",
    "selenium" => "selenium_questions",
    "junit" => "junit_questions",
    "cypress" => "cypress_questions",
    "appium" => "appium_questions",
    "dotnet" => "dotnet_questions",
    "software testing" => "testing_questions",
    "tensorflow" => "tensorflow_questions",
    "pytorch" => "pytorch_questions",
    "scikit-learn" => "scikit_questions",
    "excel" => "excel_questions",
    "network" => "network_questions",
    "unix" => "unix_questions"
];

// DEBUG: Check if `skills` parameter is received
if (!isset($_GET['skills']) || empty($_GET['skills'])) {
    echo json_encode(['error' => 'No skills provided']);
    exit;
}

// Convert skills input to lowercase and trim spaces
$skillsArray = array_map('strtolower', array_map('trim', explode(',', $_GET['skills'])));

// Filter only valid skills
$filteredSkills = array_intersect_key($allowedSkills, array_flip($skillsArray));

if (empty($filteredSkills)) {
    echo json_encode(['error' => 'Invalid skill selection']);
    exit;
}

$queries = [];
$params = [];
$types = '';

foreach ($filteredSkills as $skill => $table) {
    $queries[] = "(SELECT id, question, ? AS skills FROM `$table` ORDER BY RAND() LIMIT 3)";
    $params[] = $skill;
    $types .= 's';
}

$finalQuery = implode(" UNION ALL ", $queries);
$stmt = $conn->prepare($finalQuery);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

header('Content-Type: application/json');
echo json_encode($questions);
?>
