<?php
require_once('Assets/OO_Class.php');
session_start();
 if(!isset($_SESSION['uname']))
{
    echo "<script>location.href='index.php'</script>";
}



$host ="localhost";
$user= "root";
$pwd="";
$db="ticketsystem";


$con=mysqli_connect($host,$user,$pwd,$db);
$uname=$_SESSION['uname'];
if(isset($_SESSION['uname'])){

    $sql="SELECT initials,surname,role FROM tbl_user WHERE username='".$uname."' LIMIT 1";

    $result = mysqli_query($con,$sql); 
    if(mysqli_num_rows($result)==1){
       while($row=mysqli_fetch_row($result)){
           $init=$row[0];
           $lname=$row[1];
           $usrole=$row[2];
       }
    }
           
    
   
}
$Ticket = new ASSIGN_TECH();
?>


<!DOCTYPE html>

<html class="no-js">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    
    <script src="bootstrap/js/bootstrap.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="ussueticket.css">
    <link rel="stylesheet" href="style.css">
    



</head>

<body>
<form method="POST" action="#" >
    <!-- sidebar-->
    <div class="area">

        <nav class="main-menu">
            <ul class="">
                <li>
                    <a href="#"><i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">Deshboard</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#view"><i class="fa fa-ticket fa-2x"></i>
                    <span class="nav-text">All Tickets</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#opentick"><i class="fa fa-circle-o-notch fa-2x"></i>
                    <span class="nav-text">Open Tickets</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#closetick"><i class="fa fa-check fa-2x"></i>
                    <span class="nav-text">Closed Tickets</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#modal"><i class="fa fa-pencil-square-o fa-2x"></i>
                    <span class="nav-text">Update Ticket</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#isuetick"><i class="fa fa-exchange fa-2x"></i>
                    <span class="nav-text">Issue Ticket</span></a>
                </li>
                <li id="regcroli" class="has-subnav">
                    <a href="#regcro"><i class="fa fa-user-plus fa-2x"></i>
                    <span class="nav-text">Register CRO</span></a>
                </li>
                <li id="regtechli" class="has-subnav">
                    <a href="#regtech"><i class="fa fa-plus-square fa-2x"></i>
                    <span class="nav-text">Register Tech</span></a>
                </li>
                <li id="addsiteli" class="has-subnav">
                    <a href="#regmn"><i class="fa fa-industry fa-2x"></i>
                    <span class="nav-text">Add Mine</span></a>
                </li>
                <li id="addcpli" class="has-subnav">
                    <a href="#regcp"><i class="fa fa-bullseye fa-2x"></i>
                    <span class="nav-text">Add Check Point</span></a>
                </li>
                <li id="eduser" class="has-subnav">
                    <a href="#edituser"><i class="fa fa-users fa-2x"></i>
                    <span class="nav-text">User</span></a>
                </li>
            </ul>

            <ul class="logout">
            <li>
                <a href="#"><i class="fa fa-user-o fa-2x"></i> 
                    <span class="nav-text"><?php echo $init." ".$lname;  ?></span></a>
                </li>
                <li>
                
                <a href="logout.php" name="logout"><i class="fa fa-power-off fa-2x"></i> <span class="nav-text">Logout</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- sidebar ends-->

    <!-- Dashbaord -->

    <div class="contentholder">
    <div class="filter">
    <h2> From: <input type="date" class="dateinput" placeholder="Initials ">&nbsp   
    &nbsp     To: <input type="date" class="dateinput" placeholder="Last Name">
    <input class="searchbtn" type="submit" value="Search">
    <input class="printbtn" type="submit" value=""> </h2>
    </div>
                     
                
        <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Site</th>
                <th>Checkpoint</th>
                <th>Problem</th>
                <th>Technician</th>
                <th>issued by</th>
                <th>Sollution</th>
                <th>Date</th>
                
            </tr>
<?php


$sql2="SELECT * FROM tbl_ticket ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $tno=$row2[0];
       $site=$row2[1];
       $cp=$row2[2];
       $prob=$row2[3];
       $tech=$row2[4];
       $cro=$row2[5];
       $solution=$row2[6];
       $date=$row2[7];
       echo "    <tr>
       <td>$tno</td>
       <td>$site</td>
       <td>$cp</td>
       <td>$prob</td>
       <td>$tech</td>
       <td>$cro</td>
       <td>$solution</td>
       <td>$date</td>
       
   </tr>";


   }
      
            ?>
        </table>

    </div>

    <!-- Dashbaord ends-->

    <!-- Dashbaord/View Ticket-->

    <div class="modal" id="view">
        <div class="modal-content">
        <div class="filter">
    <h2> <input type="textarea" class="ticketinput" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
    <input class="searchbtn" type="submit" value="Search">
    <input class="printbtn" type="submit" value=""> </h2>
    </div>
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">All Tickets</h2>

                <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Site</th>
                <th>Checkpoint</th>
                <th>Problem</th>
                <th>Technician</th>
                <th>issued by</th>
                <th>Sollution</th>
                <th>Date</th>
                
            </tr>
<?php


$sql2="SELECT * FROM tbl_ticket ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $tno=$row2[0];
       $site=$row2[1];
       $cp=$row2[2];
       $prob=$row2[3];
       $tech=$row2[4];
       $cro=$row2[5];
       $solution=$row2[6];
       $date=$row2[7];
       echo "    <tr>
       <td>$tno</td>
       <td>$site</td>
       <td>$cp</td>
       <td>$prob</td>
       <td>$tech</td>
       <td>$cro</td>
       <td>$solution</td>
       <td>$date</td>
       
   </tr>";


   }
      
            ?>
        </table>
            </p>
        </div>
    </div>



    <!-- Dashbaord/View Ticket ends-->
         <!-- Edit User-->
         <div class="modal" id="edituser">
    <div class="modal-content">
   
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">Manage Users</h2>
                <h2 class="table-heading"><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}?></h2>
                
                <table class="tickets">
            <tr>
                <th>username</th>
                <th>initials</th>
                <th>surname</th>
                <th>password</th>
                
            
            </tr>
<?php


$sql2="SELECT * FROM tbl_user ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $uname=$row2[0];
       $init=$row2[1];
       $sname=$row2[2];
       $pwd=$row2[3];
       ?>
        <tr>
       <td><?php echo $uname;?></td>
       <td><?php echo $init;?></td>
       <td><?php echo $sname;?></td>
       <td><?php echo $pwd;?></td>
       <td><input type='submit' class='editbtn' value='Edit'>  <a href="crudprocess.php?delete=<?php echo $uname;?>" class="delbtn">Delete</a> </td>
       
   </tr>

   <?php  }?>
  
      
           
        </table>
            </p>
        </div>
    </div>




    <!-- Edit user-->

     <!-- open tecket-->

     <div class="modal" id="opentick">
        <div class="modal-content">
        <div class="filter">
    <h2> <input type="textarea" class="ticketinput" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
    <input class="searchbtn" type="submit" value="Search">
    <input class="printbtn" type="submit" value=""> </h2>
    </div>
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">All Tickets</h2>

                <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Site</th>
                <th>Checkpoint</th>
                <th>Problem</th>
                <th>Technician</th>
                <th>issued by</th>
                <th>Sollution</th>
                <th>Date</th>
                
            </tr>
<?php


$sql2="SELECT * FROM tbl_ticket WHERE accessibility='open' ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $tno=$row2[0];
       $site=$row2[1];
       $cp=$row2[2];
       $prob=$row2[3];
       $tech=$row2[4];
       $cro=$row2[5];
       $solution=$row2[6];
       $date=$row2[7];
       echo "    <tr>
       <td>$tno</td>
       <td>$site</td>
       <td>$cp</td>
       <td>$prob</td>
       <td>$tech</td>
       <td>$cro</td>
       <td>$solution</td>
       <td>$date</td>
       
   </tr>";


   }
      
            ?>
        </table>
            </p>
        </div>
    </div>



    <!-- open ticket ends-->
     <!-- close ticket-->

     <div class="modal" id="closetick">
        <div class="modal-content">
        <div class="filter">
    <h2> <input type="textarea" class="ticketinput" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
    <input class="searchbtn" type="submit" value="Search">
    <input class="printbtn" type="submit" value=""> </h2>
    </div>
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">All Tickets</h2>

                <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Site</th>
                <th>Checkpoint</th>
                <th>Problem</th>
                <th>Technician</th>
                <th>issued by</th>
                <th>Sollution</th>
                <th>Date</th>
                
            </tr>
<?php


$sql2="SELECT * FROM tbl_ticket WHERE accessibility='closed' ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $tno=$row2[0];
       $site=$row2[1];
       $cp=$row2[2];
       $prob=$row2[3];
       $tech=$row2[4];
       $cro=$row2[5];
       $solution=$row2[6];
       $date=$row2[7];
       echo "    <tr>
       <td>$tno</td>
       <td>$site</td>
       <td>$cp</td>
       <td>$prob</td>
       <td>$tech</td>
       <td>$cro</td>
       <td>$solution</td>
       <td>$date</td>
       
   </tr>";


   }
      
            ?>
        </table>
            </p>
        </div>
    </div>



    <!-- close tecket ends-->

    <!-- update Ticket-->
    <div class="modal" id="modal">
    <div class="modal-content">
            
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">Available Tickets</h2>

                <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Site</th>
                <th>Checkpoint</th>
                <th>Problem</th>
                <th>Technician</th>
                <th>issued by</th>
                <th>Sollution</th>
                <th>Date</th>
                
            </tr>
<?php


$sql2="SELECT * FROM tbl_ticket ";
$result2 = mysqli_query($con,$sql2); 

   while($row2=mysqli_fetch_row($result2)){
       $tno=$row2[0];
       $site=$row2[1];
       $cp=$row2[2];
       $prob=$row2[3];
       $tech=$row2[4];
       $cro=$row2[5];
       $solution=$row2[6];
       $date=$row2[7];
       echo "    <tr>
       <td>$tno</td>
       <td>$site</td>
       <td>$cp</td>
       <td>$prob</td>
       <td>$tech</td>
       <td>$cro</td>
       <td>$solution</td>
       <td>$date</td>
       <td><input type='submit' class='ticketeditbtn' value='Edit'></td>
       
   </tr>";


   }
      
            ?>
        </table>
            </p>
        </div>
    </div>




    <!-- Update Ticket ends-->

    <!-- isue a ticket-->

    <div class="modal" id="isuetick">
        <div class="modal-content">

            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">NEW TICKET</h2>
                <div class="cont-contactbtn">
                    <div class="cont-flip">

                        <div class="">
                            <form action="" class="contact-form">
                                <input type="text" class="gutter" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number" readonly>
                                
                                <select name="Site" class="gutter">
                                        <option value="">Select Site</option>
                                        <option value="WB IN 1">Klip25</option>
                                        <option value="WB IN 2">TNDB</option>
                                        <option value="EXIT">Mooifontein</option>
                                        <option value="SECONDARY IN">Inyanda</option>
                                      </select>
                                <select name="checkpoints" class="gutter">
                                    <option value="">Select Checkpoint</option>
                                    <option value="WB IN 1">WB IN 1</option>
                                    <option value="WB IN 2">WB IN 2</option>
                                    <option value="EXIT">EXIT</option>
                                    <option value="SECONDARY IN">SECONDARY IN</option>
                                  </select>
                                <select name="Mine" class="gutter">
                                    <option value="">Select Technician</option>
                                    <option value="WB IN 1">Tendani</option>
                                    <option value="WB IN 2">Ashley</option>
                                    <option value="EXIT">Charel</option>
                                    <option value="SECONDARY IN">Danova</option>
                                  </select>
                                <textarea name="" id="" placeholder="Problem"></textarea>
                                <textarea name="" id="" placeholder="Solution"></textarea>
                                <input class="donebtn" type="submit" value="Done">

                            </form>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>



    <!-- isue a ticket Ends-->

    <!-- Register  CRO-->

    <div class="modal" id="regcro">
        <div class="modal-content">
            
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">New CRO</h2>

                <div class="cont-contactbtn">
                    <div class="cont-flip">

                        <div class="">
                            <form method="POST" action="#regcro" class="contact-form">
                                <input type="text" name="crousername" class="gutter" placeholder="username ">
                                <input type="text" name="croinitials" class="gutter" placeholder="Initials ">
                                <input type="text" name="crolastname" class="gutter" placeholder="Last Name">
                                <input type="password" name="cropwd" class="gutter" placeholder="password">
                                <input type="password" name="crocpwd" class="gutter" placeholder="confirm password">

                                <input class="donebtn" type="submit" name="regcrobtn" value="Done">
                                <?php
                                    if(isset($_POST['regcrobtn']))
                                    {
                                        $crouname=$_POST['crousername'];
                                        $croinit=$_POST['croinitials'];
                                        $crolname=$_POST['crolastname'];
                                        $cropwd=$_POST['cropwd'];
                                        $crorole='CRO';

                                        $sqlregcro="INSERT INTO tbl_user (username,initials,surname,password,role) VALUES('$crouname','$croinit','$crolname','$cropwd','$crorole') ";

                                        if(mysqli_query($con,$sqlregcro)){
                                            echo "USER WAS REGISTERED ";

                                        }
                                        else{
                                            echo mysqli_error($con);
                                        }
                                        mysqli_close($con);
                    


                                    }

                                   

                

                    
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>



    <!-- Register  CRO Ends-->
    <!-- Register  Tech-->

    <div class="modal" id="regtech">
        <div class="modal-content">
            
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">New Technician</h2>

                <div class="cont-contactbtn">
                    <div class="cont-flip">

                        <div class="">
                            <form method="POST" action="#regcro" class="contact-form">
                                <input type="text" name="techusername" class="gutter" placeholder="username ">
                                <input type="text" name="techinitials" class="gutter" placeholder="Initials ">
                                <input type="text" name="techlastname" class="gutter" placeholder="Last Name">
                                <input type="password" name="techpwd" class="gutter" placeholder="password">
                                <input type="password" name="techcpwd" class="gutter" placeholder="confirm password">

                                <input class="donebtn" type="submit" name="regtechbtn" value="Done">
                                <?php
                                    if(isset($_POST['regtechbtn']))
                                    {
                                        $techuname=$_POST['techusername'];
                                        $techinit=$_POST['techinitials'];
                                        $techlname=$_POST['techlastname'];
                                        $techpwd=$_POST['techpwd'];
                                        $techrole='TECH';

                                        $sqlregtech="INSERT INTO tbl_user (username,initials,surname,password,role) VALUES('$techuname','$techinit','$techlname','$techpwd','$techrole') ";

                                        if(mysqli_query($con,$sqlregtech)){
                                            echo "USER WAS REGISTERED ";

                                        }
                                        else{
                                            echo mysqli_error($con);
                                        }
                                        mysqli_close($con);
                    


                                    }

                                   

                

                    
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>



    <!-- Register  Tech Ends-->


    <!-- Add Mine-->



    <div class="modal" id="regmn">
        <div class="modal-content">
           
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">New Mine </h2>

                <div class="cont-contactbtn">
                    <div class="cont-flip">

                        <div class="">
                            <form method="POST" action="#regmn" class="contact-form">
                                <input type="text" name="minename" class="gutter" placeholder="Mina Name">
                                <input type="text" name="mineid" class="gutter" placeholder="Abbreviation">

                                <input class="donebtn" name="addminebtn" type="submit" value="Done">
                                <?php
                                    if(isset($_POST['addminebtn']))
                                    {
                                        $minename=$_POST['minename'];
                                        $mineid=$_POST['mineid'];
                                        

                                        $sqladdmine="INSERT INTO tbl_site (site_id,site_name) VALUES('$minename','$mineid') ";

                                        if(mysqli_query($con,$sqladdmine)){
                                            echo "Mine was added ";

                                        }
                                        else{
                                            echo mysqli_error($con);
                                        }
                                        mysqli_close($con);
                    


                                    }

                                   

                

                    
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>


    <!-- Add Mine Ends-->
    <!-- Add check point-->



    <div class="modal" id="regcp">
        <div class="modal-content">
            
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading">New Check Point </h2>

                <div class="cont-contactbtn">
                    <div class="cont-flip">

                        <div class="">
                            <form method="POST" action="#regcp" class="contact-form">
                                <input type="text" name="cpname" class="gutter" placeholder="Check Point Name">
                                <input type="text" name="cpid" class="gutter" placeholder="Abbreviation">

                                <input class="donebtn" name="addcpbtn" type="submit" value="Done">
                                <?php
                                    if(isset($_POST['addcpbtn']))
                                    {
                                        $cpname=$_POST['cpname'];
                                        $cpid=$_POST['cpid'];
                                        

                                        $sqladdcp="INSERT INTO tbl_cp (cp_id,cp_name) VALUES('$cpname','$cpid') ";

                                        if(mysqli_query($con,$sqladdcp)){
                                            echo "check point was added ";

                                        }
                                        else{
                                            echo mysqli_error($con);
                                        }
                                        mysqli_close($con);
                    


                                    }

                                   

                

                    
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>
<!-- Add check point Ends-->



    </form>

    


    <script type="text/javascript">
        $(".tbox input").on("focus", function() {
            $(this).addClass("focus");
        });
        $(".tbox input").on("blur", function() {
            if ($(this).val() == "")
                $(this).removeClass("focus")
        });

        window.onload = setMenu;
function setMenu() {
    var urole='<?php echo $usrole;?>';
    if(urole=="CRO"){
        var elmnt = document.getElementById("regcroli");
  elmnt.remove();
  var elmnt2 = document.getElementById("regtechli");
  elmnt2.remove();
  var elmnt3 = document.getElementById("addsiteli");
  elmnt3.remove();
  var elmnt4 = document.getElementById("addcpli");
  elmnt4.remove();
  var elmnt4 = document.getElementById("eduser");
  elmnt4.remove();
    }

}

if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
}


    </script>
</body>

</html>