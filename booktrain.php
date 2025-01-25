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

// Check if the train number is provided (for train details)
if (isset($_POST['trainNo'])) {
    $trainNo = $_POST['trainNo'];

    // Query to fetch train details
    $sql = "SELECT * FROM trains WHERE trainNo = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    $stmt->bind_param("i", $trainNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $train = $result->fetch_assoc();
    } else {
        echo "<h2>Train not found</h2>";
        exit;
    }

    $stmt->close();
}

// Handle ticket booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book'])) {
    $username = $_POST['username'];
    $date = $_POST['date'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $passengers = $_POST['passengers'];
    $cancelled = "No";  // Default value for booking status

    // Insert booking into the trainbookings table
    $sql = "INSERT INTO trainbookings (username, date, cancelled, origin, destination, passengers) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    $stmt->bind_param("sssssi", $username, $date, $cancelled, $origin, $destination, $passengers);

    if ($stmt->execute()) {
        echo "<h2>Booking Successful!</h2>";
        echo "<p>Your booking details:</p>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
        echo "<p><strong>Train Number:</strong> " . htmlspecialchars($train['trainNo']) . "</p>";
        echo "<p><strong>Train Name:</strong> " . htmlspecialchars($train['trainName']) . "</p>";
        echo "<p><strong>Origin:</strong> " . htmlspecialchars($origin) . "</p>";
        echo "<p><strong>Destination:</strong> " . htmlspecialchars($destination) . "</p>";
        echo "<p><strong>Booking Date:</strong> " . htmlspecialchars($date) . "</p>";
        echo "<p><strong>Passengers:</strong> " . htmlspecialchars($passengers) . "</p>";
        echo "<p><strong>Cancelled:</strong> " . $cancelled . "</p>";
    } else {
        echo "<h2>Error in booking your ticket</h2>";
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Train</title>
    <!-- <link href="css/booktrain.css" rel="stylesheet"> -->
</head>
<body>
    <h2>Passenger Details</h2>
    <form action="" method="POST">
        <input type="hidden" name="origin" value="<?php echo htmlspecialchars($train['origin']); ?>">
        <input type="hidden" name="destination" value="<?php echo htmlspecialchars($train['destination']); ?>">
        <input type="hidden" name="trainNo" value="<?php echo htmlspecialchars($train['trainNo']); ?>">
        
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="date">Booking Date:</label>
        <input type="date" name="date" required><br><br>
        
        <label for="passengers">Number of Passengers:</label>
        <input type="number" name="passengers" min="1" required><br><br>
        
        <button type="submit" name="book">Book Ticket</button>
    </form>
</body>
</html>
