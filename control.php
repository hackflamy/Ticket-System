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
$Site = new SITE();
$technician = ''; $s = ''; $cpp = '';$re_ticket="";$filterdata="<tbody>";$filtalltick="<tbody>"; $filtopentick="<tbody>";$filtclosedtick="<tbody>";

/* New CODE!!!*/
/* Code.
     this code accurately designate the chosen  user's infor to be edited,and save the alter infor.*/
     /* code for all Ticket !!!*/
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

/* code for open Ticket !!!*/
      if(isset($_REQUEST['searchopenbtn'])){
        foreach($Ticket->FILTER_BY($_REQUEST['searchopen'],$con)as $filterall) {
            $filtopentick.= "<tr> <td>".$filterall[0]."</td>
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
          
        foreach($Ticket->VIEW_OPEN_TICKETS($con) as $tt){ 
		  
            $filtopentick .="<tr>
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
      $filtopentick.="</tbody>";

/* code for closed ticket */
if(isset($_REQUEST['searchclosedbtn'])){
    foreach($Ticket->FILTER_BY($_REQUEST['searchclosed'],$con)as $filterall) {
        $filtclosedtick.= "<tr> <td>".$filterall[0]."</td>
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
      
    foreach($Ticket->VIEW_CLOSED_TICKETS($con) as $tt){ 
      
        $filtclosedtick .="<tr>
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
  $filtclosedtick.="</tbody>";

/* code for dashbord */
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
	      <form method="POST" name="edittickform" action="#updateTicket" class="contact-form">
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
								  
                                <textarea name="tickdesc" id="edittickdesc" placeholder="Ticket Description">'.$Ticket->TICKET_PROBLEM().'</textarea>
                                <textarea name="tickfeed" id="edittickfeed" placeholder="Ticket Feedback">'.$Ticket->TICKET_SOL().'</textarea>
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
    $message= $Site->CREATE_SITE($_REQUEST['minename'],$con);
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
								<input type='submit' class='ticketeditbtn' name='usereditbtn' value='Edit'>
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
								<input type='submit' class='ticketeditbtn' name='ticketeditbtn' value='Edit'>
							</form>
					  </td> 
				 </tr>"; 
}

$re_uers .= "</tbody>";

/* NEW CODE!!! */


?>