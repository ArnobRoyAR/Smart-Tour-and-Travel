<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Search</title>
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
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
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
        <h2>Train Search</h2>
        <form action="trainsearch.php" method="POST">
            <!-- Origin Station -->
            <div class="form-group">
                <label for="origin">Select Origin</label>
                <select name="origin" id="origin" required>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Sylhet">Sylhet</option>
                </select>
            </div>
            <!-- Destination Station -->
            <div class="form-group">
                <label for="destination">Select Destination</label>
                <select name="destination" id="destination" required>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Sylhet">Sylhet</option>
                </select>
            </div>
            <!-- Date of Travel -->
            <div class="form-group">
                <label for="travelDate">Travel Date</label>
                <input type="date" name="travelDate" id="travelDate" required>
            </div>
            <!-- Class Selection -->
            <div class="form-group">
                <label for="class">Select Class</label>
                <select name="class" id="class" required>
                    <option value="1AC">1AC</option>
                    <option value="2AC">2AC</option>
                    <option value="3AC">3AC</option>
                    <option value="SL">Sleeper</option>
                    <option value="ChairCar">Chair Car</option>
                    <option value="ChairCarAC">AC Chair Car</option>
                </select>
            </div>
            <!-- Submit Button -->
            <div class="form-group">
                <input type="submit" value="Search Train">
            </div>
        </form>
    </div>
</body>
</html>
