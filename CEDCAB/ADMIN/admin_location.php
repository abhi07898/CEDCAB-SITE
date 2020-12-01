<?php
session_start();
// include 'userclasses.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Pannel;</title>
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
          <a class="dropdown-item" href="ride_request.php">All Rides</a>
        </div>
      </li>
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LOCATION
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">LOCATION LIST</a>
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
      <h1 class="mr-5">LOCATION PORTION </h1>
      <div>
      </div>
        <select  id="sort_location" class="pt-2 pl-5 pb-1 pr-5 btn btn-outline-warning mt-3 ml-5 text-center text-light">
        <option value="name">NAME</option>
        <option value="distance">DISTANCE</option>
        <option value="isavailable">IS AVAIL</option>
        </select>
        <div id="search-bar" > 
          <label>Search </label>
          <input type="text" id="search" autocomplete="off" class="btn btn-outline-warning text-dark">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          LOCATION : <input type="text" id="location_name">
          DISTANCE : <input type="number" id="distance">
          Availability : <select name="location" id="avl_location">
            <option value="0">Available - 0</option>
            <option value="1">No-Available - 1</option>
          
          </select>
          <input type="submit" id="save-button" value="Save">
        </form>
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
        var action="load";           
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
      // insert records 
      $('#save-button').click(function(){
        var location_name = $('#location_name').val(); 
        var distance = $('#distance').val();
        var location = $('#avl_location').val();
        var action="insert";  
        $.ajax({
          url: 'ajaxaction.php',
          type : "POST",
          data : {loc_name:location_name, dist:distance, avail:location, action:action},
          success : function(data) {
          }
        });
        loadTable();
      }); 
      //delete records 
      $(document).on("click",'.delete-btn', function(){
        var delet_id = $(this).data("id");
        var element = this;
        var action='delete';
        $.ajax({
          url: 'ajaxaction.php',
          type : "POST",
          data : {id : delet_id, action:action},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html(data).slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      
      });

      //edit records
      $(document).on("click",'.edit-btn', function(){
        var edit_id = $(this).data("eid");
        var action = 'edit';
        $('#modal').show();
        $.ajax({
          url: "ajaxaction.php",
          type : "POST",
          data : {id : edit_id, action:action},
          success : function(data){
            $('#modal-table').html(data);                  
          }
        });
      });
      $("#close-btn").on("click",function(){
      $("#modal").hide();
      });
      // update recorords 
      $(document).on("click","#edit-submit", function(){
        var edit_id = $('#edit-id').val();
        var location = $('#edit-location').val();
        var distance = $('#edit-distance').val();
        var avail = $('#avail_location').val();
        var action = 'update';
        $.ajax({
          url:'ajaxaction.php',
          type : 'POST',
          data: {id:edit_id , loc:location, dist:distance, avail:avail, action:action},
          success : function(data) {
            if(data == 1) {
              loadTable();
            } else {
              alert(data);
            }
          }
         
        });
        $('#modal').hide();
      });
      $('#search').keyup(function(){
        var search_key = $(this).val();
        var action = 'location_search_filter';
        $.ajax({
          url : 'ajaxaction.php',
          type:'POST',
          data : {action:action,key:search_key},
          success : function(data) {
            $('#table-data').html(data);
          }          
        });
        // alert(search_key);
      });
      $('#sort_location').change(function(){
        var sort_location_key = $(this).val();
        var action = 'sort_location';
        $.ajax({
          url : 'ajaxaction.php',
          type:'POST',
          data : {action:action,key:sort_location_key},
          success : function(data) {
            $('#table-data').html(data);
            // alert(data);
          }          
        });
        // alert(data);
      });
  });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>  

  </body >
</html>