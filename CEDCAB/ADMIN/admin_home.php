<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Pannel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <header>    
        <div class="top-foot" >
            Welcome to this ADMIN Pannel Dashnoard
        </div>
    </header>
    <section>
        <div class="info">
          <marquee>  hii you can easly maintain the whole concept of ceed-cab as a super admin by using these menues like addlocation rides and show more</marquee>
        </div>
    </section>
    <?php 
    if (!isset($_SESSION['admin'])) 
        {
            echo '<script>window.location="../USER/login.php"</script>';
            // header('location:login.php');
            $third_menu = "REVIEWS";
        } else {
            $third_menu = $_SESSION['admin'];                       
        }
    ?>
<section>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand " href="admin_home.php">CED CAB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto" >
      <li class="nav-item active">
        <a class="nav-link" href="admin_home.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          RIDES
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="ride_request.php">Pending</a>
          <a class="dropdown-item" href="ride_approved.php">Completed</a>
          <a class="dropdown-item" href="ride_cancel.php">Cancelled</a>
          <a class="dropdown-item" href="ride_total.php">All Rides</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          USER
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#" id="pending_user">Pending User Request</a>
          <a class="dropdown-item" href="#" id = "approved_user">Approved User</a>
          <a class="dropdown-item" href="#" id = "all_user">All User</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LOCATION
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="admin_location.php">ADD LOCATION</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ACCOUNT Mr. <?php echo $_SESSION['admin']['admin_name'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#" id="changepassword" data-toggle="modal" data-target="#exampleModalCenter">Change Password</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-danger" href="admin_logout.php" id="logout">LOG-OUT <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
</section>  
<!-- tiles for Users -->
<div id="showdashboard">
<section>
  <div class="container mt-2">
    <div class="row">
    <div class="col">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Pending User:</div>
        <div class="card-body">
          <h5 class="card-title text-center text-light" id="Pending_user">Rs.</h5>
          <p class="card-text"></p>
          <div class="card-footer">
           Use  menu for more info.
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">Approved User :<div id="comp_ride"></div></div>
          <div class="card-body">
            <h5 class="card-title text-center text-light"id="Approved_user"></h5>
            <p class="card-text"></p>
            <div class="card-footer">
             Use menus for more info.
            </div>
          </div>
        </div>       
      </div>
      <div class="col">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header text-center">All Usres</div>
          <div class="card-body">
            <h5 class="card-title text-center text-light"id="All_user"></h5>
            <p class="card-text"></p>
            <div class="card-footer">
             Use  menus for more info.
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
 </scetion>  

</div>
<section>
<div id="pending_user_request">
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>LIST OF ALL PENDING USERS </h1>
        <div id="search-bar">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
</div>
</section>
<section>
<div id="approved_user_request">
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>LIST OF ALL APPROVED USERS </h1>
        <div id="search-bar">
        </div>
      </td>
    </tr>
    <tr>
      <td id="approved_table-data">
      </td>
    </tr>
  </table>
</div>
</section>
<section>
<div id="approved_all_user_request">
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>LIST OF ALL APPROVED USERS </h1>
        <div id="search-bar">
        <div class="dropdown">
          <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            SORT THE DATA BY:
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="name" href="#">Name</a>
            <a class="dropdown-item" id="date" href="#">Date</a>
            <a class="dropdown-item" id="status" href="#">Status</a>
          </div>
        </div>
        </div>
      </td>
    </tr>
    <tr>
      <td id="approved_all_table-data">
      </td>
    </tr>
  </table>
</div>
</section>
<!-- Modal Section -->
<section>
  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Password Chaging Pannel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Previous Password</label>
          <input type="hidden" value = "<?php echo $_SESSION['admin']['admin_id']?>" id='id'>
          <input type="text" class="form-control" id="oldpass" aria-describedby="emailHelp" placeholder="Eneter your current password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Change Password</label>
        <input type="password" class="form-control" id="newpass" placeholder="Enter your new password">
      </div>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="changepass">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
    <footer>
        <div class="top-foot">
            developed and designed by CEDCOSS
        </div>   
    </footer>
    <script>
      $(document).ready(function(){
        $('#pending_user_request').hide();
        $('#approved_user_request').hide();
        $('#approved_all_user_request').hide();       
        $('#showdashboard').show();
        var id ='<?php echo $_SESSION['admin']['admin_id'];?>';
        var action = 'tiles_ride_user_info';
        $.ajax({
          url: 'ajaxaction.php',
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
            $('#Pending_user').text(data['total_pending_user']);
            $('#Approved_user').text(data['total_approved_user']);
            $('#All_user').text(data['total_user']);
            // alert(data);
          }
        });
        




       $('#pending_user').click(function(e){
         e.preventDefault();
         $('#showdashboard').hide();
         $('#approved_user_request').hide();
         $('#approved_all_user_request').hide(); 
         $('#pending_user_request').show();
         function loadPendingUserTable() {
          var action = "show_disapproved_user";
           $.ajax({
           url : 'ajaxaction.php',
           type : 'post',
           data: {action:action},
           success : function(data) {
             $('#table-data').html(data);
           }
         });
         }
         loadPendingUserTable();
         
       });
       $(document).on("click",'#change_isblock',function(){
        var id =  $(this).data("eid");
        var value = $(this).val();
        var element = this;
          var action="update_user_pending";           
            $.ajax ({
                url: 'ajaxaction.php',
                type : "POST",
                data : {action:action, id:id, value:value},
                success : function(data) {
                  if(data == 1) {
                    $(element).closest("tr").fadeOut();
                    loadPendingUserTable();
                  }
                }
            });
      });
      $('#approved_user').click(function(e){
         e.preventDefault();
         $('#showdashboard').hide();
         $('#pending_user_request').hide();
         $('#approved_all_user_request').hide(); 
         $('#approved_user_request').show();
         function loadApprovedUserTable() {
          var action = "show_approved_user";
           $.ajax({
           url : 'ajaxaction.php',
           type : 'post',
           data: {action:action},
           success : function(data) {
             $('#approved_table-data').html(data);
           }
         });
         }
         loadApprovedUserTable();                
       });
       $('#all_user').click(function(e){
         e.preventDefault();
         $('#showdashboard').hide();
         $('#pending_user_request').hide();
         $('#approved_user_request').hide();
         $('#approved_all_user_request').show(); 
         function loadAllUserTable() {
          var action = "show_all_user";
           $.ajax({
           url : 'ajaxaction.php',
           type : 'post',
           data: {action:action},
           success : function(data) {
             $('#approved_all_table-data').html(data);            
           }
         });
         }
         loadAllUserTable();  
         // Ajax for sorth the table data 
         $('#name').click(function(e){
          e.preventDefault();
          $('#showdashboard').hide();
          $('#pending_user_request').hide();
          $('#approved_user_request').hide();
          $('#approved_all_user_request').show(); 
          function SortByName() {
            var action = "short_by_name";
            $.ajax({
            url : 'ajaxaction.php',
            type : 'post',
            data: {action:action},
            success : function(data) {
              $('#approved_all_table-data').html(data);            
            }
          });
         }
         SortByName();  
         });  
         $('#date').click(function(e){
          e.preventDefault();
          $('#showdashboard').hide();
          $('#pending_user_request').hide();
          $('#approved_user_request').hide();
          $('#approved_all_user_request').show(); 
          function SortByDate() {
            var action = "short_by_date";
            $.ajax({
            url : 'ajaxaction.php',
            type : 'post',
            data: {action:action},
            success : function(data) {
              $('#approved_all_table-data').html(data);            
            }
          });
         }
         SortByDate();  

         }); 
         $('#status').click(function(e){
          e.preventDefault();
          $('#showdashboard').hide();
          $('#pending_user_request').hide();
          $('#approved_user_request').hide();
          $('#approved_all_user_request').show(); 
          function SortByStatus() {
            var action = "short_by_status";
            $.ajax({
            url : 'ajaxaction.php',
            type : 'post',
            data: {action:action},
            success : function(data) {
              $('#approved_all_table-data').html(data);            
            }
          });
         }
         SortByStatus();
         });     
       });
       //akax for delet the user from whole user 
       $(document).on("click",'.delete-btn',function(){
        var id =  $(this).data("id");
        var element = this;
          var action="delete_total_user";           
            $.ajax ({
                url: 'ajaxaction.php',
                type : "POST",
                data : {action:action, id:id},
                success : function(data) {
                  if(data == 1) {
                    $(element).closest("tr").fadeOut();
                    loadAllUserTable();
                  }
                }
            }); 
          });
      $('#changepass').click(function(){
        var id = $('#id').val();
        var oldpass = $('#oldpass').val();
        var newpass = $('#newpass').val();
        var action = 'change_admin_pass';
        $.ajax({
          url:'ajaxaction.php',
          type:'post',
          data : {id:id, oldpass:oldpass, newpass:newpass, action:action},
          success : function(data){
            if(data == 1) {
              window.location="login.php";
            } else {
              alert(data);
            }
           
          }
        });
      });
      });
    </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>  
</body>
</html>