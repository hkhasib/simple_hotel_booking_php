<?php

require_once 'dbconfig.php';

session_start();
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$username = mysqli_real_escape_string($conn, strtolower($_POST['user']));
$password = mysqli_real_escape_string($conn, $_POST['pass']);


$crypted_user = md5($username);

if(isset($_SESSION['username'])){
    mysqli_close($conn);
    //echo "<script>location.href='dashboard.php'</script>";
    header("Location: dashboard.php");
}
else{




    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = mysqli_query($conn,("Select * from users where username = '$username' and password = md5('$password')")) or die("Failed to Retrive Database");


    $row = mysqli_fetch_assoc($result);

    if($row['username']==$username && $row['password']==md5($password)){
        $_SESSION['username']=$crypted_user;
        header("Location: ../dashboard.php");
    }
    else
    {

        header("Location: ../login.php?wrong_credentials");

    }
    mysqli_close($conn);
}

?>