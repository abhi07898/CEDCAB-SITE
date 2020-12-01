<?php
// session_start();
// include 'locationclass.php';
include 'rideclasses.php';

?> 
<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="gui.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <title>Fare Calculatore</title>
  </head>
  <body>
    <script>
        window.total_spent = 0;
        window.total_ride = 0;
      </script>

    <div class="container-fluid">       
            
            <header>
            <!-- data-toggle="slide-collapse" data-target="#navbarCollapse" -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light  sticky">
                    <a class="navbar-brand " href="#" ><span class = "text-warning span-1">Ced</span><span class="span-2 mr-5"><b>Cab</b></span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link btn btn-outline-secondary mr-2" href="">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-outline-secondary mr-2 " href="index.php">BOOK NEW RIDE <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle mr-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Rides
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" id="pending_rides">Pending Rides</a>
                                <a class="dropdown-item" href="#" id = "complete_rides">Complete Rides</a>
                                <a class="dropdown-item" href="#" id = "all_rides">All Rides</a>
                            </div>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle mr-2 " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACCOUNT
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" id="update_info" data-toggle="modal" data-target="#updateinfomodal">Update Information</a>
                                <a class="dropdown-item" href="#" id="change_pass" data-toggle="modal" data-target="#updatepasswordmodal">Change Password</a>
                            </div>
                            </div>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link  btn btn-outline-danger  mr-2" href="user_logout.php">LOG-OUT <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                        <?php 
                        if (!isset($_SESSION['user'])) 
                            {
                                echo '<script>window.location="login.php"</script>';
                                // header('location:login.php');
                                $third_menu = "REVIEWS";
                            } else {
                                $third_menu = $_SESSION['user']['name'];                       
                            }
                        ?>
                             Hello Mr . <?php echo $third_menu; ?>
                            <input  type="hidden" id="sess_not_set" value=" <?php echo $third_menu; ?>">
                        </li>
                           
                        </ul>                    
                    </div>
                </nav>
            </header>
        </div>
            <?php
                    if(isset($_SESSION['cart'])){
                        $from = $_SESSION['cart']['pickup'];
                        $to = $_SESSION['cart']['destination'];
                        $total_distance = $_SESSION['cart']['calculated_distance'];
                        $luggage = $_SESSION['cart']['luggage'];
                        $total_fare = $_SESSION['cart']['ftotal_amount'];
                        $cust_id = $_SESSION['user']['id'];
                        $obj = new rideclasses();
                        $data = $obj->insert_ride($from,$to,$total_distance, $luggage, $total_fare, $cust_id); 
                        if($data == "Inserted") {
                          unset($_SESSION['cart']);  
                        }                      
                    }
                    
                    
                    ?>     
<section>       
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-12 mb-5 pb-3 pt-3">
        
    </div>
    <div class="col-lg-10 col-md-10 col-sm-12 mb-5 pb-3 pt-3">
    <div id="showdashboard">
<section>
  <div class="container mt-5">
    <div class="row">
    <div class="col">
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Amount of Pending Ride:</div>
        <div class="card-body">
          <h5 class="card-title text-center text-light" id="Pending_ride_amount">Rs.</h5>
          <p class="card-text"></p>
         
          <div class="card-footer">
           Use ride menu for more info.
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Amount of Complete Ride :<div id="comp_ride"></div></div>
          <div class="card-body">
            <h5 class="card-title text-center text-light"id="Complete_ride_amount"></h5>
            <p class="card-text"></p>
            <div class="card-footer">
           Use ride menu for more info.
          </div>
          </div>
        </div>       
      </div>
      <div class="col">
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Amount of All Ride</div>
          <div class="card-body">
            <h5 class="card-title text-center text-light"id="All_ride_amount"></h5>
            <p class="card-text"></p>
            <div class="card-footer">
           Use ride menu for more info.
          </div>

          </div>
        </div>       
      </div>
    </div>    
  </div>
</scetion>  
<section>
  <div class="container">
    <div class="row">
    <div class="col">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Pending Ride <div id='calculate_pending'><script></script></div></div>
        <div class="card-body">
          <h5 class="card-title text-center text-light" id="Pending_ride"></h5>
          <p class="card-text"></p>
          <div class="card-footer">
           Use ride menu for more info.
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Complete Ride </div>
          <div class="card-body">
            <h5 class="card-title text-center text-light" id="Complete_ride"> </h5>
            <p class="card-text"></p>
            <div class="card-footer">
             Use ride menu for more info.
            </div>
          </div>
        </div>       
      </div>
      <div class="col">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Total Ride</div>
          <div class="card-body">
            <h5 class="card-title text-center text-light" id="All_ride"></h5>
            <p class="card-text"></p>
            <div class="card-footer">
             Use ride menu for more info.
            </div>
          </div>
        </div>       
      </div>
    </div>    
  </div>
</scetion>  
</div>
<!-- div for pending rides -->
<div id="pending_rides_div">
  <div class="w-100 pt-2 pb-3  bg-dark text-light mt-2 text-center ">
    List of all the PENDING REQUEST <select class="btn btn-outline-warning" id="pend_ride_sort">
  <option selected>Select for Sort Table </option>
  <option value="total_distance">Distance</option>
  <option value="toatl_fare">Fare</option>
  <option value="ride_date">Date</option>
</select></div>
  <table id="main" border="0" cellspacing="0" class="w-100">
    <tr>
      <td id="pending_table-data">
      </td>
    </tr>
  </table>


</div>
<!-- closing div for pending rides  -->
<!-- div for complete rides -->
<div id="complete_rides_div" class="mt-2">
  <button id='spent' class = 'btn-outline-danger  pt-1 pl-5 pr-5 pb-1'>Total-Spent_Amount</button>
  <div class="w-100 pt-2 pb-3  bg-dark text-light mt-2 text-center ">List of all the Completed REQUEST
  <select class="btn btn-outline-warning" id="comp_ride_sort">
  <option selected>Select for Sort Table </option>
  <option value="total_distance">Distance</option>
  <option value="toatl_fare">Fare</option>
  <option value="ride_date">Date</option>
</select></div>
  <table id="main" border="0" cellspacing="0" class="w-100">
    <tr>
      <td id="complete_table-data">
      </td>
    </tr>
  </table>


</div>
<!-- closing div for complete rides  -->
<!-- div for all rides -->
<div id="all_rides_div">
  <div class="w-100 pt-2 pb-3  bg-dark text-light mt-2 text-center ">List of all Ride REQUEST
  <div class="dropdown pull-right mb-1">
  <button class="btn btn-outline-warning mr-5 dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Filter Data
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">   
    <a class="dropdown-item" id="filter_week" href="#">Week</a>
    <a class="dropdown-item" id="filter_month" href="#">Month</a>
  </div>
  <div class="dropdown pull-right mb-1">
  <button class="btn btn-outline-danger dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort The Data by
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" id="fare" href="#">Fare</a>
    <a class="dropdown-item" id="date" href="#">Date</a>
    <a class="dropdown-item" id="distance" href="#">Distance</a>
    <a class="dropdown-item" id="status" href="#">Status</a>
  </div>
</div>
  </div>
  <table id="main" border="0" cellspacing="0" class="w-100">
    <tr>
      <td id="all_table-data">
      </td>
      
    </tr>
  </table>

</div>
<!-- closing div for all rides  -->
</div>
</div>  
</section>                  
<!-- Modal Section  -->
<section>
<div class="modal fade" id="updateinfomodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
   <div class="form-group">
       Hello Mr <?php echo $_SESSION['user']['name']?> You can Easly update your Information. and be sure We'll never share your details with anyone else.
                </div> 
                <input type="hidden"  id="id" value = "<?php echo $_SESSION['user']['id']?>">
      <div class="form-group"> Your Registered Name :<b><?php echo $_SESSION['user']['your_name']?></b> </div>
  <div class="form-group">
    <label for="Name">Name : </label>
    <input type="text" class="form-control" id="Name" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your user name with anyone else.</small>
  </div>
  <div class="form-group"> Your Registered Number  : <b><?php echo $_SESSION['user']['contact']?></b> </div>
  <div class="form-group">
    <label for="Contact">Contact No : </label>
    <input type="number" class="form-control" id="Contact">
  </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='Updateinfo' data-dismiss="modal">Update Information</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updatepasswordmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Your Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden"  id="id" value = "<?php echo $_SESSION['user']['id']?>">
        <div class="form-group">
                Hello Mr <?php echo $_SESSION['user']['name']?> You can Easly update your Password. and be sure We'll never share your details with anyone else.
        </div> 
        <div class="form-group">
            <label for="Oldpass">Old Password : </label>
            <input type="text" class="form-control" id="Oldpass" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your user name and password with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="Newpass">New Password : </label>
            <input type="text" class="form-control" id="Newpass">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Changepass" data-dismiss="modal">Password Change</button>
      </div>
    </div>
  </div>
</div>
</section>  
<!-- Closing of Modal Section -->
<!-- modal for invoice -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <h5 class="modal-title" id="exampleModalLongTitle">INVOICE DETAILS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
      Thanks for visit this site .. hope you are satisfied with the services of cedCAB
       <div id="invoice_data"></div>
      </div>
      <div class="modal-footer">
      If you have any query .. or suggestion or problem with CED CAB you can fell free to contact with us 8000400567
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick = "window.print();">PRINT INVOICE</button>
      </div>
    </div>
  </div>
</div>
<!-- closing moadl fr invoice -->
<footer>
    <div class="container-fluid bg-light pt-2">
      <div class="row">
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
          <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i>
          <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
          <i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i>
          <i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
        <span class = "text-warning span-1 ml-4">Ced</span><span class="span-2 mr-5"><b>Cab</b></span>
          <!-- <p> <i class="fa fa-heart" aria-hidden="true"></i>thanks for Visisting and glad to see you -->
          </p>
        </div>
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
          <nav>
            <a href="#" >FEATURES</a>
            <a href="#">REVIEW</a>
            <a href="#">SIGNUP</a>
          </nav>
        </div>
      </div>
    </div>
</footer>
<!-- performing ajax  -->
    <script>
        //  var total_spent=0;
        //  var total_ride = 0;
       $(document).ready(function(){
        $('#showdashboard').show();
        $('#pending_rides_div').hide();
        $('#complete_rides_div').hide();
        $('#all_rides_div').hide();
        // $('#calculate_pending').text(total_ride);
        var id ='<?php echo $_SESSION['user']['id'];?>';
        var action = 'tiles_ride_info';
        $.ajax({
          url: 'userajaxaction.php',
          type: 'POST',
          dataType : "json",
          data : {action:action,id:id},
          success : function(data){
            $('#Pending_ride_amount').text(data['total_pending_amount']);
            $('#Complete_ride_amount').text(data['total_complete_amount']);
            $('#All_ride_amount').text(data['total_ride_amount']);
            $('#Pending_ride').text(data['total_pending']);
            $('#Complete_ride').text(data['total_complete']);
            $('#All_ride').text(data['total_ride']);
            // alert(data['total_pending_amount']);
          }
        }); 
        $('#pending_rides').click(function(){
          function pending_rides() {
            $('#showdashboard').hide();
            $('#complete_rides_div').hide();
            $('#all_rides_div').hide();
            $('#pending_rides_div').show();
            var action = "pending_rides";
            var id ='<?php echo $_SESSION['user']['id'];?>';
            $.ajax({
                url:'userajaxaction.php',
                type:'POST',
                data: {action:action,id:id},
                dataType : "json",
                success : function(data) {
                    output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                    output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th></tr>";
           
                    for(i=0;i<data.length;i++) {
                        output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td></tr> ";                       
                    }
                    output+='</table>';
                    $('#pending_table-data').html(output);
                }
            });
          }
          pending_rides();
            $('#pend_ride_sort').change(function(){
              var key = $(this).val();
              var action = 'pend_ride_sort';
              var id ='<?php echo $_SESSION['user']['id'];?>';
              $.ajax({
                url:'userajaxaction.php',
                type:'POST',
                data: {action:action,id:id,key:key},
                dataType : "json",
                success : function(data) {
                    output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                    output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th></tr>";
           
                    for(i=0;i<data.length;i++) {
                        output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td></tr> ";                       
                    }
                    output+='</table>';
                    $('#pending_table-data').html(output);
                }
            });

            });
        });
        $('#complete_rides').click(function(){
          function complete_rides() {
            $('#showdashboard').hide();
            $('#complete_rides_div').show();
            $('#all_rides_div').hide();
            $('#pending_rides_div').hide();
            var action = "complete_rides";
            var id ='<?php echo $_SESSION['user']['id'];?>';
            $.ajax({
                url:'userajaxaction.php',
                type:'POST',
                data: {action:action,id:id},
                dataType : "json",
                success : function(data) {
                    output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                    output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>Detailed Invoice</th></tr>";
                    // var total_spent=0;
                    // var total_ride = 0;
                    for(i=0;i<data.length;i++) {
                        output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td><button class='btn btn-primary envoice-btn' data-toggle='modal' data-target='#exampleModalCenter' data-eid="+data[i]['ride_id']+">Invoice</button></td></tr> ";                       
                        total_spent = Number(data[i]['total_fare']) + total_spent;
                        total_ride++;
                    }                   
                    output+='</table>';
                    $('#complete_table-data').html(output);
                    // alert($total_spent);
                    $('#spent').click(function(){
                        $('#spent').text("Your Total Rides = "+total_ride+" and Total-Spent = "+total_spent);
                    });                  
                }
              });  
          }
          complete_rides();
          //envoice details 
          $(document).on('click','.envoice-btn', function(){
            var action = 'invoice';
            var id = $(this).data('eid');
            $.ajax({
              url:'userajaxaction.php',
              type :'post',
              dataType :'json',
              data : {id:id, action:action},
              success : function(data) {
                output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px" class="table text-center table-bordered">';
                    for(i=0;i<data.length;i++) {
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><td align='center'>"+data[i]['ride_date']+"</td></tr><tr><th>PICKUP</th><td>"+data[i]['loc_from']+"</td></tr><tr><th>DESTINATION</th><td>"+data[i]['loc_to']+"</td></tr><tr><th>DISTANCE</th><td>"+data[i]['total_distance']+"</td></tr><tr><th>Total Fare</th><td>"+data[i]['total_fare']+"</td></tr> ";                       
                    }                   
                    output+='</table>';
                    $('#invoice_data').html(output);
              }
            }) 
            });
            //closing of invoice details
                

            
            $('#comp_ride_sort').change(function(){
              var key = $(this).val();
              var action = 'comp_ride_sort';
              var id ='<?php echo $_SESSION['user']['id'];?>';
              $.ajax({
                url:'userajaxaction.php',
                type:'POST',
                data: {action:action,id:id,key:key},
                dataType : "json",
                success : function(data) {
                    output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                    output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th></tr>";
           
                    for(i=0;i<data.length;i++) {
                        output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td></tr> ";                       
                    }
                    output+='</table>';
                    $('#complete_table-data').html(output);
                }
            });

            });
        });        
        $('#all_rides').click(function(){
          function all_rides() {
            $('#showdashboard').hide();
            $('#complete_rides_div').hide();
            $('#all_rides_div').show();
            $('#pending_rides_div').hide();
            var action = "all_rides";
            var id ='<?php echo $_SESSION['user']['id'];?>';
            $.ajax({
                url:'userajaxaction.php',
                type:'POST',
                data: {action:action,id:id},
                dataType : "json",
                success : function(data) {
                    output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                    output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
           
                    for(i=0;i<data.length;i++) {
                      var stat;
                      if(data[i]['status']==1) {
                        stat = 'PENDING';
                      } else if(data[i]['status']== 2) {
                        stat = 'COMPLETE';
                      } else {
                        stat = "CANCEL";
                      }
                        
                        output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                    }
                    output+='</table>';
                    $('#all_table-data').html(output);
                   
                }
            });
          }
          all_rides();
            //data sorting 
              $('#fare').click(function(e){
                e.preventDefault();
                var action = "sort_fare";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
            });
                
              });
              $('#date').click(function(e){
                e.preventDefault();
                var action = "sort_date";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
                });
              });
              $('#distance').click(function(e){
                e.preventDefault();
                var action = "sort_distance";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
                });
              });
              $('#status').click(function(e){
                e.preventDefault();
                var action = "sort_status";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
                });
              });
        // close data sorting
        //Filtrting Data 
        $('#filter_week').click(function(e){
                e.preventDefault();
                var action = "filter_week";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
                });
              });
              $('#filter_month').click(function(e){
                e.preventDefault();
                var action = "filter_month";
                var id ='<?php echo $_SESSION['user']['id'];?>';
                $.ajax({
                    url:'userajaxaction.php',
                    type:'POST',
                    data: {action:action,id:id},
                    dataType : "json",
                    success : function(data) {
                        output = '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">';
                        output+="<tr align='center' height='40px'><th>RIDE DATE</th><th>PICKUP</th><th>DESTINATION</th><th>DISTANCE</th><th>FARE</th><th>STATUS</th></tr>";
              
                        for(i=0;i<data.length;i++) {
                          var stat;
                          if(data[i]['status']==1) {
                            stat = 'PENDING';
                          } else if(data[i]['status']== 2) {
                            stat = 'COMPLETE';
                          } else {
                            stat = "CANCEL";
                          }
                            output+="<tr align='center' height='40px'><td align='center'>"+data[i]['ride_date']+"</td><td>"+data[i]['loc_from']+"</td><td>"+data[i]['loc_to']+"</td><td>"+data[i]['total_distance']+"</td><td>"+data[i]['total_fare']+"</td><td>"+stat+"</td></tr> ";                       
                        }
                        output+='</table>';
                        $('#all_table-data').html(output);
                      
                    }
                });
              });
        
          });

        $('#Updateinfo').click(function(){
          var id = $('#id').val();
          var name = $('#Name').val();
          var contact = $('#Contact').val();
          if(contact.length==10) {
            valcontact = contact; 
          } else {
            alert("mobile number not in perfect length");
          }
          var action = 'update_user_info';
          $.ajax({
            url:'userajaxaction.php',
            type :'POST',
            data:{id:id, name:name, contact:contact, action:action},
            success : function(data) {
              alert(data);
            }
          });
        }); 
        $('#Changepass').click(function(e){
          e.preventDefault();
          var id = $('#id').val();
          var oldpass = $('#Oldpass').val();
          var newpass = $('#Newpass').val();
          var action = 'update_user_password';
          $.ajax({
            url:'userajaxaction.php',
            type :'POST',
            data:{id:id, oldpass:oldpass, newpass:newpass, action:action},
            success : function(data) {
              if(data == 1) {
                window.location="login.php";
              } else {
                alert(data);
              }
            }
          });
        });  
        $('#clickme').click(function(){
            pending_rides();
          });    
       });
    </script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>