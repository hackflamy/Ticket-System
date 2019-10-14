 /*Edited begin ticket*/
	 public function CREATE_TICKET($SID,$PID,$PRO_DESC,$TECHID,$CRO,$SOL_DESC,$Con){
		 $CRO = SANITIZE($CRO);
		 $TECHID = SANITIZE($TECHID);
		 $PID = SANITIZE($PID);
		 $SID = SANITIZE($SID);
		 $PRO_DESC = SANITIZE($PRO_DESC);
		 $SOL_DESC = SANITIZE($SOL_DESC);
		
		 $ticket_no = $this->GENERATE_TICKET_NO($Con);  
		 if(!$this->CONFIRM_DEPENDENCES($ticket_no,$Con)){
			 if($Con->query("Insert into `ticketsystem`.`tbl_ticket` 
		   values('$ticket_no','$SID','$PID','$PRO_DESC','$TECHID', '$CRO'
		   ,'$SOL_DESC','".date("d/m/Y")." ','".date("H:i:s a")."') ")){
			   return "<p class='confirmation_message'> ticket created.</p>";
		   }else{return "<p class='confirmation_message'>ticket not created.</p>";}
		 } echo "not entered into tickets;";
		 
	 }
      /*Edited end ticket*/