<?php
include 'Config.php';
include 'userclasses.php';
// craete the object of config class an d call the function connect()
$obj = new Config();
$data = $obj->Connect();
// create the object of userclasses 
$userclass = new userclasses();
$action = $_POST['action'];
switch($action) {
 case 'load' :      
    $output = $userclass -> load_data( $data);
    echo $output; 
 break;
 case 'insert' :
    $location = $_POST['loc_name'];
    $distance = $_POST['dist'];
    $avail = $_POST['avail'];
    $output = $userclass -> insert_data($location,$distance, $avail, $data);
    echo $output; 
 break;
 case 'delete':
    $id = $_POST['id'];
    $output = $userclass -> delete_data($id, $data);
    echo $output;
 break;
 case 'edit':
    $id = $_POST['id'];
    $output = $userclass -> edit_data($id, $data);
    echo $output;
 break;
 
 case 'update':
   $id = $_POST['id'];
   $loc  = $_POST['loc'];
   $dist = $_POST['dist'];
   $avail = $_POST['avail'];
   $output = $userclass -> update_data($id, $loc, $dist, $avail, $data);
   echo $output;
break;
case 'load-ride' :      
   $output = $userclass -> load_data_for_ride( $data);
   echo $output; 
break;
case 'update-ride' :  
   $id = $_POST['id'];
   $value = $_POST['value'];    
   $output = $userclass -> update_data_for_ride( $data,$id, $value);
   echo $output; 
break;
case 'load_total_ride' :      
   $output = $userclass -> load_data_for_approved_ride( $data);
   echo $output; 
break;

case 'delete_total_ride' : 
   $id = $_POST['id'];     
   $output = $userclass -> delete_data_for_approved_ride($id, $data);
   echo $output; 
break;

case 'load_cancel_ride' :     
   $output = $userclass -> load_data_for_cancel_ride($data);
   echo $output; 
break;

case 'load_rides_total_ride' :     
   $output = $userclass -> load_data_for_whole_ride($data);
   echo $output; 
break;

case 'calculate-earning' :     
   $output = $userclass -> calculate_earning($data);
   echo $output; 
break;

case 'show_disapproved_user' :     
   $output = $userclass -> show_disapproved_user($data);
   echo $output; 
break;
case 'update_user_pending' :
   $id = $_POST['id']; 
   $value = $_POST['value'];    
   $output = $userclass -> update_user_pending($id, $value, $data);
   echo $output; 
break;
case 'show_approved_user' :     
   $output = $userclass -> show_approved_user($data);
   echo $output; 
break;
case 'show_all_user' :     
   $output = $userclass -> show_all_user($data);
   echo $output;   
break;

case 'delete_total_user' :  
   $id = $_POST['id'];   
   $output = $userclass -> delete_total_user($id, $data);
   echo $output;   
break;

case 'change_admin_pass' :
   $id = $_POST['id'];  
   $oldpass = $_POST['oldpass'];
   $newpass = $_POST['newpass'];    
   $output = $userclass->change_admin_password($id, $oldpass, $newpass, $data);
   echo $output;   
break;
case 'tiles_ride_user_info' :  
   $id = $_POST['id'];   
   $output = $userclass -> tiles_ride_user_info($id, $data);
   print_r($output);   
break;
// co for sort the data.....................
case 'short_by_name' :     
   $output = $userclass -> short_by_name($data);
   echo $output;   
break;
case 'short_by_date' :     
   $output = $userclass -> short_by_date($data);
   echo $output;   
break;
case 'short_by_status' :     
   $output = $userclass -> short_by_status($data);
   echo $output;   
break;
//perfroming sorting from user table
case 'filter_fare' :     
   $output = $userclass -> filter_fare($data);
   echo $output; 
break;
case 'filter_date' :     
   $output = $userclass -> filter_date($data);
   echo $output; 
break;
case 'filter_distance' :     
   $output = $userclass -> filter_distance($data);
   echo $output; 
break;
case 'filter_week' :     
   $output = $userclass -> filter_week($data);
   echo $output; 
break;
case 'filter_month' :     
   $output = $userclass -> filter_month($data);
   echo $output; 
break;
// filter location by search key
case 'location_search_filter' :  
   $key = $_POST['key'];   
   $output = $userclass -> location_search_filter($data, $key);
   echo $output; 
break;
case 'sort_location' :  
   $key = $_POST['key'];   
   $output = $userclass -> sort_location($data, $key);
   echo $output; 
break;
// sorting for approvide ride 
case 'approved_sort' :  
   $key = $_POST['key'];   
   $output = $userclass -> approved_sort($data, $key);
   echo $output; 
break;
case 'request_ride_sort' :  
   $key = $_POST['key'];   
   $output = $userclass -> request_ride_sort($data, $key);
   echo $output; 
break;

} 


?>