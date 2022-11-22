<?php

//if(isset($_GET["temperature"] == true && $_GET["humidity"] == true)) {
   $id_code = $_GET["code"]; // get code value from HTTP GET

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "rfid_time_in_project";

   date_default_timezone_set('Asia/Manila');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
   $d = date("Y-m-d");
   $date_time = $d;

   //? for time out
   $t = date("H:i:s");
   $time_out = $t;


   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
   
   $result = $conn->query("SELECT user_id_code, date_recorded, time_out FROM user_times WHERE user_id_code = '$id_code' AND date_recorded = '$date_time' AND time_out = '00:00:00';");
   if($result->num_rows == 0) {
      echo "Already Offline";
   } else {
      $sql = "UPDATE user_times SET time_out = '$time_out' WHERE user_id_code = '$id_code'";
   }
   
   if ($conn->query($sql) === TRUE) {
      echo "Updated successfully user_times! ";
      echo $date_time;
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }

   $conn->close();
