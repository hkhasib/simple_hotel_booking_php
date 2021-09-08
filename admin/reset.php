<?php
require_once 'dbconfig.php';
session_start();
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$data1= "TRUNCATE TABLE beds";
$data2= "TRUNCATE TABLE book";
$data3= "TRUNCATE TABLE hotel_rooms";
$data4= "TRUNCATE TABLE room_desc";
$data5= "TRUNCATE TABLE room_type";
$data6= "TRUNCATE TABLE users";
$data7= "TRUNCATE TABLE users_info";
$data8= "TRUNCATE TABLE user_type";

$drop1= "Drop TABLE beds";
$drop2= "Drop TABLE book";
$drop3= "Drop TABLE hotel_rooms";
$drop4= "Drop TABLE room_desc";
$drop5= "Drop TABLE room_type";
$drop6= "Drop TABLE users";
$drop7= "Drop TABLE users_info";
$drop8= "Drop TABLE user_type";

mysqli_query($conn, $data1);
mysqli_query($conn, $data2);
mysqli_query($conn, $data3);
mysqli_query($conn, $data4);
mysqli_query($conn, $data5);
mysqli_query($conn, $data6);
mysqli_query($conn, $data7);
mysqli_query($conn, $data8);

mysqli_query($conn, $drop1);
mysqli_query($conn, $drop2);
mysqli_query($conn, $drop3);
mysqli_query($conn, $drop4);
mysqli_query($conn, $drop5);
mysqli_query($conn, $drop6);
mysqli_query($conn, $drop7);
mysqli_query($conn, $drop8);

$dbfile = "dbconfig.php";
unlink($dbfile);
session_destroy();
mysqli_close($conn);
header("Location: ../index.php");

?>
