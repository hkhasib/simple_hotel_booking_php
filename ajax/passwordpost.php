<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];
    $username = $_POST['username'];
    $timestamp = date('Y-m-d H:i:s');


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn,("Select * from users where username = '$username'")) or die("Failed to Retrive Database");
    $row = mysqli_fetch_assoc($result);
    if($newpass!=$confirmpass){
        echo '<script>swal("Error!", "Confirm password doesnt match!", "error");</script>';
    }
    else if(md5($oldpass)!=$row['password']){
        echo '<script>swal("Error!", "Current Password mismatched!", "error");</script>';
    }
    else{
        $data= "Update users set password = md5('$newpass'), update_date='$timestamp' where username = '$username'";
        mysqli_query($conn, $data);

        echo '<script>swal("Done!", "You have successfully updated the password!", "success");</script>';
    }
    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>