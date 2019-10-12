<?php 

 Class USERS{ 
      private $Name ; 
	  private $Surname;  
	  private $Role;
	  private $Password;
	  private $ID;
	  private $Initials;
	  
	 /*  constructor For the purpose of creating a User ,and 
	   another for access specific user data.*/
	  public function __construct(){}
	    
	 public function CONFIRM_ID($ID,$Con){
        /*Code. Assigning tickets to user.*/
		$Res = $Con->query("select * from `ticketingsystem`.`cro` 
		     where  cro_id = '$ID' ");
		    
			//True if user exits
			//False if user doesn't exists  
			if($Res->num_rows >= 1){  
			 //echo "<br>User found"; //Also initialize user to his/her initials when available.
		       return true;} else{//echo "<br>User not found";
			   false;}
	 }

	 public function CONFIRM_USER($name,$password,$Con){
		   /* Code. Login page.Verify whether the use is to be allowed access to the system.
		     Allow access when and only if there is a correspondence,between 
			 the name and password were initiated, And also set the initials of the 
			 User.*/
		   
		   $Res = $Con->query("select * from `ticketsystem`.`tbl_user` 
		     where (username = '".$name."' 
			 OR surname = '".$name."') 
			 AND password = '".$password."' ");
		    
			//True if user exits
			//False if user doesn't exists  
			if($Res->num_rows >= 1){  
			 //echo "<br>User found"; //Also initialize user to his/her initials when available.
		       return true;} else{
				   //echo "<br>User not found";
				   false;}
		   
	 }

     public function CREATE_USER($N,$IN,$S,$R,$PS,$Con){
	   
		 $N = Sanitize($N); 
		 $S =  Sanitize($S);
		 $R = Sanitize($R);
		 $PS =  Sanitize($PS);
		 $IN =  Sanitize($IN); 
		 //$ID = substr($S,0,2)."-".rand(0,99999999)."-".substr($N,0,2); 
		 
		   
		 if(!$this->CONFIRM_USER($N,$PS,$Con)){         // Returns True : User exists, Shouldn't add him.
			 $Con->query("Insert into `ticketsystem`.`tbl_user`  
			  values('$N','$IN','$S','$PS','$R')");
			   return " <p class='confirmation_message'>User created</p>";
			}else{ return "<p class='confirmation_message'>User already exist.</p>";} 
	   }  	 

	 public function INITIALIZE_USER($n,$Con){
		 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		  
		  $n = Sanitize($n); 
		   $Res = $Con->query("select * from 
		   `ticketsystem`.`tbl_user` 
		     where username = '$n' 
			 OR surname = '$n'
			 OR initials = '$n' "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->Name = $col[0]; 
				$this->Surname = $col[2]; 
				 $this->Role = $col[4];
				$this->Password = $col[3];
				$this->Initials = $col[1];
				//$this->ID= $col[0]; 
			 }  
	 }  
	 
	 public function NAME(){
		return $this->Name;
	 }
	 
	 public function PASSWORD(){
		return $this->Password ;
	 }
	 
	 public function SURNAME(){
		 return $this->Surname;
	 }
 
     public function IN(){
		 return $this->Initials;
	 } 
 
     public function ROLE(){
		 return $this->Role;
	 } 
 
      public function DELETE_USER($n,$p,$Con){
		 $n = Sanitize($n);
		 $p = Sanitize($p);    
		 
		if($this->CONFIRM_USER($n,$p,$Con)){
			/* Code. should return a deleted user comment/true only
				wen user has' tickets have been deleted and then deleted 
				his/her account in the cro table.*/
		  if( $Con->query("
			 DELETE FROM `ticketsystem`.`tbl_user` 
			 WHERE (username = '$n' or surname = '$n') 
			 and password = '$p';")){ 
			 
			 echo "<br> user acc and tickets DELETED."; }
		}else{echo "user existed to be deleted.";}
	}

      public function VIEW_ALL_USERS($Con){ 
		  $User_arr = array();
		  $Results = $Con->query("select * from `ticketsystem`.`tbl_user`");
		  while ($row = $Results->fetch_row()){ 
			 array_push($User_arr,$row);
		  }
		  return $User_arr;
	  } 

	  public function UPDATE_USER($N,$IN,$S,$R,$PS ,$Prv_name,$Prv_password,$Con){
		 $N = Sanitize($N); 
		 $S =  Sanitize($S);
		 $R = Sanitize($R);
		 $PS =  Sanitize($PS); 
		 $IN =  Sanitize($IN); 
		 $Prv_name = SANITIZE($Prv_name);
		 $Prv_password = SANITIZE($Prv_password);
		 /* Update Tech name. initials*/
		 
		 if($this->CONFIRM_USER($Prv_name,$Prv_password,$Con)){
			$Con->query("UPDATE `ticketsystem`.`tbl_user` 
		    SET username = '$N', 
			initials = '$IN',
			surname = '$S', 
			role = '$R', 
			password = '$PS' 
			WHERE (username = '$Prv_name' 
			 OR surname = '$Prv_name') 
			 AND password = '$PS' ") ;
			 return "<p class='confirmation_message'>Process updated.</p>";
			}else{return "<p class='confirmation_message'>Process failed updated.</p>";}
	 } 

 }

 Class TECHNICIAN{
	 private $name; 
	 private $ID; 
	 /* Add,View,Verify*/
	 
	 public function __construct(){}
	 
	 /*HAVE TO INITIALIZE BEFORE CREATING OR VIEWING */
	 public function INITIALIZE($ID,$Con){ 
	 
	 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		 if($this->CONFIRM_ID($ID,$Con)){
			 $Res = $Con->query("select * from 
			 `ticketsystem`.`tbl_tech` 
		     where tech_id = '$ID'   "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->name = $col[1]; 
				$this->ID = $col[2]; 
			 } 
		 } 
	 }
	  
	 public function CONFIRM_TECH($name,$Con){
		 /* Code. verification of tech through cross referencing the phone and 
		  name.*/
		 $Res = $Con->query("select * from `ticketsystem`.`tbl_tech` 
		     where tech_name = '".$name."' ");
		    
			//True if user exits
			//False if user doesn't exists   
			if($Res->num_rows >= 1){  
			// echo "<br> tech found"; //Also initialize user to his/her initials when available.
		          return true;
			   } else{//echo "<br> tech not found"; 
			      return false;}
		 
	 }
	 
	 public function CREATE_TECH($name,$Con){
		 $name = Sanitize($name);  
		 
		 $ID = $name."-".rand(0,999999); 
		 
		 if(!$this->CONFIRM_TECH($name,$Con)){
			 $Con->query("Insert into `ticketsystem`.`tbl_tech` 
		   values('$ID','$name')"); 
		   return "<p class='confirmation_message'> Technicians created.</p>";
		 }else{return "<p class='confirmation_message'> Technicians already created.</p>";}
		 
	 }
	 
	 public function VIEW_ALL_TECH( $Con){ 
		 $Tech_arr = array();
		  $Results = $Con->query("select * from `ticketsystem`.`tbl_tech`");
		  while ($row = $Results->fetch_row()){
			 array_push($Tech_arr,$row);
		  }
		  
		  return $Tech_arr;
	 }
	 
	 public function UPDATE_TECH($name,$Prv_name,$Con){ 
		 $name = Sanitize($name);   
		 $Prv_name = Sanitize($Prv_name);
		 
		 /* Update Tech name. */
		 if($this->CONFIRM_TECH($name,$Con)){ 
		   echo "u got it good.";
			 if($Con->query("UPDATE `ticketsystem`.`tbl_tech` 
				   SET tech_name = '".$name."'
				   WHERE tech_name = '".$Prv_name."'")){
				   return "Technician Updated.";}
		 }else { echo "Technician wasn't update.";} 
		  
	 }
 
     public function NAME(){
		 return $this->name;
	 }
	 
	 public function ID(){
		 return $this->ID();
	 }
 
 }
 
 Class CHECKPOINT{ 
 
    private $chk_point;
	private $chk_site_id;
	private $chk_desc;
	private $chk_site_name;
	
	 
	 public function __construct(){}
	 
	 public function INITIALIZE($CP,$Con){ 
	  
		 /* Code. Extract check point data ,and set the pointer to
			  to actual data location.*/
			 $Res = $Con->query("select * from 
			  `ticketsystem`.`tbl_cp` 
		     WHERE cp_name = '$CP' "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->chk_point = $col[1];  
			 } 
			 
			 /* Code. Extract only site name that correspondences with
				 site_id to be site for easy of data reference on the front-end.*/
			 
			 $Pres = $Con->query("select site_name from 
			  `ticketingsystem`.`site` 
		     WHERE site_id = '".$this->chk_site_id."' "); 
			 
			 while($row= $Pres->fetch_row()){ 
				 $this->chk_site_name = $row[0];  
			 }  
			 
	 }
	 
	 public function VIEW_ALL_CHECKPOINT($Con){ 
		 $ChkPt_arr = array();
		  $Results = $Con->query("select * from 
		  `ticketsystem`.`tbl_cp`");
		  
		  while ($row = $Results->fetch_row()){
			 array_push($ChkPt_arr,$row);
		  }
		  
		  return $ChkPt_arr;
	 }
	 
	 public function CREATE_CHECKPOINT($chk_name,$Con){
		 $chk_name = Sanitize($chk_name);
		 $ID = $chk_name."-".rand(0,999999);
		 
		 /*Code. Verify whether such site id is available.*/
		  /*Code. Verify whether point specifically for a set site is there.*/ 
			  if(!$this->CONFIRM_CHECKPOINT($chk_name,$Con)){
				  $Con->query("Insert into 
				  `ticketsystem`.`tbl_cp`
			   values('$ID','$chk_name')"); 
			   return "<p class='confirmation_message'>Check point created.</p>";
			  } else {return "<p class='confirmation_message'> Checkpoint not created.</p>";}
			    
	 }
 
     public function UPDATE_CHECKPOINT($chk_name,$prv_name,$Con){  
		 $chk_name = SANITIZE($chk_name);
		 $chk_desc = SANITIZE($chk_desc);
		 $site_id = SANITIZE($site_id);
		 $prv_name = SANITIZE($prv_name);
		 $prv_site_id = SANITIZE($prv_site_id);
		 
		 /* Update CHECKPOINT details. 
		   Code. verify checkpoint with through
		   its name and site where it is' id.*/
		 
		 if($this->CONFIRM_CHECKPOINT($chk_name,$Con)){ 
		    $Con->query("UPDATE `ticket_system`.`checkpoints` 
		       SET point_name = '$chk_name' ,
				    site_id = '$site_id',
					point_desc = '$chk_desc'
			   WHERE point_name = '$chk_name'
			   AND site_id = '$prv_site_id ' ");
			 echo "<br> Point Updated";
		 }else {echo "<br> Point not updated.";}
		  
	 }
     
	  private function CONFIRM_CHECKPOINT($chk_name,$Con){
		   /* Verify whether the use is to be allowed access to the system.
		     Allow access when and only if there is a correspondence,between 
			 the name and password were initiated, And also set the initials of the 
			 User.*/
		    $Res = $Con->query("select * from
			`ticketingsystem`.`point` 
		     where point_name = '$chk_name' ");
		    
			//True if user exits
			//False if user doesn't exists 
			if($Res->num_rows >= 1){  
			 //echo "<br>CHECKPOINT found"; 
		       return true;} else{//echo "<br>CHECKPOINT not found";
			   false;}
		   
	 }
 
      
	  public function CONFIRM_ID($ID,$Con){
		   /* Verify whether the use is to be allowed access to the system.
		     Allow access when and only if there is a correspondence,between 
			 the name and password were initiated, And also set the initials of the 
			 User.*/
		    $Res = $Con->query("select * from
			`ticketingsystem`.`point` 
		     where  point_id = '$ID' ");
		    
			//True if user exits
			//False if user doesn't exists 
			if($Res->num_rows >= 1){  
			 //echo "<br>CHECKPOINT found"; 
		       return true;} else{//echo "<br>CHECKPOINT not found";
			   false;}
		   
	 }
 
 
     public function CHECKPOINT_NAME(){
		 return $this->chk_point;
	 }
    
	public function CHECKPOINT_SITE_ID(){
		 return $this->chk_site_id;
	 }
	 
	 public function CHECKPOINT_SITE_NAME(){ 
		 return $this->chk_site_name;
	 }
	 
     public function CHECKPOINT_DESC(){
		 return $this->chk_desc;
	 }
 }
 
 Class SITE{
	 
	 private $site_name;
	 private $site_manager;
	 private $site_address;
	 
	 public function __construct(){}
	 
	 public function VIEW_ALL_SITE($Con){ 
		  $Site_arr = array();
		  $Results = $Con->query("select * from `ticketsystem`.`tbl_site`");
		  while ($row = $Results->fetch_row()){
			 array_push($Site_arr,$row);
		  }
		  return $Site_arr;
	 }
 
     public function CONFIRM_SITE($Site,$Con){
		/* Code. $Site variable also contains other column names found ,
			within the site table.*/
		$Res = $Con->query("select * from 
		    `ticketsystem`.`tbl_site` 
		     where site_name = '$Site' 
			 OR site_id = '$Site' ");
		    
			//True if user exits
			//False if user doesn't exists 
			if($Res->num_rows >= 1){  
			 //echo "<br> SITE found"; 
		       return true;} else{//echo "<br>SITE not found"; 
			   false;}
		   
	}
 
     public function CREATE_SITE($site_name,$Con){
		 $site_name = Sanitize($site_name);  
		 
		 $ID = $site_name."-".rand(0,999999); 
		 
		 if(!$this->CONFIRM_SITE($site_name,$Con)){
			 $Con->query("Insert into `ticketsystem`.`tbl_site` 
		   values('$ID','$site_name')"); 
		   echo "<br> Site created";
		 }else{echo "<br> SIte already created";}
	 }
	
	public function UPDATE_SITE($site_name,$Prv_name,$Con){
		 $site_name = Sanitize($site_name);  
		 $Prv_name = Sanitize($Prv_name);  
		 
		 /* Update Tech name. */
		 if($this->CONFIRM_SITE($site_name,$Con)){ 
			 if($Con->query("UPDATE `ticketsystem`.`site` 
				   SET site_name = '".$site_name."'  
				   WHERE site_name = '".$Prv_name."'")){
				   return "<p class=''> Site Updated. </p>";}
		 }else { echo "<p class=''> doesn't exist.</p>";}  
	 }
	
	public function INITIALIZE($ID,$Con){ 
	 
	 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		 if($this->CONFIRM_SITE($site_name,$Con)){
			 $Res = $Con->query("select * from 
			  `ticketingsystem`.`tbl_site` 
		     WHERE site_name = '".$site_name."'"); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->site_name = $col[1]; 
				$this->site_manager = $col[2];
				 $this->site_address = $col[3]; 
			 } 
		 } 
	 }
	 
	 public function SITE_NAME(){
	     return $this->site_name;
	 }

	 public function SITE_MANAGER(){
	     return $this->site_manager;
	 }
	 
	 public function SITE_ADDRESS(){
	     return $this->site_address;
	 }
 
 
 }
 
 Class ASSIGN_TECH{ 
	 
	 public function __construct(){}
	 
	 public function GENERATE_TICKET_NO($Con){
		 $Res = $Con->query("select Max(ticket_no) from 
		 `ticketsystem`.`tbl_ticket` 
		 ");
		 $ticket_no ="";
		 while($col = $Res->fetch_row()){
			//ORDER BY `date`,`time` DESC limit 1
			 //echo (int) $col[0];
			 //echo substr($col[0],1,strlen($col[0]));
			 /*Code. should strip the # sign from the variable ,add one then add again the 
			   hash sign.*/
			 //$temp_v = substr($col[0],1,strlen($col[0]));
			 $ticket_no = "#".(string)((int)substr($col[0],1,strlen($col[0])) +1);
			 
		 }  
		 return $ticket_no;
	 }
	 
	 
	 public function VIEW_ALL_TICKETS($Con){
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket`");
		  
		$Tickets_arr = array();
		 while ($row = $Res->fetch_row()){
			 array_push($Tickets_arr,$row);
		  } 
		  return $Tickets_arr;
	 }

	 
 private function CONFIRM_DEPENDENCES($TK,$Con){ 
     $Res = $Con->query("select ticket_no from 
		 `ticketsystem`.`tbl_ticket` 
			WHERE	ticket_no = '$TK' ");  
		
         if($Res->num_rows >= 1){
			 return true;
		 }else {return false;}  
	 } 
	 
	 public function CREATE_TICKET($UID,$TID,$PID,$SID,$PRO_DESC,$SOL_DESC,$Con){
		 $UID = SANITIZE($UID);
		 $TID = SANITIZE($TID);
		 $PID = SANITIZE($PID);
		 $SID = SANITIZE($SID);
		 $PRO_DESC = SANITIZE($PRO_DESC);
		 $SOL_DESC = SANITIZE($SOL_DESC);
		
		 $ticket_no = $this->GENERATE_TICKET_NO($Con);
		 
		// if($this->CONFIRM_DEPENDENCES($UID,$TID,$PID,$Con)){
			 if($Con->query("Insert into `ticketsystem`.`tbl_ticket` 
		   values('$ticket_no','$SID','$PID','$PRO_DESC','$TID','$UID','$SOL_DESC',' ".date("d/m/Y")." ',
		   '".date("H:i:s a")."','open' )") ){
			   return "<p class='lbldanger'> ticket created.</p>";
		   }else{return "<p class='lblsuccess'>ticket not created.</p>";}
		// }
		 
	 }

	 public function UPDATE_TICKET($solution,$site,$Tech,$Point,$PRO_DESC,$Prv_ticket_no,$Con){
		 //$User = SANITIZE($User);
		 $Tech = SANITIZE($Tech);
		 $Point = SANITIZE($Point); 
		 $site = SANITIZE($site); 
		 $PRO_DESC = SANITIZE($PRO_DESC);
		 $Prv_ticket_no = SANITIZE($Prv_ticket_no);  
		 
		 if($this->CONFIRM_DEPENDENCES($Prv_ticket_no,$Con)){
			$Res = $Con->query("UPDATE `tbl_ticket` 
								 SET `solution`= '$solution',
									  `check_point` = '$Point',
									  `technician` = '$Tech', 
									  `problem` = '$PRO_DESC', 
									  `site` = '$site'
									   WHERE `ticket_no` = '$Prv_ticket_no' "); 
 
			  return "<p class='confirmation_message'>Ticket has been updated.</p>";
		 }else{return "<p class='confirmation_message'>Ticket not updated.</p>";}
		 
	   }

	  public function DELETE_TICKET($TK,$Con){
		  $CRO_AS_ID = SANITIZE($CRO_AS_ID); 
		  if($Con->query("DELETE FROM `ticketingsystem`.`assign_tech`
		  WHERE `cro_id` = '$CRO_AS_ID' 
		  OR  `assign_id` = '$CRO_AS_ID'
		  OR `ticket_number` = '$CRO_AS_ID' ")){
			  echo "Deleted row.";
		  }else{echo "Not deleted.";}
	   }
	 
	
	public function FILTER_BY_DATE($First_date,$Sec_date,$Con){
		$First_date = SANITIZE($First_date);
		$Sec_date = SANITIZE($Sec_date);
		 
		
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE date BETWEEN 
			 '$First_date' and '$Sec_date' 
		     ORDER BY date ASC");
		  
		  $Fil_date_arr = array();
			 while ($row = $Res->fetch_row()){
				 array_push($Fil_date_arr,$row);
			  } 
			  return $Fil_date_arr;
	}
 
     public function FILTER_BY_TICKET($T,$Con){
		 $T = SANITIZE($T); 
		  
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE  ticket_no = '$T' ORDER BY date ASC");
		  
		  $T_arr = array();
			 while ($row = $Res->fetch_row()){
				 array_push($T_arr,$row);
			  } 		 
		 return $T_arr;
	 }
 
     public function FILTER_BY_INITIALS($Initials,$Con){
		  $Initials = SANITIZE($Initials); 
		  
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE  `cro` = '$Initials' ORDER BY date ASC");
		  
		  $IN_arr = array();
			 while ($row = $Res->fetch_row()){
				 array_push($IN_arr,$row);
			  }  		 
		 return $IN_arr;
	 }
 
      public function FILTER_BY_TECH($Tech,$Con){
		  $Tech = SANITIZE($Tech); 
		  
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE  `cro` = '$Tech' ORDER BY date ASC");
		  
		  $Tech_arr = array();
			 while ($row = $Res->fetch_row()){
				 array_push($Tech_arr,$row);
			  } 
			  return $Tech_arr; 
	 }
 
    public function FILTER_BY_SITE($Site,$Con){
		  $Site = SANITIZE($Site); 
		  
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE  `site` = '$Site' ORDER BY date ASC");
		  
		  $Site_arr = array();
			 while ($row = $Res->fetch_row()){
				 array_push($Site_arr,$row);
			  } 
			  return $Site_arr; 
	 }
 
    public function FILTER_BY_CP($CP,$Con){
		  $CP = SANITIZE($CP); 
		  
		$Res = $Con->query("select * from 
		  `ticketsystem`.`tbl_ticket` 
		    WHERE  `check_point` = '$CP' ORDER BY date ASC");
		  
		  $check_point = array();
			 while ($row = $Res->fetch_row()){
				 array_push($check_point,$row);
			  } 
			  return $check_point; 
	 }
 
    
 }

 function SANITIZE($V){
		  /* Sanitize variables provide to avoid contamination of 
		   Database.*/
		   
		  $V = trim($V);
		  $V = stripslashes($V);
		  $V = htmlentities($V);
		  $V = nl2br($V);
		 /* $V = mysqli_real_escape_string($V,$con);*/
		  
		  return $V;
	  }


?>