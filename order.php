<?php
    $conn = mysqli_connect("localhost", "root", "", "resortnova");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT `Name`, `Phone`, `Email`, `Room_Type`, `Check-in`, `Check-out`, `No_of_Nights`, `Adults`, `Children`, `Total Price` FROM `booking` where Booking_id=(select max(Booking_id) from booking)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $name=$row['Name'];
      $phone=$row['Phone'];
      $email=$row['Email'];
      $room=$row['Room_Type'];
      $checkin=$row['Check-in'];
      $checkout=$row['Check-out'];
      $nights=$row['No_of_Nights'];
      $adults=$row['Adults'];
      $children=$row['Children'];
      $price=$row['Total Price'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resort Nova</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .total-price {
            font-size: 24px;
            font-weight: bold;
        }

        .btn-checkout {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="margin-bottom: 20px;">Order Summary</h2>

    <div class="card">
        <div class="card-title text-center text-white">
            <h5>Personal Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-title text-center text-white">
            <h5>Room Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Room Type:</strong> <?php echo $room; ?></p>
            <p><strong>Check-in Date:</strong> <?php echo $checkin ?></p>
            <p><strong>Check-out Date:</strong> <?php echo $checkout ?></p>
            <p><strong>Adults:</strong> <?php echo $adults; ?></p>
            <p><strong>Children:</strong> <?php echo $children; ?></p>
            <p><strong>No of Nights:</strong> <?php echo $nights; ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-title text-center text-white">
            <h5>Total Price</h5>
        </div>
        <div class="card-body">
            <p class="total-price">$<?php echo number_format($price, 2); ?></p>
        </div>
    </div>

    <button class="btn btn-checkout">Proceed to Checkout</button>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>