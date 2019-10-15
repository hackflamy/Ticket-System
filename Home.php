<?php
require_once('control.php');
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
        <link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
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
                        <span class="nav-text">Dashboard</span></a>
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
        <!-- welcome-->
        <div class="welcome">
            <h1> Welcome To <br><span class="spn">Burgh Group Holdings</span><br> <h2>Ticket System<h2></h1>
            <div class="tagline">
                <p>This System is used to keep ticket that <br>were issued to technician after ateednding an issue</p>

            </div>
            <div class="down">
             <a href="#Deshboard"><i class="fa fa-chevron-circle-down fa-lg"></i></a>
            </div>
        </div>

        <!-- welcome-->

        <div class="modal" id="Deshboard">
            <div class="modal-content">
                <div class="contentholder">
                    <a href="#" class="modal-close">&times;</a>
                    <p class="modal-body">
                        <h2 class="table-heading">Dashboard</h2>
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
                        <a href="#" class="modal-close">&times;</a>
                        <p class="modal-body">
                            <h2 class="table-heading">All Tickets</h2>
                            <div class="filter">
                                <h2> <input type="textarea" name="searchall" class="ticketinput"  placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
                                <input class="searchbtn" name="searchbtn" type="submit" value="Search">
                                <input class="printbtn" type="submit" value=""> </h2>
                            </div>
                            <table class="tickets">
                            <tr>
                            <th>Ticket Number</th>
                            <th>Site</th>
                            <th>Checkpoint</th>
                            <th>Description</th>
                            <th>Technician</th>
                            <th>issued by</th>
                            <th>Feedback</th>
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
                                <th>Role</th>
                                <th>Action</th>
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
        <form method="POST" action="#opentick" >
            <div class="modal" id="opentick">
                <div class="modal-content">
                    <div class="contentholder">
                        <a href="#" class="modal-close">&times;</a>
                        <p class="modal-body">
                        <h2 class="table-heading">Open Tickets</h2>
                        <div class="filter">
                            <h2> <input type="textarea" name="searchopen" class="ticketinput"  placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
                            <input class="searchbtn" name="searchopenbtn"type="submit" value="Search">
                            <input class="printbtn" type="submit" value=""> </h2>
                        </div>

                        <table class="tickets">
                            <tr>
                            <th>Ticket Number</th>
                            <th>Site</th>
                            <th>Checkpoint</th>
                            <th>Description</th>
                            <th>Technician</th>
                            <th>issued by</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                            </tr>
                            <?php echo $filtopentick;?>
                        </table>
                    </p>
                </div>
                </div>
            </div>
        </form>
        <!-- open ticket ends-->

        <!-- close ticket-->
        <form method="POST" action="#closetick" >
            <div class="modal" id="closetick">
                <div class="modal-content">
                    <div class="contentholder">
                        <a href="#" class="modal-close">&times;</a>
                        <p class="modal-body">
                            <h2 class="table-heading">Closed Tickets</h2>
                            <div class="filter">
                                <h2> <input type="textarea" name="searchclosed" class="ticketinput"  placeholder="Ticket Number, Technician, Site, Check point" >&nbsp   
                                <input class="searchbtn" name="searchclosedbtn" type="submit" value="Search">
                                <input class="printbtn"  type="submit" value=""> </h2>
                            </div>
                            <table class="tickets">
                            <tr>
                            <th>Ticket Number</th>
                            <th>Site</th>
                            <th>Checkpoint</th>
                            <th>Description</th>
                            <th>Technician</th>
                            <th>issued by</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Time</th>
                            </tr>
                            <?php echo $filtclosedtick;?>
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
                            <table class="tickets">
                            <tr>
                            <th>Ticket Number</th>
                            <th>Site</th>
                            <th>Checkpoint</th>
                            <th>Description</th>
                            <th>Technician</th>
                            <th>issued by</th>
                            <th>Feedback</th>
                            <th>Date</th>  
                            <th>Time</th>
                            <th>Action</th> 
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
                                    <input type="text" class="single"name="techusername"  placeholder="username ">
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
                                    <input type="text" class="single"name="minename" pattern="(?=.*[aA-zZ]).{2,}" title="2 or more characters" class="gutter" placeholder="Mina Name">
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
                                    <input type="text" class="single" name="cpname" pattern="(?=.*[aA-zZ]).{2,}" title="2 or more characters" class="gutter" placeholder="Check Point Name">
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