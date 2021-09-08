<?php

require_once '../admin/dbconfig.php';

if(isset($_POST)){

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);


    $result1 = mysqli_query($conn,("Select * from users where username = '$username'")) or die("Failed to Retrive Database");
    $result2 = mysqli_query($conn,("Select * from users_info where phone = '$phone'")) or die("Failed to Retrive Database");

    $row1 = mysqli_fetch_assoc($result1);
    $row2 = mysqli_fetch_assoc($result2);

    if($row1['username']==$username){
        echo '<script>swal("Error!", "This username '.$username.' is already taken! Try Different One!", "error");</script>';
    }
    else if ($row2['phone']==$phone){
        echo '<script>swal("Error!", "This phone number '.$phone.' already exists! Try Different One!", "error");</script>';
    }
    else{

        $data= "Insert into users_info(username, firstname, lastname, email, phone, address) values('$username','$firstname','$lastname','$email','$phone','$address')";
        $data2= "Insert into users(username, password, typecode) values('$username','$password','$usertype')";

        mysqli_query($conn, $data2);
        mysqli_query($conn, $data);
        mysqli_close($conn);
        echo '<script>swal("Done!", "You have successfully created an account:  '.$usertype.'  !", "success");</script>';
    }

}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>