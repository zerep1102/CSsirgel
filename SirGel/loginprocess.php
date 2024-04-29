<?php
include('config.php');


// sanitize login
function sanitizeString($str)
{

    $str = trim($str);

    return filter_var($str, FILTER_SANITIZE_STRING);
}

$loginUsername = sanitizeString($_POST['username']);
$loginPassword = sanitizeString($_POST['password']);


// Make sure the session starts on every page that uses sessions
session_start();

$response = array();

// Check if the request is made via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // reCAPTCHA validation
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Le_5skpAAAAAJzCRL2Yz7jkdMM1HwnhRDIdZP6l"; // Replace it with your actual secret key from Google
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
    $responseData = json_decode($verifyResponse);
    
    if ($responseData->success) {
        // Capture data from the form
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Prepare SQL query to fetch user details
        $query = "SELECT * FROM finals WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check if user exists and password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            // Set response status to success
            $response['status'] = 'success';
            $response['message'] = 'Login successful.';
        } else {
            // Set response status to error
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password.';
        }

        // Close database connection
        $stmt->close();
        $conn->close();
    } else {
        // Handle failed reCAPTCHA validation
        $response['status'] = 'recaptcha_error';
        $response['message'] = 'reCAPTCHA verification failed, please try again.';
    }

    // Send response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // If the request is not made via POST, return an error
    header("HTTP/1.0 405 Method Not Allowed");
    echo "Method Not Allowed";
}
?>
