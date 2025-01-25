<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if flight_no is passed via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flight_no'])) {
    $flight_no = $_POST['flight_no'];

    // Query to fetch flight details
    $sql = "SELECT * FROM flights WHERE flight_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $flight_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $flight = $result->fetch_assoc();

        echo "<h1 style='text-align:center;'>Flight Ticket</h1>";
        echo "<div style='width: 50%; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>";
        echo "<h2 style='text-align:center;'>" . htmlspecialchars($flight['operator']) . "</h2>";
        echo "<p><strong>Flight No:</strong> " . htmlspecialchars($flight['flight_no']) . "</p>";
        echo "<p><strong>Origin:</strong> " . htmlspecialchars($flight['origin']) . "</p>";
        echo "<p><strong>Destination:</strong> " . htmlspecialchars($flight['destination']) . "</p>";
        echo "<p><strong>Class:</strong> " . htmlspecialchars($flight['class']) . "</p>";
        echo "<p><strong>Fare:</strong> ৳" . htmlspecialchars($flight['fare']) . "</p>";
        echo "<p><strong>Departure:</strong> " . htmlspecialchars($flight['departs']) . "</p>";
        echo "<p><strong>Arrival:</strong> " . htmlspecialchars($flight['arrives']) . "</p>";
        echo "<p><strong>Refundable:</strong> " . htmlspecialchars($flight['refundable']) . "</p>";
        echo "<hr style='margin: 20px 0;'>";
        echo "<p style='text-align:center;'><strong>Thank you for choosing our service!</strong></p>";
        echo "</div>";
    } else {
        echo "<h2 style='text-align:center;'>Flight not found.</h2>";
    }

    $stmt->close();
} else {
    echo "<h2 style='text-align:center;'>Invalid request. No flight selected.</h2>";
}

$conn->close();
?>
