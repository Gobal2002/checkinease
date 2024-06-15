<?php
include 'config.php';
session_start();

// Verify user session
$usermail = $_SESSION['usermail'] ?? '';
if(empty($usermail)) {
    header("location: index.php");
    exit;
}

// Retrieve booked room information for the logged-in user
$query = "SELECT * FROM roombook WHERE Email = '$usermail'";
$result = mysqli_query($conn, $query);

// Display booked room information
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>CHECKINEASE</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <style>
      #guestdetailpanel{
        display: none;
      }
      #guestdetailpanel .middle{
        height: 450px;
      }
    </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
      <p>CHECKINEASE</p>
    </div>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="#secondsection">Rooms</a></li>
      <li><a href="#thirdsection">Facilites</a></li>
      <li><a href="book.php">Your Room</a></li>
      <li><a href="#contactus">Contact us</a></li>
      <a href="./logout.php"><button class="btn btn-danger">Logout</button></a>
    </ul>
  </nav>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 40px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        td a {
            color: blue;
            text-decoration: none;
            margin-right: 10px;
        }
        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2> Booked Room Details</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>Room Type</th>
            <th>Bed</th>
            <th>No of Room</th>
            <th>Meal</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['Country']."</td>";
            echo "<td>".$row['RoomType']."</td>";
            echo "<td>".$row['Bed']."</td>";
            echo "<td>".$row['NoofRoom']."</td>";
            echo "<td>".$row['Meal']."</td>";
            echo "<td>".$row['cin']."</td>";
            echo "<td>".$row['cout']."</td>";
            echo "<td>".$row['stat']."</td>";
            echo "<td><a href='update_booking.php?id=".$row['id']."'>Edit</a> | <a href='cancel_booking.php?id=".$row['id']."'>Cancel</a></td>";

            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
