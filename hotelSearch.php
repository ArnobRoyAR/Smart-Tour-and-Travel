
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
    $city = $_POST['city'];

    // Query to fetch hotels in the selected city
    $sql = "SELECT hotelID, hotelName FROM hotels WHERE city = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $city);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Hotels Available in " . htmlspecialchars($city) . "</h2>";
        echo "<ul>";

        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo htmlspecialchars($row['hotelName']);
            echo " <form action='' method='GET' style='display:inline;'>
                        <input type='hidden' name='hotelID' value='" . htmlspecialchars($row['hotelID']) . "'>
                        <button type='submit'>View Hotel Details</button>
                   </form>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>No hotels available in " . htmlspecialchars($city) . "</h2>";
    }

    $stmt->close();
}

// Display hotel details if "View Hotel Details" is clicked
if (isset($_GET['hotelID'])) {
    $hotelID = $_GET['hotelID'];

    // Query to fetch hotel details
    $sql = "SELECT * FROM hotels WHERE hotelID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $hotelID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();
        echo "<h2>Hotel Details</h2>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($hotel['hotelName']) . "</p>";
        echo "<p><strong>City:</strong> " . htmlspecialchars($hotel['city']) . "</p>";
        echo "<p><strong>Locality:</strong> " . htmlspecialchars($hotel['locality']) . "</p>";
        echo "<p><strong>Stars:</strong> " . htmlspecialchars($hotel['stars']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($hotel['hotelDesc']) . "</p>";
        echo "<p><strong>Price:</strong> $" . htmlspecialchars($hotel['price']) . "</p>";
        echo "<p><strong>Rooms Available:</strong> " . htmlspecialchars($hotel['roomsAvailable']) . "</p>";
        echo "<p><strong>Parking:</strong> " . htmlspecialchars($hotel['parking']) . "</p>";
        echo "<p><strong>Restaurant:</strong> " . htmlspecialchars($hotel['restaurant']) . "</p>";
        echo "<form action='bookhotel.php' method='POST'>
                <input type='hidden' name='hotelID' value='" . htmlspecialchars($hotel['hotelID']) . "'>
                <button type='submit'>Book Hotel</button>
              </form>";
    } else {
        echo "<h2>Hotel not found</h2>";
    }

    $stmt->close();
}

$conn->close();
?>
