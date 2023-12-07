<?php

function dateDiffInDays($date1, $date2) { 
    
    // Calculating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
  
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
}

$conn = mysqli_connect("localhost", "root", "", "resortnova");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $checkin = $_POST["checkin"];
  $checkout = $_POST["checkout"];
  $adults = intval($_POST["adults"]);
  $children = intval($_POST["children"]);
  $room = $_POST["roomType"];
  $phone = intval($_POST["phone"]);
  $dateDiff = dateDiffInDays($checkout, $checkin);

  $sql = "SELECT Price FROM Rooms WHERE Room='$room'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // Fetch the single value
    $value = $result->fetch_assoc()['Price'];
  }
  $price=$value*$dateDiff;

   $query = "INSERT INTO `booking`(`Name`, `Phone`, `Email`, `Room_Type`, `Check-in`, `Check-out`, `No_of_Nights`, `Adults`, `Children`, `Total Price`)  VALUES('$name', '$phone', '$email', '$room', '$checkin', '$checkout', '$dateDiff', '$adults', '$children', '$price')";
  mysqli_query($conn,$query);

  echo '<script>
        alert("Continue?")
        window.location.href = "order.php";
        </script>';

        $conn->close();
}
?>