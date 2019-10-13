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

<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>

    <script src="js/jquery-3.3.1.min.js"></script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form method="POST" action="#" class="login-form">
        <h1>LOGIN</h1>
        <div class="tbox">
            <input type="text" name="username" id="">
            <span data-placeholder="USERNAME"></span>
        </div>

        <div class="tbox">
            <input type="password" name="password" id="">
            <span data-placeholder="PASSWORD"></span>
        </div>
        <input type="submit" class="loginbtn" value="login">
        <div class="bottom-text">
        <p class='lbldanger'>  <?php if(isset($_SESSION['massege'])){ echo  $_SESSION['massege'];$_SESSION['massege']=""; }  ?> </p>
            
            Don't have an account contact admin
        </div>
    </form>

    <script type="text/javascript">
        $(".tbox input").on("focus", function() {
            $(this).addClass("focus");
        });
        $(".tbox input").on("blur", function() {
            if ($(this).val() == "")
                $(this).removeClass("focus")
        });
    </script>
</body>

</html>