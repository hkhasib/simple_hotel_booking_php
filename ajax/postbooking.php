<?php
date_default_timezone_set('UTC');
require_once '../admin/dbconfig.php';
$x = 0;
if(isset($_POST)) {

    $username = strtolower($_POST['username']);
    $roomtype = $_POST['roomtype'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $bookedby = $_POST['bookedby'];
    if($bookedby=="null"||empty($bookedby)){
        $bookedby=="Not Applicable";
    }

    $fromString = strtotime($fromdate . " 12:00:00");
    $toString = strtotime($todate . " 11:59:59");

    $fromTimeStamp = date('Y-m-d h:i:s', $fromString);
    $toTimeStamp = date('Y-m-d h:i:s', $toString);
    $book_id = uniqid();
    $current_date = date('Y-m-d h:i:s', time());

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $getroomcount = mysqli_query($conn, ("Select * from hotel_rooms where room_code='$roomtype'")) or die("Failed to Retrive Database");

    if ($current_date > $fromTimeStamp || $fromTimeStamp > $toTimeStamp) {
        echo '<script>swal("Error!", "Time Problem. Please choose correct date", "error");</script>';
    }
    else if (mysqli_num_rows($getroomcount) > 0) {
        while ($row = mysqli_fetch_assoc($getroomcount)) {
            $roomnum = $row['room_no'];
            $result = mysqli_query($conn, ("Select * from book where to_date>'$fromTimeStamp' and room_id='$roomnum'")) or die("Failed to Retrive Database");
            if(mysqli_num_rows($result) > 0){
                $x = 1;
            }
            else {
                $x=2;
                $data = "Insert into book(book_id, room_id, username, from_date, to_date, bookedby) values('$book_id','$roomnum','$username','$fromTimeStamp', '$toTimeStamp', '$bookedby')";
                if ($db = mysqli_query($conn, $data)) {
                    echo '<script>swal("Done!", "You have successfully booked the room: ' . strtoupper($roomnum) . '!", "success");</script>';
                }
                else {
                    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
                }
                break;
                }
            }
if($x==1){
    echo '<script>swal("Error!", "No Room is Available in your preferred schedule!", "error");</script>';
}


}
    else {
        echo '<script>swal("Error!", "No Room is Available in your preferred schedule!", "error");</script>';
    }


    mysqli_close($conn);
}

else{
    echo '<script>swal("Error!", "Something Went Wrong!", "error");</script>';
}
?>