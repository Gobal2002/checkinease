<?php
include 'config.php';
session_start();

// Verify user session
$usermail = $_SESSION['usermail'] ?? '';
if(empty($usermail)) {
    header("location: index.php");
    exit;
}

// Fetch booked rooms for the current user
$query = "SELECT * FROM roombook WHERE Email = '$usermail'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Booked Room</title>
    <link rel="stylesheet" href="./css/home.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 30px;
            margin-right: 10px;
        }
        .logo p {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }
        nav ul li {
            margin-right: 20px;
        }
        nav ul li:last-child {
            margin-right: 0;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        nav ul li a:hover {
            color: #ffc107;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="./image/bluebirdlogo.png" alt="logo">
            <p>CHECKINEASE</p>
        </div>
        <ul>
            <li><a href="#firstsection">Home</a></li>
            <li><a href="#secondsection">Rooms</a></li>
            <li><a href="#thirdsection">Facilities</a></li>
            <li><a href="book.php">Your Room</a></li>
            <li><a href="#contactus">Contact us</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Room Type</th>
                <th>Bedding Type</th>
                <th>No of Room</th>
                <th>Meal</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Country']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['RoomType']; ?></td>
                    <td><?php echo $row['Bed']; ?></td>
                    <td><?php echo $row['NoofRoom']; ?></td>
                    <td><?php echo $row['Meal']; ?></td>
                    <td><?php echo $row['cin']; ?></td>
                    <td><?php echo $row['cout']; ?></td>
                    <td><?php echo $row['stat']; ?></td>
                    <td>
                        <a href="update_booking.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="cancel_booking.php?id=<?php echo $row['id']; ?>">Cancel</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
