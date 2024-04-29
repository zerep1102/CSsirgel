<?php
session_start();

$conn = new mysqli("localhost", "root", "", "sirgel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $username = $_SESSION['username'];
    $sql = "INSERT INTO ovulation (date, username) VALUES ('$date', '$username')";

    if ($conn->query($sql) === TRUE) {
        echo "Ovulation record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM ovulation WHERE username = '$username' ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Ovulation Dates</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["date"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No ovulation records found";
}

$conn->close();
