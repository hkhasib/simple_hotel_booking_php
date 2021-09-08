<?php
$filename = 'dbconfig.php';
if (file_exists($filename)) {
    require_once 'dbconfig.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $result = mysqli_query($conn, ("Select * from users;"));
    if($result!==false){
        if ($row = mysqli_fetch_assoc($result) > 0) {
            header("Location: ../dashboard.php");
            mysqli_close($conn);
        }
        else{
            $x=1;
        }
    }

    session_start();
    if (isset($_SESSION['username'])) {

        header("Location: dashboard.php");
    }
}
else
{
    header("Location: index.php");
}
$title="Create Central Admin!";
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>

<div class="roundbox1 dropshadow1" style="margin: 20px;"><h2>Admin Form</h2></div>

<div class="dropshadow1 roundbox1" style="margin: 50px">
    <form action="../admin/setadmin.php" method="post">

        <input type="text" required placeholder="Central Admin UserName" name="user">

        <input type="password" required placeholder="Central Admin Password" name="pass"><br>


        <button type="submit" class="button1">Create</button>



    </form>
</div>

</body>
<?php include '..\footer.php'?>
