<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menstrual Tracking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #202020; /* Dark gray */
            color: #ffffff; /* White */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('images/bgpink.gif');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 600px;
            width: 90%;
            margin: auto;
            text-align: center;
        }
        h2 {
            color: #ff0099; /* Pink */
            margin-bottom: 30px;
        }
        form {
            background-color: #101010; /* Darker gray */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 153, 0.5); /* Pink shadow */
        }
        label {
            display: block;
            margin-bottom: 15px;
        }
        input[type=date], input[type=number] {
            padding: 10px;
            margin-bottom: 20px;
            width: calc(100% - 22px);
            border: 1px solid #ff0099; /* Pink */
            border-radius: 5px;
            background-color: #303030; /* Dark gray */
            color: #ffffff; /* White */
        }
        input[type=submit] {
            background-color: #ff0099; /* Pink */
            color: #ffffff; /* White */
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type=submit]:hover {
            background-color: #e60073; /* Darker pink */
        }
        .output {
            margin-top: 40px;
        }
        .output p {
            font-size: 18px;
            font-weight: bold;
        }
        .output p span {
            color: #ff0099; /* Pink */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Menstrual Tracking</h2>
        <form method="post">
            <label for="start_date">Enter the start date of your last menstrual cycle:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="cycle_length">Enter the average length of your menstrual cycle (in days):</label>
            <input type="number" id="cycle_length" name="cycle_length" min="20" max="45" required>
            <input type="submit" value="Calculate">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start_date = $_POST["start_date"];
            $cycle_length = $_POST["cycle_length"];

            // Calculating the next period date
            $next_period_date = date('Y-m-d', strtotime($start_date . " + $cycle_length days"));

            echo "<div class='output'><p>Your next period is expected around: <span>$next_period_date</span></p></div>";
        }
        ?>
    </div>
</body>
</html>
