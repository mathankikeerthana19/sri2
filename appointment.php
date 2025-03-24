<?php
session_start();
include('db.php'); // Include the database connection

// Get today's date in YYYY-MM-DD format
$today = date('Y-m-d');

// Get form data from the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $specialRequest = $_POST['specialRequest'] ?? null;  // Optional field

    // Check if the time slot is already booked for the given date
    $checkAvailabilityQuery = "SELECT * FROM appointments WHERE date = ? AND time = ?";
    $stmt = $conn->prepare($checkAvailabilityQuery);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Time slot is already booked
        $_SESSION['appointment_error'] = "Sorry, this time slot is already booked. Please select a different time.";
    } else {
        // Time slot is available, insert the appointment into the database
        $insertQuery = "INSERT INTO appointments (name, phone, service, date, time, specialRequest) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssss", $name, $phone, $service, $date, $time, $specialRequest);
        
        if ($stmt->execute()) {
            // Appointment successfully booked
            $_SESSION['appointment_success'] = "Appointment booked successfully for " . $service . " on " . $date . " at " . $time;
        } else {
            // Error while inserting the appointment
            $_SESSION['appointment_error'] = "Error: " . $stmt->error;
        }
    }
    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment - Beauty Parlour Management System</title>
    <style>
        body {
                font-family:  Arial, sans-serif;
                margin: 0;
                padding: 0;
                text-align: center;
                background-image: url("backimage1.jpeg");
                background-repeat: no-repeat;  
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 100%;
            }
            header {
                background-color: #ff69b4;;
                color: white;
                padding: 20px 0;
                text-align: center;
            }
            nav {
                overflow:hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                gap:20px;
                background-color: black;
            }
            nav a {
                color: white;
                padding: 14px 20px;
                text-decoration: none;
                float:left;
                text-align: center;
            }
            nav a:hover {
                background-color: #ddd;
                color: black;
            }

        .appointment-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: auto;
            width: 350px;
            text-align: left;
            margin: auto;
        }

        .appointment-container h2 {
            color: #f78cc1;
        }

        .appointment-container input,
        .appointment-container textarea,
        .appointment-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .appointment-container input[type="submit"] {
            background-color: #f78cc1;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }

        .appointment-container input[type="submit"]:hover {
            background-color: #f56e96;
        }

        /* Success and error message styles */
        .appointment-success {
            color: green;
            font-weight: bold;
            background-color: rgba(0, 255, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: auto;
            max-width: 80%;
            margin-top: 20px; 
            text-align: center;
        }

        .appointment-error {
            color: red;
            font-weight: bold;
            background-color: rgba(255, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: auto;
            max-width: 80%;
            margin-top: 20px;
            text-align: center;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Beauty Parlour Management System</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="service.html">Services</a>
            <a href="appointment.php">Appointment</a>
            <a href="user_status.php">Status</a>
            <a href="feedback.php">Feedback</a>
            <a href="admin.php">Admin</a>
        </nav>
    </header>

    <div class="appointment-container">
        <h2>Book Your Appointment</h2>
        <form method="POST" action="appointment.php">
            <label for="name">Your Name</label><br>
            <input type="text" id="name" name="name" required placeholder="Enter your name"><br>

            <label for="phone">Phone Number</label><br>
            <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number"><br>

            

            <label for="service">Select Service</label><br>
            <select id="service" name="service" required>
                <option value="Bridal Makeup">Bridal Makeup</option>
                <option value="Mehendi">Mehendi</option>
                <option value="Hairstyling">Hairstyling</option>
                <option value="Skin Treatments">Skin Treatments</option>
            </select><br>

            <label for="date">Select Date</label><br>
            <input type="date" id="date" name="date" required min="<?php echo $today; ?>"><br>

            <label for="time">Select Time Slot</label><br>
            <select id="time" name="time" required>
                <option value="10AM-12PM">10 AM - 12 PM</option>
                <option value="1PM-3PM">1 PM - 3 PM</option>
                <option value="4PM-6PM">4 PM - 6 PM</option>
                <option value="7PM-9PM">7 PM - 9 PM</option>
            </select><br>

            <label for="specialRequest">Special Requests (Optional)</label><br>
            <textarea id="specialRequest" name="specialRequest" placeholder="Any special requests regarding your service?"></textarea><br>

            <input type="submit" value="Book Appointment">
        </form>

        <!-- Display success or error message below the form -->
        <?php
        if (isset($_SESSION['appointment_success'])) {
            echo "<div class='appointment-success'>" . $_SESSION['appointment_success'] . "</div>";
            unset($_SESSION['appointment_success']); // Clear the message after showing it
        }
        if (isset($_SESSION['appointment_error'])) {
            echo "<div class='appointment-error'>" . $_SESSION['appointment_error'] . "</div>";
            unset($_SESSION['appointment_error']); // Clear the error message after showing it
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2025 Beauty Parlour. All Rights Reserved.</p>
    </footer>
</body>
</html>
