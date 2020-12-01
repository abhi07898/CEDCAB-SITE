<?php
session_start();
class userclasses {
    public $user_id;
    public $user_name;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $isbloock;
    public $password;
    public $is_admin;

    function login($user_name, $password,$data) {
        $sql = "SELECT * FROM   user WHERE `user_name` = '" . $user_name . "' AND `password`='" . $password . "'";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {       
            while ($row = $result-> fetch_assoc()) {
                $_SESSION['admin'] = array('admin_name'=>$row['user_name'],'admin_id'=>$row['userid']);  
                if ($row['isadmin'] == 0 && $row['isblock'] == 1 ) {
                    $rtn = "USER";
                } else if ($row['isadmin'] == 1) {
                    $rtn = "ADMIN";
                }                                                                    
            }
        } else {
            $rtn =  "login failled 'hey you are entered wrong username or password '";
            
        }
        return $rtn;
    }
    function register($username, $name, $mobile, $repassword,$data) {
        $sql = "INSERT INTO user (`user_name`,`name`,`date_of_signup`,`mobile`,`password`) VALUES ('".$username."','".$name."', NOW() ,'".$mobile."','".$repassword."' )"; 
        if ($data->query($sql) === true) {
            $reg_info  = "Inserted";
        } else {
            $incorrect = "Error: " . $sql . "<br>" . $conn->error;
        }
        return $reg_info;
    }
// ajax action methods .........................................................................................
    function load_data($data) {
        $output = "";
        $sql = "SELECT * FROM location";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th width="60px">ID</th>
            <th>LOCATION</th>
            <th>DISTANCE</th>
            <th>AVALIBILITY</th>
            <th>ACTION</th>
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['location_id']}</td><td>{$row['name']}</td><td>{$row['distance']}</td><td>{$row['isavailable']}</td><td><button class='edit-btn' data-eid='{$row["location_id"]}'>Edit</button>&nbsp;&nbsp;&nbsp<button Class='delete-btn' data-id='{$row["location_id"]}'>DELETE</button></td></tr> ";
            }
            $output .= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
    }
    function insert_data($location,$distance, $avail, $data) {
        $sql = "INSERT into location (`name`,`distance`,`isavailable`) VALUES ('$location','$distance','$avail' )" ; 
        if ($data->query($sql) === true) {
            echo "1";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    function delete_data($id, $data) {
        $sql = "DELETE FROM location WHERE location_id = {$id}";
        if ($data->query($sql) === true) {
            echo "1";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
    function edit_data($id, $data) {
        $output = '';
        $sql = "SELECT * FROM location WHERE `location_id` = '$id'";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $output.= "<tr>
            <td width='90px' >LOCATION Name</td>
            <td><input type='text' id='edit-location' c value='{$row["name"]}'>
                <input type='text' id='edit-id' hidden value='{$row["location_id"]}'>
            </td>
          </tr>
          <tr>
            <td>DISTANCE</td>
            <td><input type='text' id='edit-distance' value='{$row["distance"]}'></td>
          </tr>
          <tr>
            <td>AVAIL</td>
            <td>
            <select name='location' id='avail_location'>
            <option value='0'>Available - 0</option>
            <option value='1'>No-Available - 1</option>          
            </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><input type='submit' id='edit-submit' value='save'></td>
          </tr>";
        }
       
        } else {
        $output = "0 results";
        }
        return $output;
    }
    function  update_data($id, $loc, $dist, $avail, $data) {
        $sql = "UPDATE location SET `name`='$loc' , `distance`='$dist', `isavailable`='$avail' WHERE `location_id`='$id'";
        if ($data->query($sql) === TRUE) {
            $output = 1;
        } else {
       $output =  "Error updating record: " . $data->error;
        }
        return $output;
    }
// function for ride- information table fatching and editing the ride comtent like 1,2,3
    function load_data_for_ride( $data){
        $output = "";
        $sql = "SELECT * FROM ride WHERE `status` = 1" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th>DATE</th>
            <th width="60px">ID</th>
            <th>PICKUP</th>
            <th>DESTINATION</th>
            <th>DISTANCE</th>
            <th>CURRENT STATUS</th>
            <th>FARE</th>
            <th>CHANGE STATUS</th>
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['ride_date']}</td><td align='center'>{$row['ride_id']}</td><td>{$row['loc_from']}</td><td>{$row['loc_to']}</td><td>{$row['total_distance']}</td>
                <td>{$row['status']}</td>
                <td>{$row['total_fare']}</td>
                <td><select name='change_status' id='change_status' data-eid='{$row["ride_id"]}'>
                <option value='2'>APPROVE - 2</option>
                <option value='3'>CANCEL - 3</option>          
                </select></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
    }
    function update_data_for_ride( $data,$id, $value) {
        $sql = "UPDATE ride SET `status` = $value WHERE `ride_id`='$id'";
        if ($data->query($sql) === TRUE) {
            $output = 1;
        } else {
       $output =  "Error updating record: " . $data->error;
        }
        return $output;
    }
    function load_data_for_approved_ride( $data) {
        $output = "";
        $sql = "SELECT * FROM ride WHERE `status` = 2" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th width="60px">ID</th>
            <th>CUSTOMER-ID</th>
            <th>DATE</th>
            <th>PICKUP</th>
            <th>DESTINATION</th>
            <th>DISTANCE</th>
            <th>LUGGAGE</th>
            <th>TOTAL-FARE</th>
            <th>DELETE</th>
            
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'>
                <td align='center'>{$row['ride_id']}</td>
                <td>{$row['cust_id']}</td>
                <td>{$row['ride_date']}</td>
                <td>{$row['loc_from']}</td>
                <td>{$row['loc_to']}</td>
                <td>{$row['total_distance']}</td>
                <td>{$row['luggage']}</td>
                <td>{$row['total_fare']}</td>
                <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
    }
    function delete_data_for_approved_ride($id, $data) {
        $sql = "DELETE FROM ride WHERE `ride_id` = {$id}";
        if ($data->query($sql) === true) {
            $output =  1;
        } else {
            $output =  "Error deleting record: " . $conn->error;
        }
        return $output;
    }



    function load_data_for_cancel_ride($data) {
        $output = "";
        $sql = "SELECT * FROM ride WHERE `status` = 3" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th width="60px">ID</th>
            <th>CUSTOMER-ID</th>
            <th>DATE</th>
            <th>PICKUP</th>
            <th>DESTINATION</th>
            <th>DISTANCE</th>
            <th>LUGGAGE</th>
            <th>TOTAL-FARE</th>
            <th>DELETE</th>
            
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'>
                <td align='center'>{$row['ride_id']}</td>
                <td>{$row['cust_id']}</td>
                <td>{$row['ride_date']}</td>
                <td>{$row['loc_from']}</td>
                <td>{$row['loc_to']}</td>
                <td>{$row['total_distance']}</td>
                <td>{$row['luggage']}</td>
                <td>{$row['total_fare']}</td>
                <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
    }
   
    function  load_data_for_whole_ride($data) {
        $output = "";
        $sql = "SELECT * FROM ride";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th width="60px">ID</th>
            <th>CUSTOMER-ID</th>
            <th>DATE</th>
            <th>PICKUP</th>
            <th>DESTINATION</th>
            <th>DISTANCE</th>
            <th>LUGGAGE</th>
            <th>STATUS</th>
            <th>TOTAL-FARE</th>
            <th>DELETE</th>
            
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'>
                <td align='center'>{$row['ride_id']}</td>
                <td>{$row['cust_id']}</td>
                <td>{$row['ride_date']}</td>
                <td>{$row['loc_from']}</td>
                <td>{$row['loc_to']}</td>
                <td>{$row['total_distance']}</td>
                <td>{$row['luggage']}</td>
                <td>{$row['status']}</td>
                <td>{$row['total_fare']}</td>
                <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
    }
    // class for calculate the value of earning 
    function calculate_earning($data) {
        $total_earn = 0;
        $total_ride = 0;
        $sql = "SELECT `total_fare` FROM ride";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){ 
                $total_earn = (int)$row['total_fare'] + $total_earn;
                $total_ride++;
            }
        }
       
        return $total_earn;

    }
    function show_disapproved_user($data) {
        $output = "";
        $sql = "SELECT * FROM user WHERE `isblock` = 0" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px"  class=" text-center table-striped  table-sm">
            <tr>
            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
            <th>ISBLOCK</th>
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td>
                <td><select name='change_isblock' id='change_isblock' data-eid='{$row["userid"]}'>
                <option value='1'>UN BLOCK - 1</option>
                <option value='0'>BLOCK - 0</option>          
                </select></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }
    function update_user_pending($id, $value, $data) {
        $sql = "UPDATE user SET `isblock` = $value WHERE `userid`='$id'";
        if ($data->query($sql) === TRUE) {
            $output = 1;
        } else {
       $output =  "Error updating record: " . $data->error;
        }
        return $output;
    }
    function show_approved_user($data) {
        $output = "";
        $sql = "SELECT * FROM user WHERE `isblock` = 1" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px" class=" text-center table-striped  table-sm">
            <tr>
            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
          
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }
    function  show_all_user($data) {
        $output = "";
        $sql = "SELECT * FROM user" ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px"  class=" text-center table-striped  table-sm">
            <tr>
            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
            <th>BLOCK_STATUS</th>
            <th>ACTION</th>
          
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td><td>{$row['isblock']}</td>
                <td><button Class='delete-btn' data-id='{$row["userid"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }
    function delete_total_user($id, $data) {
        $sql = "DELETE FROM user WHERE `userid` = {$id}";
        if ($data->query($sql) === true) {
            $output =  1;
        } else {
            $output =  "Error deleting record: " . $data->error;
        }
        return $output;
    }
    function change_admin_password($id, $oldpass, $newpass, $data) {  
        $oldpass = md5($oldpass);
        $newpass = md5($newpass);  
        $sql = "SELECT `password` FROM user WHERE `userid`='$id'";
        $result = $data->query($sql);
        $table_oldpass;
        if ($result->num_rows > 0) {
        // output data of each row  
        while($row = $result->fetch_assoc()) {
        //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $table_oldpass = $row['password'];
        } 
        if($oldpass === $table_oldpass) {
            $sql = "UPDATE `user` SET `password`='$newpass' WHERE `userid`='$id'";
            if ($data->query($sql) === true) {
            $output =  1;
            } else {
            $output =  "Error updating record: " . $data->error;
            }
            return $output;
        } else {
            return "not matched";
        }
    }
        // return $table_oldpass;
    }

    
    function tiles_ride_user_info($id,$data){
        $tiles_data=[];
        $sql = "SELECT * FROM ride WHERE `status`=1";
        $result = $data->query($sql);      
        $total_pending=0;
        $total_pending_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_pending_amount = $row['total_fare'] + $total_pending_amount;
            $total_pending++;
            }
        }
        $sql = "SELECT * FROM ride WHERE `status`=2";
        $result = $data->query($sql);      
        $total_complete=0;
        $total_complete_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_complete_amount = $row['total_fare'] + $total_complete_amount;
            $total_complete++;
            }
        
        } 
        $sql = "SELECT * FROM ride ";
        $result = $data->query($sql);      
        $total_ride=0;
        $total_ride_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_ride_amount = $row['total_fare'] + $total_ride_amount;
            $total_ride++;
            }
        }
        //calculating the detaiols from user tables for tiles
        $sql = "SELECT * FROM user WHERE `isblock`=0";
        $result = $data->query($sql);      
        $total_pending_user=0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_pending_user++;
            }        
        } 
        $sql = "SELECT * FROM user WHERE `isblock`=1";
        $result = $data->query($sql);      
        $total_approved_user=0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_approved_user++;
            }        
        } 
        $sql = "SELECT * FROM user WHERE `isadmin` = 0" ;
        $result = $data->query($sql);      
        $total_user=0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_user++;
            }        
        }
        $tiles_data =array("total_pending"=>$total_pending, "total_pending_amount"=>$total_pending_amount, 
        "total_complete"=>$total_complete, "total_complete_amount"=>$total_complete_amount,
        "total_ride"=>$total_ride, "total_ride_amount"=>$total_ride_amount,
        "total_pending_user"=>$total_pending_user, "total_approved_user"=>$total_approved_user, "total_user"=>$total_user);
        return json_encode($tiles_data);
        
    }

    // code for sort the user table data by name 
    function  short_by_name($data) {
        $output = "";
        $sql = "SELECT * FROM `user` ORDER BY `name` " ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
            <th>BLOCK_STATUS</th>
            <th>ACTION</th>     
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td><td>{$row['isblock']}</td>
                <td><button Class='delete-btn' data-id='{$row["userid"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }
    // sort table by date
    function  short_by_date($data) {
        $output = "";
        $sql = "SELECT * FROM `user` ORDER BY `date_of_signup` " ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
            <th>BLOCK_STATUS</th>
            <th>ACTION</th>     
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td><td>{$row['isblock']}</td>
                <td><button Class='delete-btn' data-id='{$row["userid"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }

    // sort by fare 
    function  short_by_status($data) {
        $output = "";
        $sql = "SELECT * FROM `user` ORDER BY `isblock` " ;
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>            
            <th>USER_ID</th>
            <th>USER_NAME</th>
            <th>NAME</th>
            <th>DATE and TIME</th>
            <th>MOBILE</th>
            <th>BLOCK_STATUS</th>
            <th>ACTION</th>     
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td align='center'>{$row['userid']}</td><td>{$row['user_name']}</td><td>{$row['name']}</td><td>{$row['date_of_signup']}</td>
                <td>{$row['mobile']}</td><td>{$row['isblock']}</td>
                <td><button Class='delete-btn' data-id='{$row["userid"]}'>DELETE</button></td>
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }

    }

// start sorting of rride table 
function  filter_fare($data) {
    $output = "";
    $sql = "SELECT * FROM ride GROUP BY `total_fare`";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>CUSTOMER-ID</th>
        <th>DATE</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>LUGGAGE</th>
        <th>STATUS</th>
        <th>TOTAL-FARE</th>
        <th>DELETE</th>
        
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'>
            <td align='center'>{$row['ride_id']}</td>
            <td>{$row['cust_id']}</td>
            <td>{$row['ride_date']}</td>
            <td>{$row['loc_from']}</td>
            <td>{$row['loc_to']}</td>
            <td>{$row['total_distance']}</td>
            <td>{$row['luggage']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}

// filter by date
function  filter_date($data) {
    $output = "";
    $sql = "SELECT * FROM ride GROUP BY `ride_date`";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>CUSTOMER-ID</th>
        <th>DATE</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>LUGGAGE</th>
        <th>STATUS</th>
        <th>TOTAL-FARE</th>
        <th>DELETE</th>
        
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'>
            <td align='center'>{$row['ride_id']}</td>
            <td>{$row['cust_id']}</td>
            <td>{$row['ride_date']}</td>
            <td>{$row['loc_from']}</td>
            <td>{$row['loc_to']}</td>
            <td>{$row['total_distance']}</td>
            <td>{$row['luggage']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}
//filter by distance
function  filter_distance($data) {
    $output = "";
    $sql = "SELECT * FROM ride GROUP BY `total_distance`";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>CUSTOMER-ID</th>
        <th>DATE</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>LUGGAGE</th>
        <th>STATUS</th>
        <th>TOTAL-FARE</th>
        <th>DELETE</th>
        
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'>
            <td align='center'>{$row['ride_id']}</td>
            <td>{$row['cust_id']}</td>
            <td>{$row['ride_date']}</td>
            <td>{$row['loc_from']}</td>
            <td>{$row['loc_to']}</td>
            <td>{$row['total_distance']}</td>
            <td>{$row['luggage']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}
function  filter_week($data) {
    $output = "";
    $sql = "SELECT *, ride_date FROM ride WHERE ride_date >= DATE(NOW()) - INTERVAL 7 DAY  ORDER BY `ride_date` DESC";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>CUSTOMER-ID</th>
        <th>DATE</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>LUGGAGE</th>
        <th>STATUS</th>
        <th>TOTAL-FARE</th>
        <th>DELETE</th>
        
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'>
            <td align='center'>{$row['ride_id']}</td>
            <td>{$row['cust_id']}</td>
            <td>{$row['ride_date']}</td>
            <td>{$row['loc_from']}</td>
            <td>{$row['loc_to']}</td>
            <td>{$row['total_distance']}</td>
            <td>{$row['luggage']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}
function  filter_month($data) {
    $output = "";
    $sql = "SELECT *, ride_date FROM ride WHERE ride_date >= DATE(NOW()) - INTERVAL 30 DAY  ORDER BY `ride_date` DESC";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>CUSTOMER-ID</th>
        <th>DATE</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>LUGGAGE</th>
        <th>STATUS</th>
        <th>TOTAL-FARE</th>
        <th>DELETE</th>
        
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'>
            <td align='center'>{$row['ride_id']}</td>
            <td>{$row['cust_id']}</td>
            <td>{$row['ride_date']}</td>
            <td>{$row['loc_from']}</td>
            <td>{$row['loc_to']}</td>
            <td>{$row['total_distance']}</td>
            <td>{$row['luggage']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><button Class='delete-btn' data-id='{$row["ride_id"]}'>DELETE</button></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}
function location_search_filter($data, $key) {
    $output = "";
    $sql = "SELECT * FROM `location` WHERE `name` LIKE '%$key%'";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>LOCATION</th>
        <th>DISTANCE</th>
        <th>AVALIBILITY</th>
        <th>ACTION</th>
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'><td align='center'>{$row['location_id']}</td><td>{$row['name']}</td><td>{$row['distance']}</td><td>{$row['isavailable']}</td><td><button class='edit-btn' data-eid='{$row["location_id"]}'>Edit</button>&nbsp;&nbsp;&nbsp<button Class='delete-btn' data-id='{$row["location_id"]}'>DELETE</button></td></tr> ";
        }
        $output .= '</table>';
        return $output;
    } else {
        return "Records not found";
    }
}
// sortest code of sorting in whole project 
function sort_location($data, $key) {
    $output = "";
    $sql = "SELECT * FROM `location` ORDER BY `$key` ";
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th width="60px">ID</th>
        <th>LOCATION</th>
        <th>DISTANCE</th>
        <th>AVALIBILITY</th>
        <th>ACTION</th>
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'><td align='center'>{$row['location_id']}</td><td>{$row['name']}</td><td>{$row['distance']}</td><td>{$row['isavailable']}</td><td><button class='edit-btn' data-eid='{$row["location_id"]}'>Edit</button>&nbsp;&nbsp;&nbsp<button Class='delete-btn' data-id='{$row["location_id"]}'>DELETE</button></td></tr> ";
        }
        $output .= '</table>';
        return $output;
    } else {
        return "Records not found";
    } 
}

function approved_sort($data, $key) {
    $output = "";
        $sql = "SELECT * FROM ride WHERE `status` = 1 ORDER BY `$key`";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {
            $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
            <tr>
            <th>DATE</th>
            <th width="60px">ID</th>
           
            <th>PICKUP</th>
            <th>DESTINATION</th>
            <th>DISTANCE</th>
            <th>CURRENT STATUS</th>
            <th>FARE</th>
      
            </tr>';
            while ($row = $result->fetch_assoc()){
                $output.= "<tr align='center' height='40px'><td>{$row['ride_date']}</td><td align='center'>{$row['ride_id']}</td><td>{$row['loc_from']}</td><td>{$row['loc_to']}</td><td>{$row['total_distance']}</td>
                <td>{$row['status']}</td>
                <td>{$row['total_fare']}</td>
               
                </tr> ";
            }
            $output.= '</table>';
            return $output;
        } else {
            echo "Records not found";
        }
}
function request_ride_sort( $data,$key){
    $output = "";
    $sql = "SELECT * FROM ride WHERE `status` = 1 ORDER BY `$key` DESC" ;
    $result = $data->query($sql);
    if ($result->num_rows > 0) {
        $output.= '<table border="1" width="100%" cellspacing="0" cellpadding ="10px">
        <tr>
        <th>DATE</th>
        <th width="60px">ID</th>
        <th>PICKUP</th>
        <th>DESTINATION</th>
        <th>DISTANCE</th>
        <th>CURRENT STATUS</th>
        <th>FARE</th>
        <th>CHANGE STATUS</th>
  
        </tr>';
        while ($row = $result->fetch_assoc()){
            $output.= "<tr align='center' height='40px'><td align='center'>{$row['ride_date']}</td><td align='center'>{$row['ride_id']}</td><td>{$row['loc_from']}</td><td>{$row['loc_to']}</td><td>{$row['total_distance']}</td>
            <td>{$row['status']}</td>
            <td>{$row['total_fare']}</td>
            <td><select name='change_status' id='change_status' data-eid='{$row["ride_id"]}'>
            <option value='2'>APPROVE - 2</option>
            <option value='3'>CANCEL - 3</option>          
            </select></td>
            </tr> ";
        }
        $output.= '</table>';
        return $output;
    } else {
        echo "Records not found";
    }
}

}
?>