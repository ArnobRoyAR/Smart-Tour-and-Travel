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

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $travelDate = $_POST['travelDate'];

    // Query to fetch trains based on origin, destination, and travel date
    $sql = "SELECT trainNo, trainName, origin, destination, originTime, destinationTime, duration, classes, runsOn 
            FROM trains 
            WHERE origin = ? AND destination = ? AND runsOn LIKE ?";
    $stmt = $conn->prepare($sql);

    // Format the travel date to match the weekday
    $dayOfWeek = date('D', strtotime($travelDate));
    $runsOnPattern = "%$dayOfWeek%";

    $stmt->bind_param("sss", $origin, $destination, $runsOnPattern);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Trains Available from " . htmlspecialchars($origin) . " to " . htmlspecialchars($destination) . "</h2>";
        echo "<ul>";

        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "<strong>Train Name:</strong> " . htmlspecialchars($row['trainName']) . "<br>";
            echo "<strong>Train Number:</strong> " . htmlspecialchars($row['trainNo']) . "<br>";
            echo "<strong>Origin Time:</strong> " . htmlspecialchars($row['originTime']) . "<br>";
            echo "<strong>Destination Time:</strong> " . htmlspecialchars($row['destinationTime']) . "<br>";
            echo "<strong>Duration:</strong> " . htmlspecialchars($row['duration']) . "<br>";
            echo "<strong>Classes:</strong> " . htmlspecialchars($row['classes']) . "<br>";
            echo "<form action='' method='GET' style='display:inline;'>
                    <input type='hidden' name='trainNo' value='" . htmlspecialchars($row['trainNo']) . "'>
                    <button type='submit'>View Train Details</button>
                  </form>";
            echo "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "<h2>No trains available from " . htmlspecialchars($origin) . " to " . htmlspecialchars($destination) . " on " . htmlspecialchars($travelDate) . "</h2>";
    }

    $stmt->close();
}

// Display train details if "View Train Details" is clicked
if (isset($_GET['trainNo'])) {
    $trainNo = $_GET['trainNo'];

    // Query to fetch train details
    $sql = "SELECT * FROM trains WHERE trainNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $trainNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $train = $result->fetch_assoc();
        echo "<h2>Train Details</h2>";
        echo "<p><strong>Train Number:</strong> " . htmlspecialchars($train['trainNo']) . "</p>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($train['trainName']) . "</p>";
        echo "<p><strong>Origin:</strong> " . htmlspecialchars($train['origin']) . "</p>";
        echo "<p><strong>Destination:</strong> " . htmlspecialchars($train['destination']) . "</p>";
        echo "<p><strong>Origin Time:</strong> " . htmlspecialchars($train['originTime']) . "</p>";
        echo "<p><strong>Destination Time:</strong> " . htmlspecialchars($train['destinationTime']) . "</p>";
        echo "<p><strong>Duration:</strong> " . htmlspecialchars($train['duration']) . "</p>";
        echo "<p><strong>Classes:</strong> " . htmlspecialchars($train['classes']) . "</p>";
        echo "<p><strong>Runs On:</strong> " . htmlspecialchars($train['runsOn']) . "</p>";
        echo "<form action='booktrain.php' method='POST'>
                <input type='hidden' name='trainNo' value='" . htmlspecialchars($train['trainNo']) . "'>
                <button type='submit'>Book Train</button>
              </form>";
    } else {
        echo "<h2>Train not found</h2>";
    }

    $stmt->close();
}

$conn->close();
?>
