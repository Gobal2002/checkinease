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

    // Handle form submission for updating booking
    if(isset($_POST['update_booking'])) {
        // Retrieve form data
        $new_data = [
            'Name' => $_POST['Name'],
            'Email' => $_POST['Email'],
            'Country' => $_POST['Country'],
            // Add more fields as needed
        ];

        // Update the booking in the database
        $update_query = "UPDATE roombook SET ";
        foreach($new_data as $key => $value) {
            $update_query .= "$key='$value', ";
        }
        // Remove trailing comma and space
        $update_query = rtrim($update_query, ", ");
        $update_query .= " WHERE id = '$booking_id'";
        $update_result = mysqli_query($conn, $update_query);

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
      <li><a href="#firstsection">Home</a></li>
      <li><a href="#secondsection">Rooms</a></li>
      <li><a href="#thirdsection">Facilites</a></li>
      <li><a href="book.php">Your Room</a></li>
      <li><a href="#contactus">Contact us</a></li>
      <a href="./logout.php"><button class="btn btn-danger">Logout</button></a>
    </ul>
  </nav>
    <title>Edit Booking</title>
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
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Edit Booking</h2>
    <form method="POST">
        <!-- Populate form fields with existing booking details -->
        <input type="text" name="Name" value="<?php echo $booking['Name']; ?>" placeholder="Enter Full Name">
        <input type="email" name="Email" value="<?php echo $booking['Email']; ?>" placeholder="Enter Email">
        <input type="text" name="Country" value="<?php echo $booking['Country']; ?>" placeholder="Enter Country">
        <!-- Add more fields as needed -->
        <button type="submit" name="update_booking">Update Booking</button>
    </form>
</body>
</html>
