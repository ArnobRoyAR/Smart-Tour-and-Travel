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

// Initialize variables to avoid warnings
$hotelID = "";
$hotel = null;
$bookingID = null;
$bookingDate = date("Y-m-d");
$username = "User123"; // Replace with actual user data from session or database
$bookingConfirmed = false;

// Handle form submission for booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hotelID'])) {
    $hotelID = $_POST['hotelID'];

    // Fetch hotel details based on hotelID
    $sql = "SELECT * FROM hotels WHERE hotelID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $hotelID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();

        // Insert booking into hotelbookings table
        $insertSQL = "INSERT INTO hotelbookings (hotelName, date, username, cancelled) 
                      VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSQL);
        $cancelled = "No"; // Booking not cancelled
        $insertStmt->bind_param("ssss", $hotel['hotelName'], $bookingDate, $username, $cancelled);
        $insertStmt->execute();
        $bookingID = $insertStmt->insert_id; // Get the inserted booking ID

        // Set booking confirmed to true
        $bookingConfirmed = true;
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
    <title>Hotel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            display: flex;
            flex-direction: column;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .confirmation {
            background-color: #e0ffe0;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 100%;
        }
        .receipt {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Complete Your Booking</h2>
        <?php if ($bookingConfirmed): ?>
            <!-- Booking has been confirmed -->
            <div id="confirmationMessage" class="confirmation">
                <h2>Booking Confirmation</h2>
                <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($bookingID); ?></p>
                <p><strong>Hotel Name:</strong> <?php echo htmlspecialchars($hotel['hotelName']); ?></p>
                <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($bookingDate); ?></p>
                <p>Your booking has been confirmed. Thank you!</p>
            </div>
        <?php else: ?>
            <!-- Booking Form -->
            <form id="bookingForm" action="bookhotel.php" method="POST">
                <input type="hidden" name="hotelID" value="<?php echo htmlspecialchars($hotelID); ?>"> <!-- Hidden hotelID -->
                <div class="form-group">
                    <label for="hotelName">Hotel Name</label>
                    <input type="text" id="hotelName" name="hotelName" value="<?php echo htmlspecialchars($hotel['hotelName']); ?>" disabled>
                </div>
            </form>
        <?php endif; ?>

        <!-- Booking Receipt (Initially Hidden) -->
        <!-- <div id="receipt" class="receipt">
            <h2>Receipt</h2>
            <p><strong>Booking ID:</strong> <?php echo isset($bookingID) ? $bookingID : ''; ?></p>
            <p><strong>Hotel Name:</strong> <?php echo isset($hotel['hotelName']) ? htmlspecialchars($hotel['hotelName']) : ''; ?></p>
            <p><strong>Booking Date:</strong> <?php echo isset($bookingDate) ? $bookingDate : ''; ?></p>
            <p>Your booking has been confirmed. Thank you!</p>
        </div> -->
    </div>
</body>
</html>
