<?php
  session_start();
  /*CODE SHOULD BE TIDED UP ,FOR DEPLOYMENT ,IT SHOULD BE PROFESSIONAL.*/
  echo "<body style='background-color:darkgray; color:darkblue;'>";
  $HOST="127.0.0.1";
  $USER = "root";
  $PW = "";
  $DB = "ticketingsystem";
  $E_DIR = "E_HANDLING";
  $ERROR_LOG = "BACK_ERROR_FILE.txt";
  $REG_USER = "";
  $AD_TECH = "";
  $AD_SITE = "";
  $AD_CKP = "";
  global $connection_establishment ;
    

  try{ 
    $connection_establishment = new mysqli($HOST,$USER,$PW,$DB);
    if($connection_establishment->connect_error) die($connection_establishment->connect_error);
	
	/*
	 if($_SESSION['CRO_OPERATOR'] == 2){
	//CODE. should be able to add user.
    	
    $REG_USER= ' <div class="modal" id="regcro">
								<div class="modal-content">
									<h2 class="modal-heading">Register CRO</h2>
									<a href="#" class="modal-close">&times;</a>
									<p class="modal-body">
										<h2 class="table-heading">CRO Details</h2>

										<div class="cont-contactbtn">
											<div class="cont-flip">

												<div class="">
													<form action="" class="contact-form">
														<input type="text" class="gutter" placeholder="Initials ">
														<input type="text" class="gutter" placeholder="Last Name">
														<input type="password" class="gutter" placeholder="password">
														<input type="password" class="gutter" placeholder="confirm password">

														<input class="donebtn" type="submit" value="Done">

													</form>
												</div>
											</div>
										</div>
									</p>
								</div>
							</div>';
		//CODE. should be able to add mine. 
		  $AD_SITE = '<div class="modal" id="regmn">
					<div class="modal-content">
						<h2 class="modal-heading">New Mine</h2>
						<a href="#" class="modal-close">&times;</a>
						<p class="modal-body">
							<h2 class="table-heading">Mine Details</h2>

							<div class="cont-contactbtn">
								<div class="cont-flip">

									<div class="">
										<form action="" class="contact-form">
											<input type="text" class="gutter" placeholder="Mina Name">
											<input type="text" class="gutter" placeholder="Abbreviation">

											<input class="donebtn" type="submit" value="Done">

										</form>
									</div>
								</div>
							</div>
						</p>
					</div>
				</div>
			';
			
			//CODE. should be able to add Tech.
		  $AD_TECH = '';
		  
		 //CODE. should be able to add check point.	 
		  $AD_CKP = '<div class="modal" id="regcp">
					<div class="modal-content">
						<h2 class="modal-heading">New Check Point</h2>
						<a href="#" class="modal-close">&times;</a>
						<p class="modal-body">
							<h2 class="table-heading">Check Point Details</h2>

							<div class="cont-contactbtn">
								<div class="cont-flip">

									<div class="">
										<form action="" class="contact-form">
											<input type="text" class="gutter" placeholder="Check Point Name">
											<input type="text" class="gutter" placeholder="Abbreviation">

											<input class="donebtn" type="submit" value="Done">

										</form>
									</div>
								</div>
							</div>
						</p>
					</div>
				</div>  '; 
     }*/
	
	
	}catch(Exception $e){
    R_Log_error:
    if(!file_exit($E_DIR.$ERROR_LOG)){
		if(mkdir($E_DIR,"0776")){
			fopen($E_DIR.$ERROR_LOG,"x+") or die("Couldn't provide a log error file, for  ".$ERROR_LOG);
            goto R_Log_error;
		}else{
		    echo("Couldn't provide a log error file, for  ".$ERROR_LOG);
		}
        
    }else{
        //$LOG_ = fopen($ERROR_LOG,"a");
        fwrite(fopen($ERROR_LOG,"a") , $e.getMessage());
        echo "error logged In";
    }
  }