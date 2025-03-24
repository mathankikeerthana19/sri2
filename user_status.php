<?php
include('database.php'); // Database connection

$statusMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST['phone']); // Get phone number

    // Prepare SQL query to fetch the user's appointments
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointments = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $statusMessage = "No appointment found for this phone number.";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Appointment Status</title>
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
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding:50px;
            margin: 100px;
            margin-left: 330px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%;
            min-width: 400px;
        }

        input, button {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #ff69b4;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }

        button:hover {
            background-color: #e55b8b;
        }

        .status {
            margin-top: 20px;
            font-weight: bold;
            color: red;
        }

        /* Centering table */
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            overflow-x: auto;
            
        }

        table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            background-color: white;
            text-align: center;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: white;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Beauty Parlour Management System</h1>
    </header>
    <nav>
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="service.php">Service</a>
        <a href="signup.php">Appointment</a>
        <a href="user_status.php">Status</a>
        <a href="feedback.php">Feedback</a>
        <a href="admin.php">Admin</a>
    </nav>

    <div class="container">
        <h2>Check Your Appointment Status</h2>
        <form method="POST">
            <input type="text" name="phone" placeholder="Enter your phone number" required>
            <button type="submit">Check Status</button>
        </form>

        <?php if (!empty($statusMessage)): ?>
            <p class="status"><?php echo $statusMessage; ?></p>
        <?php endif; ?>

        <?php if (!empty($appointments)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['service']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($appointment['status'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <footer class="footer">
        <p>&copy; 2025 Beauty Parlour. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
