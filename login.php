<?php
$host ="localhost";
$user= "root";
$pwd="";
$db="ticketsystem";

session_start();
 if(isset($_SESSION['uname']))
{
    echo "<script>location.href='Home.php'</script>";
}
else{


$con=mysqli_connect($host,$user,$pwd,$db);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $pword=$_POST['password'];
    $sql="SELECT * FROM tbl_user WHERE username='".$uname."' AND password='".$pword."' LIMIT 1";

    $result = mysqli_query($con,$sql); 
    if(mysqli_num_rows($result)==1){
        $_SESSION['uname']=$uname;
        echo "<script>location.href='Home.php'</script>";
    }
    else{
       
        $_SESSION['massege'] ="you have enter incorect details";
        echo "<script>location.href='login.php'</script>";
        exit;
    }

}
}
?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="test.css">
</head>

<body>
    <img class="wave" src="img/favicon.png" alt="">

    <div class="container">
        <div class="img">

        </div>
        <div class="login-container">
            <form method="POST" action="#">
                <img class="bigimg" src="img/profile.png" alt="">
                <img class="smimg" src="img/favicon.png" alt="">
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Unsername</h5>
                        <input name="username" class="input" type="text">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input class="input" name="password" type="password">
                    </div>
                </div>
                <a href="#"> <p class='lbldanger'>  <?php if(isset($_SESSION['massege'])){ echo  $_SESSION['massege'];$_SESSION['massege']=""; }  ?> </p></a>
                <input class="btn" type="submit" value="Login">
            </form>
        </div>

    </div>
    
    <script type="text/javascript" src="js/style.js"></script>
</body>

</html>