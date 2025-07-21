<?php
$db_host = 'sql213.infinityfree.com';
$db_user = 'if0_39496269';
$db_pass = '3AzfLDHcbQfIO';
$db_name = 'if0_39496269_portfolio';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$name        = trim($_POST['name'] ?? '');
$email       = trim($_POST['email'] ?? '');
$project     = trim($_POST['project'] ?? '');
$message     = trim($_POST['message'] ?? '');

if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Please enter a valid name and email address.');
}

$stmt = $conn->prepare(
    "INSERT INTO contacts (name, email, project_type, message) 
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param('ssss', $name, $email, $project, $message);

if ($stmt->execute()) {
    header('Location: /thank_you.html');
    exit;
} else {
    echo 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
