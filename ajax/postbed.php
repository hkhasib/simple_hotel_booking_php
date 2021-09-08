<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $name = strtolower($_POST['name']);
    $typecode = $_POST['typecode'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn,("Select * from beds where bed_code = '$typecode' or bed_name= '$name'")) or die("Failed to Retrive Database");

    $row = mysqli_fetch_assoc($result);


    if(isset($row['bed_code'])&&$row['bed_code']==$typecode){
        echo '<script>swal("Error!", "This bed code '.$typecode.' is already taken! Try Different One!", "error");</script>';
    }
    else if (isset($row['bed_name'])&&$row['bed_name']==$name){
        echo '<script>swal("Error!", "This bed name '.$name.' already exists! Try Different One!", "error");</script>';
    }
    else{

        $data= "Insert into beds values('$typecode','$name')";
        mysqli_query($conn, $data);

        echo '<script>swal("Done!", "You have successfully added a new bed: '.$name.'!", "success");</script>';
    }
    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>