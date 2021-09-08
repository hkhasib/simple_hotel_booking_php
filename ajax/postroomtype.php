<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $name = strtolower($_POST['name']);
    $typecode = $_POST['typecode'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn,("Select * from room_type where room_code = '$typecode' or room_name= '$name'")) or die("Failed to Retrive Database");

    $row = mysqli_fetch_assoc($result);


    if(isset($row['room_code'])&&$row['room_code']==$typecode){
        echo '<script>swal("Error!", "This room code '.$typecode.' is already taken! Try Different One!", "error");</script>';
    }
    else if (isset($row['room_name'])&&$row['room_name']==$name){
        echo '<script>swal("Error!", "This room name '.$name.' already exists! Try Different One!", "error");</script>';
    }
    else{

        $data= "Insert into room_type values('$typecode','$name')";
        mysqli_query($conn, $data);

        echo '<script>swal("Done!", "You have successfully added a new room type: '.$name.'!", "success");</script>';
    }
    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>