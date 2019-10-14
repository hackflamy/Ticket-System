<?php

session_start();
 if(!isset($_SESSION['uname']))
{
    echo "<script>location.href='login.php'</script>";
}


$host ="localhost";
$user= "root";
$pwd="";
$db="ticketsystem";


$con=mysqli_connect($host,$user,$pwd,$db);
require_once('Assets/OO_Class.php');

require_once('crudprocess.php');

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

/* Instantiate Objects ,NEW CODE!!!*/
$Ticket = new ASSIGN_TECH();
$user=New USERS();
$CP = new CHECKPOINT();
$Tech = new TECHNICIAN();
$S = new SITE();
$technician = ''; $s = ''; $cpp = '';$re_ticket="";$filterdata="<tbody>";$filtalltick="<tbody>";


/* Code.
     this code accurately designate the chosen  user's infor to be edited,and save the alter infor.*/
     
     if(isset($_REQUEST['searchbtn'])){
        foreach($Ticket->FILTER_BY($_REQUEST['searchall'],$con)as $filterall) {
            $filtalltick.= "<tr> <td>".$filterall[0]."</td>
         <td>".$filterall[1]."</td>
         <td>".$filterall[2]."</td>
         <td>".$filterall[3]."</td>
         <td>".$filterall[4]."</td>
         <td>".$filterall[5]."</td>
         <td>".$filterall[6]."</td>
         <td>".$filterall[7]."</td>
         <td>".$filterall[8]."</td><tr>";
                     
        }
      }
      else{
          
        foreach($Ticket->VIEW_ALL_TICKETS($con) as $tt){ 
		  
            $filtalltick .="<tr>
                                <td>".$tt[0]."</td>
                                <td>".$tt[1]."</td>
                                <td>".$tt[2]."</td>
                                <td>".$tt[3]."</td>
                                <td>".$tt[4]."</td>
                                <td>".$tt[5]."</td>
                                <td>".$tt[6]."</td>
                                <td>".$tt[7]."</td>
                                <td>".$tt[8]."</td>
                                
                         </tr>"; 
        }
 
      }
      $filtalltick.="</tbody>";




     if(isset($_REQUEST['searchbydate'])){
       foreach($Ticket->FILTER_BY_DATE($_REQUEST['startdate'],$_REQUEST['enddate'],$con) as $tick_ary) {
        $filterdata.= "<tr> <td>".$tick_ary[0]."</td>
        <td>".$tick_ary[1]."</td>
        <td>".$tick_ary[2]."</td>
        <td>".$tick_ary[3]."</td>
        <td>".$tick_ary[4]."</td>
        <td>".$tick_ary[5]."</td>
        <td>".$tick_ary[6]."</td>
        <td>".$tick_ary[7]."</td>
        <td>".$tick_ary[8]."</td><tr>";
                    
       }
     }
     else{
         
foreach($Ticket->VIEW_ALL_TICKETS($con) as $tt){ 
		  
    $filterdata .="<tr>
	                    <td>".$tt[0]."</td>
						<td>".$tt[1]."</td>
						<td>".$tt[2]."</td>
						<td>".$tt[3]."</td>
						<td>".$tt[4]."</td>
						<td>".$tt[5]."</td>
                        <td>".$tt[6]."</td>
                        <td>".$tt[7]."</td>
                        <td>".$tt[8]."</td>
						
				 </tr>"; 
}
     }
     $filterdata.="</tbody>";
if(isset($_REQUEST['ticketeditbtn'])){
    
   $Ticket->INITIALIZE_TICKET($_REQUEST['ticketedit'],$con);
      
    $edt_t = '  
	      <form method="POST" action="#updateTicket" class="contact-form">
                            <input type="text" class="gutter" 
							  name="ticketno" value="'.$Ticket->TICKET_NO().'" readonly>
                                
							<input type="text" class="gutter" 
							  name="ticketcro" value="'.$Ticket->TICKET_CRO().'" readonly>
                                
                                <select name="sites" class="gutter">
								        <option value="'.$Ticket->TICKET_CHECKPOINT().'">'.$Ticket->TICKET_CHECKPOINT().'</option>
                                        '.$s.'
								 </select>
									  
                                <select name="checkpoints" class="gutter">
                                    <option value="'.$Ticket->TICKET_SITE().'">'.$Ticket->TICKET_SITE().'</option>
                                     '.$cpp.'
								   </select>
								  
                                <select name="tech" class="gutter">
                                    <option value="'.$Ticket->TICKET_TECH().'">'.$Ticket->TICKET_TECH().'</option>
                                    '.$technician.'
                                  </select>
								  
                                <textarea name="tickdesc" id="" placeholder="Ticket Description">'.$Ticket->TICKET_PROBLEM().'</textarea>
                                <textarea name="tickfeed" id="" placeholder="Ticket Feedback">'.$Ticket->TICKET_SOL().'</textarea>
                                <input class="donebtn" name="btnedit_ticket" type="submit" value="Done">
                                <label ><?php echo $message;?></label>

                            </form>';
}

if(isset($_REQUEST["btnedit_ticket"])){
	/*UPDATE_TICKET($solution,$site,$Tech,$Point,$PRO_DESC,
	 $Prv_ticket_no,$Con)*/
	$Ticket->UPDATE_TICKET($_REQUEST['tickfeed'],$_REQUEST['sites'],
	 $_REQUEST['tech'],$_REQUEST['checkpoints'],$_REQUEST['tickdesc'],
	 $_REQUEST['ticketno'],$con); 
}

if(isset($_REQUEST["edit_userbtn"])){
	//UPDATE_USER($N,$IN,$S,$R,$PS ,$Prv_name,$Con)
	$user->UPDATE_USER($_REQUEST["crousername"],$_REQUEST["croinitials"],
	$_REQUEST["crolastname"],$_REQUEST["crorole"] ,
	$_REQUEST["crousername"],$_SESSION["Previous_name"],$con);
	
	
}

$re_ticket .="</tbody>";
/* End Edit users Code*/


/*Begin Get all elements of tickets*/
   foreach($Tech->VIEW_ALL_TECH($con) as $T){
	    $technician .= "<option value='".$T[1]."'>".$T[1]."</option>";
   }
   foreach($S->VIEW_ALL_SITE($con) as $S){
	    $s .= "<option value='".$S[1]."'>".$S[1]."</option>";
   }
   foreach($CP->VIEW_ALL_CHECKPOINT($con) as $Cp){
	    $cpp .= "<option value='".$Cp[1]."'>".$Cp[1]."</option>";
   }
   
/* End all elements fo tickets*/

$message="";$re_uers='';$eadt_user='';
if(isset($_REQUEST['btncreateticket']))               
{              
    $message=$Ticket->CREATE_TICKET($_REQUEST['sites'],$_REQUEST['checkpoints'],$_REQUEST['tickdesc'],$_REQUEST['tech'],$_SESSION['uname'],$_REQUEST['tickfeed'],$con);
}
if(isset($_REQUEST['addminebtn'])){
    $message= $S->CREATE_SITE($_REQUEST['minename'],$con);
}
if(isset($_REQUEST['addcpbtn'])){
    $message= $CP->CREATE_CHECKPOINT($_REQUEST['cpname'],$con);
}


if(isset($_REQUEST['regcrobtn'])){
                                                                             
    $message=$user->CREATE_USER($_REQUEST['crousername'],$_REQUEST['croinitials'],$_REQUEST['crolastname'],'CRO',$_REQUEST['cropwd'],$con);
}

if(isset($_REQUEST['regtechbtn'])){
    $message=$Tech->CREATE_TECH($_REQUEST['techusername'],$con);
}

$re_uers = "<tbody>"; 

/* Begin Edit users Code*/

/* Code. below code is meant to for editing user. 
    this $re_uers variable is meant to hold  all the infor related to a user that would be chosen to 
    and then later on be edited.	*/
foreach($user->VIEW_ALL_USERS($con) as $au){
    $re_uers .="<tr>
	                    <td>". $au[0]."</td>
						<td>".$au[1]."</td>
						<td>".$au[2]."</td>
						<td>".$au[3]."</td>
						<td>".$au[4]."</td>
						<td>
						   <form></form>
							<form action='#edituserdet' method='POST'>
								<input type='hidden' name='useredit' value='".$au[0]."'>
								<input type='submit' name='usereditbtn' value='Edit'>
							</form>
					  </td> 
				 </tr>";
				 $t = $au[0];
}

$re_uers .= "</tbody>";

/* Code.
     this code accurately designate the chosen  user's infor to be edited.*/
if(isset($_REQUEST['usereditbtn'])){
    echo "it did go through==>".$_REQUEST['useredit'];
    $user->INITIALIZE_USER($_REQUEST['useredit'],$con);
	$_SESSION["Previous_name"] = $user->NAME();
    $edt_user = '<form method="POST" action="#edituser" class="contact-form">
       <input type="text" name="crousername" class="gutter" placeholder="username " value="'.$user->NAME().'">
      <input type="text" name="croinitials" class="gutter" placeholder="Initials " value="'.$user->IN().'">
     <input type="text" name="crolastname" class="gutter" placeholder="Last Name" value="'.$user->SURNAME().'">
     <input type="password" name="cropwd"  placeholder="password" value="'.$user->PASSWORD().'"> 
     <select type="password" name="crorole">
	     <option value="CRO">Control room</option>
		 <option value="admin">Admin</option>
	 </select> <br>
     <input class="donebtn" type="submit" name="edit_userbtn" value="Done"> 
	 <label ><?php echo $message;?></label>
     </form>';
}

/* End Edit users Code*/

/* Begin Edit Ticket Code*/
    $re_ticket ="<tbody>";

foreach($Ticket->VIEW_ALL_TICKETS($con) as $tt){ 
		  
    $re_ticket .="<tr>
	                    <td>".$tt[0]."</td>
						<td>".$tt[1]."</td>
						<td>".$tt[2]."</td>
						<td>".$tt[3]."</td>
						<td>".$tt[4]."</td>
						<td>".$tt[5]."</td>
						<td>".$tt[6]."</td>
						<td>
						   <form></form>
							<form action='#updateTicket' method='POST'>
								<input type='hidden' name='ticketedit' value='".$tt[0]."'>
								<input type='submit' name='ticketeditbtn' value='Edit'>
							</form>
					  </td> 
				 </tr>"; 
}

$re_uers .= "</tbody>";

/* NEW CODE!!! */



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

        <!-- sidebar-->
        <div class="area">

            <nav class="main-menu">
                <ul class="">
                    <li>
                        <a href="#Deshboard"><i class="fa fa-home fa-2x"></i>
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

        <!-- Logo-->
        <div class="bghlogo">
            <img class="bghimg" src="https://20crxh33y0ym3k6p902yq4pg-wpengine.netdna-ssl.com/wp-content/uploads/2018/10/favicon.png" alt="Trulli" width="65" height="70">
        </div>
        <!-- logo-->

        <div class="modal" id="Deshboard">
            <div class="modal-content">
                <div class="contentholder">
                    <a href="#" class="modal-close">&times;</a>
                    <p class="modal-body">
                        <h2 class="table-heading">Deshboard</h2>
                        <form method="POST" action="#Deshboard" >
                            <div class="filter">
                                <h2> From: <input type="date" name="startdate" class="dateinput" placeholder="Initials ">&nbsp   
                                    &nbsp     To: <input type="date" name="enddate"lass="dateinput" placeholder="Last Name">
                                    <input class="searchbtn" name="searchbydate" type="submit" value="Search">
                                    <input class="printbtn" type="submit" value="">
                                </h2>
                            </div>
                        </form>         
                        
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
                                <th>Time</th>
                            </tr>
                                <?php echo $filterdata;?>
                        </table>
                    </p>
                </div>
            </div>
        </div>

        <!-- View All Ticket-->
        <form method="POST" action="#view" >
            <div class="modal" id="view">
                <div class="modal-content">
                    <div class="contentholder">
                        <div class="filter">
                            <h2> <input type="textarea" name="searchall" class="ticketinput" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
                            <input class="searchbtn" name="searchbtn" type="submit" value="Search">
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
                            <th>Time</th>
                            </tr>
                            <?php echo $filtalltick;?>
                            
                            </table>
                        </p>
                    </div>
                </div>
            </div>
        </form>
        <!-- View All Ticket ends-->
            
        <!-- Edit User-->
        <form method="POST" action="#" >  
            <div class="modal" id="edituser">
                <div class="modal-content">
                    <a href="#" class="modal-close">&times;</a>
                    <p class="modal-body">
                        <h2 class="table-heading">Manage Users</h2>        
                        <table class="tickets">
                            <tr>
                                <th>username</th>
                                <th>initials</th>
                                <th>surname</th>
                                <th>password</th>
                            </tr>
                            <?php echo $re_uers;?>
                        </table>
                    </p>
                </div>
            </div>
         
                <!-- details showing for the curent user -->
            <div class="modal" id="edituserdet">
                <div class="modal-content"> 
                    <a href="#" class="modal-close">&times;</a>
                    <p class="modal-body">
                        <h2 class="table-heading">New CRO</h2>
                        <label class="lblsuccess">
                            <?php if(isset($_SESSION['message'])){$msg=$_SESSION['message']; echo $msg;$_SESSION['message']=""; } ?>
                        </label> 
                        <div class="cont-contactbtn">
                                <div class="cont-flip">
                                    <div class=""> 
                                        <?php echo $edt_user;  ?>
                                    </div>
                                </div>
                        </div>
                    </p>
                </div>
            </div>
            <!-- details showing for the curent user  Ends-->
        </form>  
        <!-- edit user-->

        <!-- open tecket-->
        <form method="POST" action="#" >
            <div class="modal" id="opentick">
                <div class="modal-content">
                    <div class="contentholder">
                        <div class="filter">
                            <h2> <input type="textarea" name="searchopen" class="ticketinput" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
                            <input class="searchbtn" name="searchopenbtn"type="submit" value="Search">
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
                                        <td><input type='submit' name='closebtn' class='ticketeditbtn' value='Close'> <input type='hidden' name='tickvalue' value='Close'></td> 
                                        </tr>";
                                    }
                                    if(isset($_POST['closebtn'])){
                                        $_SESSION['message']="Ticket canot be closed without a feedback";
                                        echo "<script>location.href='Home.php#modal'</script>";
                                    }
                                ?>
                        </table>
                    </p>
                </div>
                </div>
            </div>
        </form>
        <!-- open ticket ends-->

        <!-- close ticket-->
        <form method="POST" action="#" >
            <div class="modal" id="closetick">
                <div class="modal-content">
                    <div class="contentholder">
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
            </div>
        </form>
        <!-- close tecket ends-->

        <!-- update Ticket-->
        <form method="POST" action="#" >
            <div class="modal" id="modal">
                <div class="modal-content">
                    <div class="contentholder">
                        <a href="#" class="modal-close">&times;</a>
                        <p class="modal-body">
                            <h2 class="table-heading">Available Tickets</h2>
                            <label class="lbldanger"><?php if(isset($_SESSION['message'])){$msg=$_SESSION['message']; echo $msg;$_SESSION['message']=""; } ?></label>

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
                            <?php echo $re_ticket; ?> 
                            </table>
                        </p>
                    </div>
                </div>
            </div>
                    
            <div class="modal" id="updateTicket">
                <div class="modal-content">
                    <div class="contentholder">
                            <a href="#" class="modal-close">&times;</a>
                            <p class="modal-body">
                                <h2 class="table-heading">Alter Tickets</h2>
                                <?php echo $edt_t; ?> 
                                </p>
                    </div>
                </div>
            </div>
        </form>
        <!-- Update Ticket ends-->

        <!-- issue ticket -->

        <div class="modal" id="isuetick">
            <div class="modal-content">
                <a href="#" class="modal-close">&times;</a>
                <p class="modal-body">
                    <h2 class="table-heading">New Ticket</h2>
                    <div class="cont-contactbtn">
                        <div class="cont-flip">
                            <div class="">
                                <form method="POST" action="#isuetick" class="contact-form">
                                    <input type="text" class="gutter" name="ticketno" value="<?php echo $Ticket->GENERATE_TICKET_NO($con); ?>" placeholder="Ticket Number" readonly>
                                    <select name="sites" class="gutter">
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
                                    <select name="tech" class="gutter">
                                        <option value="">Select Technician</option>
                                        <option value="WB IN 1">Tendani</option>
                                        <option value="WB IN 2">Ashley</option>
                                        <option value="EXIT">Charel</option>
                                        <option value="SECONDARY IN">Danova</option>
                                    <textarea name="tickdesc" id="" pattern=".{20,}" placeholder="Ticket Description"></textarea>
                                    <textarea name="tickfeed" id="" placeholder="Ticket Feedback"></textarea>
                                    <input class="donebtn" name="btncreateticket" type="submit" value="Done">
                                    <?php echo $message;?>
                                </form>
                            </div>
                        </div>
                    </div>
                </p>
            </div>
        </div>
        <!-- isue Ticket Ends-->

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
                                    <input type="text" name="crousername" pattern="[a-z0-9._%+-]+@[a-z0-9.-]{2,}$" title="Hint: example@BGH" class="gutter" placeholder="username ">
                                    <input type="text" name="croinitials" pattern=".{1,}" title="One or more characters" class="gutter" placeholder="Initials ">
                                    <input type="text" name="crolastname" pattern=".{4,}" title="One or more characters" class="gutter" placeholder="Last Name">
                                    <input type="password" name="cropwd" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Hint: exampleBGH"  placeholder="password">
                                    <input type="password" name="crocpwd"  placeholder="confirm password">
                                    <input class="donebtn" type="submit" name="regcrobtn" value="Done">
                                    <label ><?php echo $message;?></label>
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
                                <form method="POST" action="#regtech" class="contact-form">
                                    <input type="text" name="techusername"  placeholder="username ">
                                    <input class="donebtn" type="submit" name="regtechbtn" value="Done">
                                    <label ><?php echo $message;?></label>
                                    
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
                                    <input type="text" name="minename" pattern="(?=.*[aA-zZ]).{2,}" title="2 or more characters" class="gutter" placeholder="Mina Name">
                                    <input class="donebtn" name="addminebtn" type="submit" value="Done">
                                    <?php echo $message;?>
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
                                    <input type="text" name="cpname" pattern="(?=.*[aA-zZ]).{2,}" title="2 or more characters" class="gutter" placeholder="Check Point Name">
                                    <input class="donebtn" name="addcpbtn" type="submit" value="Done">
                                    <?php echo $message;?>
                                </form>
                            </div>
                        </div>
                    </div>
                </p>
            </div>
        </div>
    <!-- Add check point Ends-->
        


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