<?php 

$conn= new mysqli('localhost','root','root','scheduling_db')or die("Could not connect to mysql".mysqli_error($con));

// if (mysqli_connect_error()) {
//     die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
//   }

//   echo 'Connected successfully.';