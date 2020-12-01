<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Ride</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <header>    
        <div class="top-foot">
            Welcome to this ADMIN Pannel Dashnoard
        </div>
    </header>
    <section>
        <div class="info">
          <marquee>  hii you can easly maintain the whole concept of ceed-cab as a super admin by using these menues like addlocation rides and show more</marquee>
        </div>
    </section>
<section>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <a class="navbar-brand " href="#">CED CAB</a>
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
          LOCATION
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="admin_location.php">ADD LOCATION</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-danger" href="admin_logout.php" id="logout">LOG-OUT <span class="sr-only">(current)</span></a>
      </li>

    </ul>
  </div>
</nav>
</section>  

  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <div class="row">
          <div class="col">
            <h1>LIST OF ALL THE RIDE </h1>
          </div>
        <div id="search-bar">
        
          <div class="col-lg-4">
              <div class="dropdown">
              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                SORT THE DATA BY:
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" id="fare" href="#">Fare</a>
                <a class="dropdown-item" id="date" href="#">Date</a>
                <a class="dropdown-item" id="distance" href="#">Distance</a>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="dropdown">
              <button class="btn btn-warning dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                FILTER BY WEEK|MONTH :
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" id="filter_week" href="#">WEEK</a>
                <a class="dropdown-item" id="filter_month" href="#">MONTH</a>
              </div>
          </div>
        </div>
        </div>
        
        <!-- </div> -->
        
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="20" cellspacing="5px" width="100%" id="modal-table">
        <!-- <tr class="modal-body"></tr> -->
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>
  <footer>
        <div class="top-foot">
            developed and designed by CEDCOSS
        </div>   
  </footer>
<script>
 $(document).ready(function(){
        function loadTable() { 
        var action="load_rides_total_ride";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
          } 
        loadTable();
        $('#filter_week').click(function(){
          var action="filter_week";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
        });
        $('#filter_month').click(function(){
          var action="filter_month";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
        });
        $('#fare').click(function(){
          var action="filter_fare";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
        });
        $('#date').click(function(){
          var action="filter_date";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
        });
        $('#distance').click(function(){
          var action="filter_distance";           
              $.ajax ({
                  url: 'ajaxaction.php',
                  type : "POST",
                  data : {action:action},
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
        });
        $(document).on("click",'.delete-btn',function(){
        var id =  $(this).data("id");
        var element = this;
          var action="delete_total_ride";           
            $.ajax ({
                url: 'ajaxaction.php',
                type : "POST",
                data : {action:action, id:id},
                success : function(data) {
                  if(data == 1) {
                    $(element).closest("tr").fadeOut();
                    loadTable();
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