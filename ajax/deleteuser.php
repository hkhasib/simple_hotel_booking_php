<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $username = $_POST['username'];


    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        $data= "Delete from users where username = '$username'";
        $data2="Delete from users_info where username = '$username'";
    $data3= "Delete from book where username = '$username'";
        mysqli_query($conn, $data);
    mysqli_query($conn, $data2);
    mysqli_query($conn, $data3);
    mysqli_close($conn);
        echo '<script>swal("Done!", "You have successfully deleted the user:'.$username.'!", "success");delay();</script>';


}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>