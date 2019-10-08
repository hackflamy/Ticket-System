<?php 

  

 Class USERS{ 
      private $Name ; 
	  private $Surname; 
	  private $phone;
	  private $Role;
	  private $Password;
	  private $Email;
	  private $ID;
	 
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
		   
		   $Res = $Con->query("select * from `ticketingsystem`.`cro` 
		     where (name = '".$name."' 
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

     public function CREATE_USER($N,$S,$PH,$R,$PS,$E,$Con){
	   
		 $N = Sanitize($N);
		 $PH =  Sanitize($PH);
		 $S =  Sanitize($S);
		 $R = Sanitize($R);
		 $PS =  Sanitize($PS);
		 $E =  Sanitize($E);
		 $ID = substr($S,0,2)."-".rand(0,99999999)."-".substr($N,0,2); 
		 
		   
		 if(!$this->CONFIRM_USER($N,$PS,$Con)){         // Returns True : User exists, Shouldn't add him.
			 $Con->query("Insert into `ticketingsystem`.`cro`  
			  values('$ID','$N','$S','$PH','$R','$PS','$E')");
			}else{ echo "<br>User already exist.";}
		 
		   echo "<br> User created";
	   }  	 

	 public function INITIALIZE_USER($n,$Con){
		 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		  
		   $Res = $Con->query("select * from 
		   `ticketingsystem`.`cro` 
		     where name = '$n' 
			 OR surname = '$n'
			 OR cro_id = '$n' "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->Name = $col[1]; 
				$this->Surname = $col[2]; 
				$this->phone = $col[3];
				 $this->Role = $col[4];
				$this->Password = $col[5];
				$this->ID= $col[0];
				$this->Email = $col[6];
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
 
	  public function EMAIL(){
		 return $this->Email;
	 }
 
     public function PHONE(){
		 return $this->phone;
	 } 
 
     public function ID(){
		 return $this->ID;
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
		  if($Con->query("			 
			 DELETE FROM `ticketingsystem`.`assign_tech` 
			 where cro_id = (select cro_id from `cro` 
			 where (name = '$n' or surname = '$n') 
			 and password = '$p')") and $Con->query("
			 DELETE FROM `ticketingsystem`.`cro` 
			 WHERE (name = '$n' or surname = '$n') 
			 and password = '$p';")){ 
			 
			 echo "<br> user acc and tickets DELETED."; }
		}else{echo "user existed to be deleted.";}
	}

      public function VIEW_ALL_USERS($Con){ 
		  $User_arr = array();
		  $Results = $Con->query("select * from `ticketingsystem`.`cro`");
		  while ($row = $Results->fetch_row()){ 
			 array_push($User_arr,$row);
		  }
		  return $User_arr;
	  } 

	  public function UPDATE_USER($N,$S,$PH,$R,$PS,$E,$Prv_name,$Prv_password,$Con){
		 $N = Sanitize($N);
		 $PH =  Sanitize($PH);
		 $S =  Sanitize($S);
		 $R = Sanitize($R);
		 $PS =  Sanitize($PS);
		 $E =  Sanitize($E);
		 $Prv_name = SANITIZE($Prv_name);
		 $Prv_password = SANITIZE($Prv_password);
		 /* Update Tech name. */
		 if($Con->query("UPDATE `ticketingsystem`.`cro` 
		    SET name = '$N', 
			surname = '$S',
			phone = '$PH',
			role_id = '$R',
			Email = '$E',
			password = '$PS' 
			WHERE (name = '$Prv_name' 
			 OR surname = '$Prv_name') 
			 AND password = '$PS' ")){
				 
			 echo "Updated USer.";
			}
	 } 

 }

 Class TECHNICIAN{
	 private $name;
	 private $addr;
	 private $phone; 
	 private $assign_site; 
	 /* Add,View,Verify*/
	 
	 public function __construct(){}
	 
	 /*HAVE TO INITIALIZE BEFORE CREATING OR VIEWING */
	 public function INITIALIZE($ID,$Con){ 
	 
	 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		 if($this->CONFIRM_ID($ID,$Con)){
			 $Res = $Con->query("select * from 
			 `ticketingsystem`.`tech` 
		     where tech_id = '$ID'   "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->name = $col[1]; 
				$this->phone = $col[2];
				 $this->addr = $col[3];
				$this->assign_site = $col[4];
			 } 
		 } 
	 }
	 
	 public function CONFIRM_ID($ID,$Con){
        /*Code. Assigning tickets to user.*/
		$Res = $Con->query("select * from `ticketingsystem`.`tech` 
		     where  tech_id = '$ID' ");
		    
			//True if user exits
			//False if user doesn't exists  
			if($Res->num_rows >= 1){  
			 //echo "<br>Tech found"; //Also initialize user to his/her initials when available.
		       return true;} else{//echo "<br>Tech not found"; 
			   false;}
	 }
	 
	 public function CONFIRM_TECH($name,$ph,$Con){
		 /* Code. verification of tech through cross referencing the phone and 
		  name.*/
		 $Res = $Con->query("select * from `ticketingsystem`.`tech` 
		     where tech_name = '".$name."'  
			 AND tech_phone = '".$ph."' ");
		    
			//True if user exits
			//False if user doesn't exists   
			if($Res->num_rows >= 1){  
			// echo "<br> tech found"; //Also initialize user to his/her initials when available.
		       return true;} else{//echo "<br> tech not found"; 
			   false;}
		 
	 }
	 
	 public function CREATE_TECH($name,$ph,$addr,$as_site,$Con){
		 $name = Sanitize($name); 
		 $ph = Sanitize($ph);
		 $addr = Sanitize($addr);
		 $as_site = Sanitize($as_site);
		 
		 $ID = $name."-".rand(0,999999); 
		 
		 if(!$this->CONFIRM_TECH($name,$ph,$Con)){
			 $Con->query("Insert into `ticketingsystem`.`tech` 
		   values('$ID','$name','$ph','$addr','$as_site')"); 
		   echo "<br> Tech created";
		 }else{echo "<br> Tech already created";}
		 
	 }
	 
	 public function VIEW_ALL_TECH( $Con){ 
		 $Tech_arr = array();
		  $Results = $Con->query("select * from `ticketingsystem`.`tech`");
		  while ($row = $Results->fetch_row()){
			 array_push($Tech_arr,$row);
		  }
		  
		  return $Tech_arr;
	 }
	 
	 public function UPDATE_TECH($name,$ph,$addr,$as_site,$Prv_name,$Con){ 
		 $name = Sanitize($name); 
		 $ph = Sanitize($ph);
		 $addr = Sanitize($addr);
		 $as_site = Sanitize($as_site); 
		 $Prv_name = Sanitize($Prv_name);
		 
		 /* Update Tech name. */
		 if($this->CONFIRM_TECH($name,$ph,$Con)){ 
			 if($Con->query("UPDATE `ticketingsystem`.`tech` 
				   SET tech_name = '".$name."' ,
					  tech_phone = '".$ph."' ,
					  tech_address = '".$addr."',
					  assign_site = '".$as_site."'
				   WHERE tech_name = '".$Prv_name."'")){
				   echo "Updated";}
		 }else { echo "doesn't exist";} 
		  
	 }
 
     public function NAME(){
		 return $this->name;
	 }
	 
	 public function PHONE(){
		   return $this->phone;
	 }
	 
	  public function ADDRESS(){
		  return $this->addr;
	  }
	  
	  public function ASSIGN_SITE(){
	     return $this->assign_site;
	 }
 
 }
 
 Class CHECKPOINT{ 
 
    private $chk_point;
	private $chk_site_id;
	private $chk_desc;
	private $chk_site_name;
	
	 
	 public function __construct(){}
	 
	 public function INITIALIZE($ID,$Con){ 
	  
		 /* Code. Extract check point data ,and set the pointer to
			  to actual data location.*/
			 $Res = $Con->query("select * from 
			  `ticketingsystem`.`point` 
		     WHERE point_id = '$ID' "); 
			 
			 while($col = $Res->fetch_row()){ 
				 $this->chk_point = $col[2]; 
				$this->chk_site_id = $col[1];
				 $this->chk_desc = $col[3]; 
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
		  `ticketingsystem`.`point`");
		  
		  while ($row = $Results->fetch_row()){
			 array_push($ChkPt_arr,$row);
		  }
		  
		  return $ChkPt_arr;
	 }
	 
	 public function CREATE_CHECKPOINT($chk_name,$site_id,$chk_desc,$Con){
		 $chk_name = Sanitize($chk_name); 
		 $site_id = Sanitize($site_id);
		 $chk_desc = Sanitize($chk_desc);
		 $Site = new SITE();
		 $ID = $chk_name."-".rand(0,999999);
		 
		 /*Code. Verify whether such site id is available.*/
		 if($Site->CONFIRM_SITE($site_id,$Con)){ 
		 /*Code. Verify whether point specifically for a set site is there.*/ 
			  if(!$this->CONFIRM_CHECKPOINT($chk_name,$site_id,$Con)){
				  $Con->query("Insert into 
				  `ticketingsystem`.`point`
			   values('$ID','$site_id','$chk_name','$chk_desc')"); 
			  } else {echo "<br> Checkpoint not created.";}
			   
		 }else{echo "<br> site id mismatch.";}
	 }
 
     public function UPDATE_CHECKPOINT($chk_name,$site_id,$chk_desc,$prv_name,$prv_site_id,$Con){  
		 $chk_name = SANITIZE($chk_name);
		 $chk_desc = SANITIZE($chk_desc);
		 $site_id = SANITIZE($site_id);
		 $prv_name = SANITIZE($prv_name);
		 $prv_site_id = SANITIZE($prv_site_id);
		 
		 /* Update CHECKPOINT details. 
		   Code. verify checkpoint with through
		   its name and site where it is' id.*/
		 
		 if($this->CONFIRM_CHECKPOINT($chk_name,$site_id,$Con)){ 
		    $Con->query("UPDATE `ticket_system`.`checkpoints` 
		       SET point_name = '$chk_name' ,
				    site_id = '$site_id',
					point_desc = '$chk_desc'
			   WHERE point_name = '$chk_name'
			   AND site_id = '$prv_site_id ' ");
			 echo "<br> Point Updated";
		 }else {echo "<br> Point not updated.";}
		  
	 }
     
	  private function CONFIRM_CHECKPOINT($chk_name,$site_id,$Con){
		   /* Verify whether the use is to be allowed access to the system.
		     Allow access when and only if there is a correspondence,between 
			 the name and password were initiated, And also set the initials of the 
			 User.*/
		    $Res = $Con->query("select * from
			`ticketingsystem`.`point` 
		     where point_name = '$chk_name' 
			 and site_id = '$site_id' ");
		    
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
		  $Results = $Con->query("select * from `ticketingsystem`.`site`");
		  while ($row = $Results->fetch_row()){
			 array_push($Site_arr,$row);
		  }
		  return $Site_arr;
	 }
 
     public function CONFIRM_SITE($Site,$Con){
		/* Code. $Site variable also contains other column names found ,
			within the site table.*/
		$Res = $Con->query("select * from 
		    `ticketingsystem`.`site` 
		     where site_name = '$Site' 
			 OR site_id = '$Site' ");
		    
			//True if user exits
			//False if user doesn't exists 
			if($Res->num_rows >= 1){  
			 //echo "<br> SITE found"; 
		       return true;} else{//echo "<br>SITE not found"; 
			   false;}
		   
	}
 
     public function CREATE_SITE($site_name,$site_manager,$site_address,$Con){
		 $site_name = Sanitize($site_name); 
		 $site_manager = Sanitize($site_manager);
		 $site_address = Sanitize($site_address); 
		 
		 $ID = $site_name."-".rand(0,999999); 
		 
		 if(!$this->CONFIRM_SITE($site_name,$Con)){
			 $Con->query("Insert into `ticketingsystem`.`site` 
		   values('$ID','$site_name','$site_manager','$site_address')"); 
		   echo "<br> Site created";
		 }else{echo "<br> SIte already created";}
	 }
	
	public function UPDATE_SITE($site_name,$site_manager,$site_address,$Prv_name,$Con){
		 $site_name = Sanitize($site_name); 
		 $site_manager = Sanitize($site_manager);
		 $site_address = Sanitize($site_address);  
		 
		 /* Update Tech name. */
		 if($this->CONFIRM_SITE($site_name,$Con)){ 
			 if($Con->query("UPDATE `ticketingsystem`.`site` 
				   SET site_name = '".$site_name."' ,
					  site_manager = '".$site_manager."' ,
					  site_address = '".$site_address."' 
				   WHERE site_name = '".$Prv_name."'")){
				   echo "Updated";}
		 }else { echo "doesn't exist";}  
	 }
	
	public function INITIALIZE($ID,$Con){ 
	 
	 /* used in conjuction with login page. 
		  Code. will verify user then ,if accepted populate other function variables 
		  with correct infor.*/
		 if($this->CONFIRM_SITE($site_name,$Con)){
			 $Res = $Con->query("select * from 
			  `ticketingsystem`.`site` 
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
 
 Class PROBLEM{
	private $problem_desc;
    
   public function __construct(){}
   
   public function INITIALIZE($problem_id,$Con){
	   $Results = $Con->query("select problem from `ticketingsystem`.`problem`
	   WHERE prob_id = '$problem_id' ");
		  while ($row = $Results->fetch_row()){
			 $this->problem_desc = $row[0];
		  }
   }

   public function CONFIRM_ID($ID,$Con){  
		  $Res = $Con->query("select * from `ticketingsystem`.`problem`
		  WHERE prob_id = '$ID' ");
		 
		 if($Res->num_rows >= 1){  
			 //echo "<br>PROBLEM found"; 
		       return true;} else{//echo "<br>PROBLEM not found"; 
			   false;} 
	 }
	 
    public function VIEW_ALL_PROBLEM($Con){ 
		  $Problem_arr = array();
		  $Results = $Con->query("select * from `ticketingsystem`.`problem`");
		  while ($row = $Results->fetch_row()){
			 array_push($Problem_arr,$row);
		  }
		  return $Problem_arr;
	 }
 
    public function CREATE_PROBLEM($problem_desc,$Con){
		 $problem_desc = Sanitize($problem_desc);   
		 /*Code. Generate 5 string characters to be attached to the ID variable.*/
		 $ID = substr(str_shuffle("abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY"),0,5)."-".rand(0,999999); 
		 
		 $Con->query("Insert into `ticketingsystem`.`problem` 
		   values('$ID','$problem_desc')"); 
		   echo "<br> problem logged created"; 
	}

	 public function UPDATE_PROBLEM($problem_id,$problem_desc,$Con){
		 $problem_desc = Sanitize($problem_desc);
		 $problem_id = Sanitize($problem_id);    
		 
		  $Con->query("update `ticketingsystem`.`problem`
			SET problem = '$problem_desc'
			WHERE  prob_id = '$problem_id'; "); 
		   echo "<br> problem ALTERED"; 
	}

	 public function DELETE_PROBLEM($problem_id,$Con){
		 $problem_id = Sanitize($problem_id);    
		 
		  $Con->query("DELETE FROM `ticketingsystem`.`problem` 
			WHERE  prob_id = '$problem_id' "); 
		   echo "<br> problem DELETED."; 
	}

	 public function PROBLEM_DESCRIPTION(){
		 return $this->problem_desc;
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
		  `ticketingsystem`.`assign_tech`");
		  
		$Tickets_arr = array();
		 while ($row = $Res->fetch_row()){
			 array_push($Tickets_arr,$row);
		  } 
		  return $Tickets_arr;
	 }
	 
	 private function CONFIRM_DEPENDENCES($UID,$TID,$PID,$Con){
		 /*point_id, tech_id, prob_id, ticket_number, cro_id*/
		$O_USER = new USERS(); 

		$O_TECH = new TECHNICIAN(); 
		
		$O_point = new CHECKPOINT(); 

		$O_pro = new PROBLEM(); 
		
         if($O_point->CONFIRM_ID($PID,$Con)
			 AND $O_TECH->CONFIRM_ID($TID,$Con) AND $O_USER->CONFIRM_ID($UID,$Con)){
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
		 
		 if($this->CONFIRM_DEPENDENCES($UID,$TID,$PID,$Con)){
			 if($Con->query("Insert into `ticketsystem`.`tbl_ticket` 
		   values('$ticket_no','$SID','$PID',' ".date("d/m/Y")." ',
		   '".date("H:i:s a")."','$assign_id','$PRO_DESC','$ticket_no',
		   '$UID')")){
			   echo "<br> ticket created.";
		   }else{echo "<br> ticket not created";}
		 }
		 
	 }

	 public function UPDATE_TICKET($TK_NO,$UID,$TID,$PID,
	     $PRID,$PRO_DESC,$Prv_no,$Prv_Cro_id,$Con){
		 $UID = SANITIZE($UID);
		 $TID = SANITIZE($TID);
		 $PID = SANITIZE($PID);
		 $PRID = SANITIZE($PRID);
		 $TK_NO = SANITIZE($TK_NO);
		 $PRO_DESC = SANITIZE($PRO_DESC);
		 $Prv_Cro_id = SANITIZE($Prv_Cro_id); 
		 $Prv_no = SANITIZE($Prv_no);
		 
		 if($this->CONFIRM_DEPENDENCES($UID,$TID,$PID,$PRID,$Con)){
			$Res = $Con->query("UPDATE `assign_tech` 
								 SET `prob_id`= '$PRID',
									  `point_id` = '$PID',
									  `tech_id` = '$TID',
									  `dates` = '".date("d/m/Y")."',
									  `times` = '".date("H:i:s a")."', 
									  `prob_desc` = '$PRO_DESC',
									  `ticket_number` = '$TK_NO',
									 `cro_id`= '$UID'
									   WHERE `cro_id` = '$Prv_Cro_id' "); 
             
			 /* update `ticketingsystem`.`assign_tech`
			      	SET 
				  `cro_id`= '$UID'
					 WHERE assign_id = '$Prv_no' 
				 AND cro_id ='$Prv_Cro_id' ");*/
			  echo "Ticket upated.";
		 }
		 
	   }

	  public function DELETE_TICKET($CRO_AS_ID,$Con){
		  $CRO_AS_ID = SANITIZE($CRO_AS_ID); 
		  if($Con->query("DELETE FROM `ticketingsystem`.`assign_tech`
		  WHERE `cro_id` = '$CRO_AS_ID' 
		  OR  `assign_id` = '$CRO_AS_ID'
		  OR `ticket_number` = '$CRO_AS_ID' ")){
			  echo "Deleted row.";
		  }else{echo "Not deleted.";}
	   }
	   
 }
 
 
 function SANITIZE($V){
		  /* Sanitize variables provide to avoid contamination of 
		   Database.*/
		   
		  $V = trim($V);
		  $V = stripslashes($V);
		  $V = htmlentities($V);
		  $V = nl2br($V);
		  $V = mysql_real_escape_string($V);
		  
		  return $V;
	  }


?>