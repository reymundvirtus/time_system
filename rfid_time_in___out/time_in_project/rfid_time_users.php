<?php

//if(isset($_GET["temperature"] == true && $_GET["humidity"] == true)) {
   $id_code = $_GET["code"]; // get code value from HTTP GET

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "rfid_time_in_project";

   date_default_timezone_set('Asia/Manila');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
   $d = date("Y-m-d H:i:s");
   $date_time = $d;

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $sql = "INSERT INTO users (id_code,date_time) VALUES ('$id_code','$date_time')";
//    $result = $conn->query("SELECT id FROM tbl_test WHERE code = '$code'");
//    if($result->num_rows == 0) {
//       $sql = "INSERT INTO tbl_test (code,date_time) VALUES ('$code','$date_time')";
//    } else {
//       echo "Already Enrolled";
//    }
   
   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully users -- ";
      echo $date_time;
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }

   $conn->close();
//} else {
//   echo "temperature is not set";
//}
?>