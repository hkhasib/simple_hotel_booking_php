<?php
$site_address = $_SERVER['SERVER_NAME'];
$filename = 'dbconfig.php';
if (file_exists($filename)){
    echo "Sorry! Database is already configured! If you need help, contact the admin!";
    exit();
}
else if(isset($_POST)){


    $dbhost = $_POST['dbhost'];
    $dbname = $_POST['dbname'];
    $dbuser = $_POST['dbuser'];
    $dbpass = $_POST['dbpass'];

    $dbconfig = fopen("dbconfig.php", "w") or die("Error Found! Please contact web admin!");

    $data = '<?php
$dbhost = "'.$dbhost.'";
$dbuser = "'.$dbuser.'";
$dbpass = "'.$dbpass.'";
$dbname = "'.$dbname.'";

$site_address = "'.$site_address.'";
?>';
    fwrite($dbconfig,$data);
    fclose($dbconfig);
    header("Location: create_central_admin.php");
}
else{
    header("Location: login.php");
}
?>