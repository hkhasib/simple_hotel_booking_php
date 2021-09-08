<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){
    $roomtype=$_POST['roomtype'];
    $bedtype = $_POST['bedtype'];
    $bedcount = $_POST['bedcount'];
    $wifi = $_POST['wifi'];
    $pool = $_POST['pool'];
    $bar = $_POST['bar'];
    $parking = $_POST['parking'];
    $spa = $_POST['spa'];
    $gym = $_POST['gym'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn,("Select room_type.*, room_desc.* from room_type right join room_desc on room_type.room_code=room_desc.room_code where room_type.room_code = '$roomtype'")) or die("Failed to Retrive Database");

    $row = mysqli_fetch_assoc($result);
    $result2 = mysqli_query($conn,("Select * from room_type where room_code = '$roomtype'")) or die("Failed to Retrive Database");
    $row2 = mysqli_fetch_assoc($result2);
    $roomname = strtoupper($row2['room_name']);


    if(isset($row['room_code'])&&$row['room_code']==$roomtype){
        echo '<script>swal("Error!", "Details already exist for this room type: '.$roomname.'! Try Different One!", "error");</script>';
    }

    else{

        $data= "Insert into room_desc values('$roomtype','$bedtype','$bedcount','$wifi','$pool','$parking','$bar','$spa','$gym')";
        mysqli_query($conn, $data);

        echo '<script>swal("Done!", "Description for this room type: '.$roomname.' successfully!", "success");</script>';
    }
    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>