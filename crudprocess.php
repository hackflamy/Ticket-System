<?php



$_SESSION['message']="";
$host ="localhost";
$user= "root";
$pwd="";
$db="ticketsystem";

$con=mysqli_connect($host,$user,$pwd,$db);

if(isset($_GET['delete']))
{
 $deluser=$_GET['delete'];
    $sqldeluser="DELETE FROM tbl_user WHERE username='$deluser' ";

    if(mysqli_query($con,$sqldeluser)){
        $_SESSION['message']="User was Deleted";
        $_SESSION['msg_type']="danger";
        echo "<script>location.href='Home.php#edituser'</script>";

    }
    else{
        echo mysqli_error($con);
    }
    mysqli_close($con);



}



