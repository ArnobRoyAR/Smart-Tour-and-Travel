
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
        .form-group select, 
        .form-group input[type="date"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Hotel Booking</h2>
        <form action="hotelsearch.php" method="POST">
            <!-- City Selection -->
            <div class="form-group">
                <label for="city">Select City</label>
                <select name="city" id="city" required>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Sylhet">Sylhet</option>
                </select>
            </div>
            <!-- Check-in Date -->
            <div class="form-group">
                <label for="checkin">Check-in Date</label>
                <input type="date" name="checkin" id="checkin" required>
            </div>
            <!-- Check-out Date -->
            <div class="form-group">
                <label for="checkout">Check-out Date</label>
                <input type="date" name="checkout" id="checkout" required>
            </div>
            <!-- Number of Rooms -->
            <div class="form-group">
                <label for="rooms">Number of Rooms</label>
                <input type="number" name="rooms" id="rooms" min="1" required>
            </div>
            <!-- Submit Button -->
            <div class="form-group">
                <input type="submit" value="Search Hotel">
            </div>
        </form>
    </div>
</body>
</html>
