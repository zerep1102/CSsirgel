<?php
include('config.php');

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);




// Sanitize user input data
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);





// Check if the email or username already exists
$checkSql = "SELECT * FROM finals WHERE email = ? OR username = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ss", $email, $username);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo "Error: Email or Username already exists.";
    $checkStmt->close();
} else {
    // If no existing email or username, proceed to insert
    $sql = "INSERT INTO finals (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>