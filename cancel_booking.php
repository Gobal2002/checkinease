<?php
include 'config.php';
session_start();

// Verify user session
$usermail = $_SESSION['usermail'] ?? '';
if(empty($usermail)) {
    header("location: index.php");
    exit;
}

// Check if booking ID is provided
if(isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    
    // Fetch booking details from the database based on ID
    $query = "SELECT * FROM roombook WHERE id = '$booking_id' AND Email = '$usermail'";
    $result = mysqli_query($conn, $query);
    $booking = mysqli_fetch_assoc($result);

    // Handle cancellation confirmation
    if(isset($_POST['confirm_cancel'])) {
        // Delete the booking from the database
        $delete_query = "DELETE FROM roombook WHERE id = '$booking_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        // Redirect back to booked room details page
        header("location: customer_booked_room.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        p {
            text-align: center;
            margin: 20px 0;
        }
        form {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h2>Cancel Booking</h2>
    <p>Are you sure you want to cancel your booking?</p>
    <form method="POST">
        <button type="submit" name="confirm_cancel">Confirm Cancellation</button>
    </form>
</body>
</html>
