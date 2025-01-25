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

    // Query to fetch flights based on the form input
    $sql = "SELECT * FROM flights WHERE origin = ? AND destination = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $origin, $destination); // Only two parameters needed
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Available Flights from " . htmlspecialchars($origin) . " to " . htmlspecialchars($destination) . "</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>
                <th>Flight No</th>
                <th>Operator</th>
                <th>Fare</th>
                <th>Class</th>
                <th>Departs</th>
                <th>Arrives</th>
                <th>Refundable</th>
                <th>Action</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['flight_no']) . "</td>";
            echo "<td>" . htmlspecialchars($row['operator']) . "</td>";
            echo "<td>$" . htmlspecialchars($row['fare']) . "</td>";
            echo "<td>" . htmlspecialchars($row['class']) . "</td>";
            echo "<td>" . htmlspecialchars($row['departs']) . "</td>";
            echo "<td>" . htmlspecialchars($row['arrives']) . "</td>";
            echo "<td>" . htmlspecialchars($row['refundable']) . "</td>";
            echo "<td>
                    <form action='' method='GET'>
                        <input type='hidden' name='flight_no' value='" . htmlspecialchars($row['flight_no']) . "'>
                        <button type='submit'>View Details</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>No flights available from " . htmlspecialchars($origin) . " to " . htmlspecialchars($destination) . ".</h2>";
    }

    $stmt->close();
}

// Display flight details if "View Details" is clicked
if (isset($_GET['flight_no'])) {
    $flight_no = $_GET['flight_no'];

    // Query to fetch flight details
    $sql = "SELECT * FROM flights WHERE flight_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $flight_no); // Only one parameter needed
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $flight = $result->fetch_assoc();
        echo "<h2>Flight Details</h2>";
        echo "<p><strong>Flight No:</strong> " . htmlspecialchars($flight['flight_no']) . "</p>";
        echo "<p><strong>Operator:</strong> " . htmlspecialchars($flight['operator']) . "</p>";
        echo "<p><strong>Origin:</strong> " . htmlspecialchars($flight['origin']) . "</p>";
        echo "<p><strong>Destination:</strong> " . htmlspecialchars($flight['destination']) . "</p>";
        echo "<p><strong>Fare:</strong> ৳" . htmlspecialchars($flight['fare']) . "</p>";
        echo "<p><strong>Class:</strong> " . htmlspecialchars($flight['class']) . "</p>";
        echo "<p><strong>Departs:</strong> " . htmlspecialchars($flight['departs']) . "</p>";
        echo "<p><strong>Arrives:</strong> " . htmlspecialchars($flight['arrives']) . "</p>";
        echo "<p><strong>Refundable:</strong> " . htmlspecialchars($flight['refundable']) . "</p>";
        echo "<form action='flightbookings.php' method='POST'>
                <input type='hidden' name='flight_no' value='" . htmlspecialchars($flight['flight_no']) . "'>
                <button type='submit'>Book Flight</button>
              </form>";
    } else {
        echo "<h2>Flight not found</h2>";
    }

    $stmt->close();
}

$conn->close();
?>
