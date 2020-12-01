<?php
session_start();
include 'locationclass.php';
// globally declared variabkle
$pickup_data  = $_POST['pick'];
$dest_data = $_POST['dest'];
$cab_data = $_POST['cab'];
$luggage_data = $_POST['luggage'];
$calculated_distance;
$output='';
$fare;

// fetch the data from location db and create a array in the way of perform dayanamic by calling the class of locationn classes file
$obj = new locationclass();
$destpick  = $obj->createarray();
// define a array  with the name of cities and distance for calculating the distance..............................
if ((array_key_exists($pickup_data, $destpick))  and  (array_key_exists($dest_data, $destpick))) {
    $calculated_distance  = (abs($destpick[$dest_data] - $destpick[$pickup_data]));
}
$output.= '<tr><td>cab-service</td><td >'. $cab_data. '</td></tr>';
$output.= '<tr><td>Total-Distance</td><td >'. $calculated_distance. '.km </td></tr>';
// calculation for luggage data .. ..............................
$luggage_amount=0;
if ($luggage_data >0 and $luggage_data <= 10) {
    $luggage_amount = 50;
} else if($luggage_data >10 and $luggage_data <= 20) {
    $luggage_amount = 100;
} else if($luggage_data > 20) {
    $luggage_amount = 200;
}
// switch case for differentiate between different different cabs 
switch ($cab_data) {
case "CedMicro": 
    $fare =  check($calculated_distance, 50, 13.50, 12.00, 10.20, 8.50);
    break;
case "CedMini": 
    $fare =  check($calculated_distance, 150, 14.50, 13.00, 11.20, 9.50);
    break;
case "CedRoyal":
    $fare =  check($calculated_distance, 200, 15.50, 14.00, 12.20, 10.50);
    break;   
case "CedSUV": 
    $fare =  check($calculated_distance, 250, 16.50, 15.00, 13.20, 11.50);
    $luggage_amount = $luggage_amount * 2;
    break;
} 
//**create function that will help out tp find out the range
function check($calculated_distance, $fixed, $a, $b, $c, $d) {
    $fixedfare = $fixed;
    if ($calculated_distance<=10) {
        $farefor10 = $fixedfare + $calculated_distance * $a;
        $fare = $farefor10;
       
    } else if ($calculated_distance > 10 and $calculated_distance <= 60) {
        $calculated_distance = $calculated_distance - 10;
        $farefor50 = ($fixed + (10*$a) + ($calculated_distance*$b));
        $fare =  $farefor50;
    } else if ($calculated_distance > 60 and $calculated_distance <= 160) {
        $calculated_distance = $calculated_distance - 60;
        $farefor100 = $fixedfare + (10*$a + 50*$b) + ($calculated_distance * $c);
        $fare =  $farefor100;
    } else if ($calculated_distance > 160 ) {
        $calculated_distance = $calculated_distance - 160;
        $fareforabove =$fixedfare + (10*$a + 50*$b + 100*$c)  + ($calculated_distance * $d);
        $fare =  $fareforabove;
    }
    return $fare;
}
// print the output data in the form of table 
$output.= '<tr><td>Fare-Amout</td><td >'.$fare. '.Rs </td></tr>';
$output.='<tr><td>Fare for Luggage</td><td >'. $luggage_amount. '. Rs </td></tr>';
$output.='<tr><td>Total-Fare(fare+luggage) </td><td >'. ($fare + $luggage_amount ). '. Rs </td></tr>';
$output.='</table>';
echo $output;

$_SESSION['cart']=array(
    'pickup'=>$pickup_data,
    'destination'=>$dest_data,
    'cabdata'=>$cab_data,
    'calculated_distance'=>$calculated_distance,
    'fare' => $fare,
    'luggage'=>$luggage_data,
    'luggage_amount'=>$luggage_amount,
    'ftotal_amount'=>($fare + $luggage_amount));
?>
