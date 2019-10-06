<?php

$host ="localhost";
$user= "root";
$pwd="";
$db="ticketsystem";

session_start();
$con=mysqli_connect($host,$user,$pwd,$db);
$uname=$_SESSION['uname'];
if(isset($_SESSION['uname'])){

    $sql="SELECT initials,surname FROM tbl_user WHERE username='".$uname."' LIMIT 1";

    $result = mysqli_query($con,$sql); 
    if(mysqli_num_rows($result)==1){
       while($row=mysqli_fetch_row($result)){
           $init=$row[0];
           $lname=$row[1];
       }
    }
   
}
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
                    <a href="#view"><i class="fa fa-list-alt fa-2x"></i>
                    <span class="nav-text">View Ticket</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#modal"><i class="fa fa-pencil-square-o fa-2x"></i>
                    <span class="nav-text">Update Ticket</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#isuetick"><i class="fa fa-exchange fa-2x"></i>
                    <span class="nav-text">Issue Ticket</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#regcro"><i class="fa fa-plus-square fa-2x"></i>
                    <span class="nav-text">Register CRO</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#"><i class="fa fa-plus-square fa-2x"></i>
                    <span class="nav-text">Register Tech</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#regmn"><i class="fa fa-industry fa-2x"></i>
                    <span class="nav-text">Add Mine</span></a>
                </li>
                <li class="has-subnav">
                    <a href="#regcp"><i class="fa fa-bullseye fa-2x"></i>
                    <span class="nav-text">Add Check Point</span></a>
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

    <div class="dashboard">
    <h2> From: <input type="date" class="dateinput" placeholder="Initials ">&nbsp   
    &nbsp     To: <input type="date" class="dateinput" placeholder="Last Name">
    <input class="searchbtn" type="submit" value="Search"></h2>
    <input class="printbtn" type="submit" value="Search"></h2>

                           
                
        <table class="tickets">
            <tr>
                <th>Ticket Number</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>#8263</td>
                <td>open boomgate</td>
                <td>2019/08/15</td>
            </tr>
            <tr>
                <td>#8264</td>
                <td>paper jam</td>
                <td>2019/08/20</td>
            </tr>
            <tr>
                <td>#8265</td>
                <td>network disconected</td>
                <td>2019/08/26</td>
            </tr>
            <tr>
                <td>#8266</td>
                <td>weight bridge faulty</td>
                <td>2019/08/30</td>
            </tr>
            <tr>
                <td>#8267</td>
                <td>intercom not working </td>
                <td>2019/09/01</td>
            </tr>
            <tr>
                <td>#8268</td>
                <td>pc updating</td>
                <td>2019/08/3</td>
            </tr>
        </table>

    </div>

    <!-- Dashbaord ends-->

    <!-- Dashbaord/View Ticket-->

    <div class="modal" id="view">
        <div class="modal-content">
            <h2 class="modal-heading">Available Tickets</h2>
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading"></h2>

                <table class="tickets">
                    <tr>
                        <th>Ticket Number</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td>#8263</td>
                        <td>open boomgate</td>
                        <td>2019/08/15</td>
                    </tr>
                    <tr>
                        <td>#8264</td>
                        <td>paper jam</td>
                        <td>2019/08/20</td>
                    </tr>
                    <tr>
                        <td>#8265</td>
                        <td>network disconected</td>
                        <td>2019/08/26</td>
                    </tr>
                    <tr>
                        <td>#8266</td>
                        <td>weight bridge faulty</td>
                        <td>2019/08/30</td>
                    </tr>
                    <tr>
                        <td>#8267</td>
                        <td>intercom not working </td>
                        <td>2019/09/01</td>
                    </tr>
                    <tr>
                        <td>#8268</td>
                        <td>pc updating</td>
                        <td>2019/08/3</td>
                    </tr>
                </table>
            </p>
        </div>
    </div>



    <!-- Dashbaord/View Ticket ends-->


    <!-- update Ticket-->
    <div class="modal" id="modal">
        <div class="modal-content">
            <h2 class="modal-heading">Available Tickets</h2>
            <a href="#" class="modal-close">&times;</a>
            <p class="modal-body">
                <h2 class="table-heading"></h2>

                <table class="tickets">
                    <tr>
                        <th>Ticket Number</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>#8263</td>
                        <td>open boomgate</td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
                    <tr>
                        <td>#8264</td>
                        <td>paper jam</td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
                    <tr>
                        <td>#8265</td>
                        <td>network disconected</td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
                    <tr>
                        <td>#8266</td>
                        <td>weight bridge faulty</td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
                    <tr>
                        <td>#8267</td>
                        <td>intercom not working </td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
                    <tr>
                        <td>#8268</td>
                        <td>pc updating</td>
                        <td><input type="submit" class="loginbtn" value="Edit"><input type="submit" class="loginbtn" value="Delete"></td>
                    </tr>
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
                                <input type="text" class="gutter" placeholder="Ticket Number" readonly>
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
                                <textarea name="" id="" placeholder="Comment"></textarea>
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
    </div>



    <!-- Register  CRO Ends-->


    <!-- Add Mine-->



    <div class="modal" id="regmn">
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


    <!-- Add Mine Ends-->
    <!-- Add check point-->



    <div class="modal" id="regcp">
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
    </div>
    </form>

    <!-- Add check point Ends-->
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