<?php
require_once 'dbconfig.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$create_user_table= "Create table users(username varchar(50) not null primary key, password text not null, typecode int not null, creation_date timestamp default current_timestamp,
update_date timestamp default current_timestamp)";
$create_userinfo_table="Create table users_info(username varchar(50) not null primary key, firstname varchar(50) not null, lastname varchar(50) not null, email varchar(100), phone varchar(15) not null, address text, creation_date timestamp default current_timestamp,
update_date timestamp default current_timestamp)";
$create_usertype_table = "Create table user_type(type_code int not null primary key, type_name varchar(30) not null)";
$create_hotel_room_table = "Create table hotel_rooms(room_no varchar(6) null primary key, room_code int not null)";
$create_hotel_room_type_table = "Create table room_type(room_code int null primary key, room_name varchar(50) not null)";
$create_hotel_room_desc_table = "Create table room_desc(room_code int not null primary key, bed_code int not null, bed_count int not null,
free_wifi enum('y','n') not null, swimming_pool enum('y','n') not null, parking enum('y','n') not null,
bar enum('y','n') not null, spa enum('y','n') not null, gym enum('y','n'))";
$create_bed_table= "Create table beds(bed_code int not null primary key, bed_name varchar(50) not null)";
$create_booking_table ="Create table book(book_id varchar(50) not null primary key, room_id varchar(5) not null, username varchar(50) not null, book_creation_date timestamp DEFAULT CURRENT_TIMESTAMP, from_date timestamp not null DEFAULT CURRENT_TIMESTAMP,
to_date timestamp not null DEFAULT CURRENT_TIMESTAMP, bookedby varchar(100))";
$user_type_data = "Insert into user_type values('1','admin'),('2','staff'),('3','customer'),('4','guest')";

if(isset($_POST)){
    $user = strtolower($_POST['user']);
    $pass = $_POST['pass'];
    $admin_data ="Insert into users(username, password, typecode) values('$user',md5('$pass'),'1')";

    mysqli_query($conn, $create_user_table);
    mysqli_query($conn, $create_userinfo_table);
    mysqli_query($conn, $create_usertype_table);
    mysqli_query($conn, $create_hotel_room_table);
    mysqli_query($conn, $create_hotel_room_type_table);
    mysqli_query($conn, $create_hotel_room_desc_table);
    mysqli_query($conn, $create_bed_table);
    mysqli_query($conn, $create_booking_table);
    mysqli_query($conn, $user_type_data);
    mysqli_query($conn, $admin_data);
    mysqli_query($conn,"ALTER TABLE users
ADD FOREIGN KEY (typecode) REFERENCES user_type(type_code)");
    mysqli_query($conn,"ALTER TABLE users_info
ADD FOREIGN KEY (username) REFERENCES users(username)");
    mysqli_query($conn,"ALTER TABLE room_desc
ADD FOREIGN KEY (room_code) REFERENCES room_type(room_code)");
    mysqli_query($conn,"ALTER TABLE room_desc
ADD FOREIGN KEY (bed_code) REFERENCES beds(bed_code)");
    mysqli_query($conn,"ALTER TABLE hotel_rooms
ADD FOREIGN KEY (room_code) REFERENCES room_type(room_code)");
    mysqli_query($conn,"ALTER TABLE book
ADD FOREIGN KEY (room_id) REFERENCES hotel_rooms(room_no)");
    mysqli_query($conn,"ALTER TABLE book
ADD FOREIGN KEY (username) REFERENCES users(username)");

    mysqli_close($conn);

    header("Location: ../login.php");

}
else{
    header("Location: ../login.php");
}
?>