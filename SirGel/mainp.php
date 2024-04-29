<?php
session_start(); // Start the session at the beginning of the file

// Check if the logout action has been requested
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    // Clear the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Redirect to login page
    header("Location: login.php");
    exit;
}


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Menstrual Tracker</title>
</head>
<body>

<style>
    .navbar {
        background-color: rgba(148, 0, 211, 0.2);
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid rgba(148, 0, 211, 0.2);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(15px);
    }
    
    
    .navbar a {
        background-image: linear-gradient(to right, #ffc3cc, #fff);
        color: #333;
        text-decoration: none;
        padding: 10px 25px;
        border-radius: 20px;
        background-color: #007bff;
        transition: background-color 0.3s ease;
        font-size: 18px;
        font-weight: 500;
        display: inline-block;
    }
    
    .navbar a:hover {
        background-color: #0056b3;
    }
    
</style>



    
    <nav class="navbar">
        <a href="index.php" class="navbar-item">Home</a>
        <a href="javascript:void(0);" onclick="window.open('features.php', '_blank');" class="navbar-item">Features</a>
        <a href="ovulate.php" onclick="location.href=this.firstChild.href;" class="navbar-item">Ovulate Tracker</a>
        <a href="health.php" class="navbar-item">Health</a>
        <div style="float:right">

        
            <a href="?logout=true" class="navbar-item">Logout</a>
        </div>
    </nav>
    <style>
        .navbar-item:hover {
            transition: 0.3s;
            background-image: linear-gradient(to right, #9a6fd8, #c79ef9);
        }
    </style>


    <div class="container">
    <header>
        <h1>Menstrual Tracker</h1>
    </header>
    <main>
        <div class="content">
            <div class="main-content">
                <h2>Welcome to Menstrual Tracker</h2>
                <p>Keep track of your menstrual cycle with our easy-to-use tracker. Whether you're planning a pregnancy, managing your health, or simply staying informed about your body, our tool is here to help.</p>
                <h3>Key Features:</h3>
                <ul>
                    <li>Track your menstrual cycle with customizable period and ovulation predictions.</li>
                    <li>Record symptoms, moods, and other factors affecting your cycle.</li>
                    <li>Receive personalized insights and health tips based on your data.</li>
                    <li>Set reminders for upcoming periods, ovulation, and appointments.</li>
                    <li>Access your data securely from any device.</li>
                </ul>
                <p>Sign up now to get started!</p>
               
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Menstrual Tracker</p>
    </footer>
</div>

</body>
</html>




<style>
    body {
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('images/bgpink.gif');
        background-size: cover;
        color: #000;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 50px auto;
        padding: 40px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(15px);
        animation: fadeIn 1s ease-out; /* Apply the fade-in animation */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    header {
        text-align: center;
        margin-bottom: 30px;
    }

    header h1 {
        font-size: 42px;
        color: #ff69b4;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .info,
    .features {
        flex: 1;
        margin-right: 20px;
    }

    h2 {
        font-size: 32px;
        color: #ff69b4;
        margin-top: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    p {
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    ol,
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    li {
        margin-bottom: 10px;
        font-size: 18px;
        line-height: 1.6;
    }

    footer {
        text-align: center;
        margin-top: 30px;
        font-size: 14px;
        color: #888;
    }
</style>

</style>