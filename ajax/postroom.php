<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $roomnum = strtolower($_POST['roomnum']);
    $roomcode = $_POST['roomcode'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn,("Select * from hotel_rooms where room_no = '$roomnum'")) or die("Failed to Retrive Database");

    $row = mysqli_fetch_assoc($result);


    if(isset($row['room_no'])&&$row['room_no']==$roomnum){
        echo '<script>swal("Error!", "This room '.strtoupper($roomnum).' already exists! Try Different One!", "error");</script>';
    }
    else{

        $data= "Insert into hotel_rooms values('$roomnum','$roomcode')";
        mysqli_query($conn, $data);

        echo '<script>swal("Done!", "You have successfully added a new room: '.strtoupper($roomnum).'!", "success");</script>';
    }
    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>