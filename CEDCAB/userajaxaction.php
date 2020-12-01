<?php
include 'rideclasses.php';
$obj = new rideclasses();

$action = $_POST['action'];
switch($action) {
 case 'pending_rides' :
    $id = $_POST['id'];      
    $output = $obj->pending_rides($id);
    print_r($output);
 break;
 case 'complete_rides' :
    $id = $_POST['id'];      
    $output = $obj->complete_rides($id);
    print_r($output);    
 break;
 case 'all_rides' :
    $id = $_POST['id'];      
    $output = $obj->all_rides($id);
    print_r($output);    
 break;
 case 'update_user_info' :
   $id = $_POST['id'];  
   $name = $_POST['name'];
   $contact = $_POST['contact'];    
   $output = $obj->update_user_info($id, $name, $contact);
   echo $output;    
break;
case 'update_user_password' :
   $id = $_POST['id'];  
   $oldpass = $_POST['oldpass'];
   $newpass = $_POST['newpass'];    
   $output = $obj->update_user_password($id, $oldpass, $newpass);
   echo $output;    
break;
// tiles data
case 'tiles_ride_info' : 
   $id = $_POST['id'];      
   $output = $obj->tiles_ride_info($id);
   print_r ($output);   
break;
//titles data
// sorting concept are here
case 'sort_fare' :
   $id = $_POST['id'];      
   $output = $obj->sort_fare($id);
   print_r($output);    
break;
case 'sort_date' :
   $id = $_POST['id'];      
   $output = $obj->sort_date($id);
   print_r($output);    
break;
case 'sort_distance' :
   $id = $_POST['id'];      
   $output = $obj->sort_distance($id);
   print_r($output);    
break;
case 'sort_status' :
   $id = $_POST['id'];      
   $output = $obj->sort_status($id);
   print_r($output);    
break;
//close sorting conce[t]
//strat filter concept

case 'filter_week' :
   $id = $_POST['id'];   
   $output = $obj->filter_week($id);
   echo $output; 
break;
case 'filter_month' :
   $id = $_POST['id'];   
   $output = $obj->filter_month($id);
   echo $output; 

break;
//close filter concept

// sorting for pending ride
case 'pend_ride_sort' :
   $key = $_POST['key'];
   $id = $_POST['id'];      
   $output = $obj->pend_ride_sort($id,$key);
   print_r($output);
break;
case 'comp_ride_sort' :
   $key = $_POST['key'];
   $id = $_POST['id'];      
   $output = $obj->comp_ride_sort($id,$key);
   print_r($output);
break;
case 'invoice' :
   $id = $_POST['id'];      
   $output = $obj->invoice($id);
   print_r($output);
break;
}
?>