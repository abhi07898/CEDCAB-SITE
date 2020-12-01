<?php 
include 'Config.php';
session_start();
class rideclasses{
    public $reg_info;
    public function __construct() {
        $obj = new Config();
        $this->data = $obj->Connect();
    }
    public function insert_ride($from,$to,$total_distance, $luggage, $total_fare, $cust_id) {
        $sql = "INSERT INTO ride (`ride_date`,`loc_from`,`loc_to`,`total_distance`,`luggage`,`total_fare`,`cust_id`) VALUES ( NOW(),'$from','$to','$total_distance', '$luggage', '$total_fare','$cust_id')"; 
        if ($this->data->query($sql) === true) {
            $reg_info  = "Inserted";
        } else {
            $reg_info = "Error: " . $sql . "<br>" . $this->data->error;
        }
        return $reg_info;
    }
    public function pending_rides($id) {
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=1";
        $result = $this->data->query($sql);
        $row = [];
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
             $rows[] = $row;
        }
        return json_encode($rows);
        } else {
          return  "0 results";
        }
    }
    public function complete_rides($id) {
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=2";
        $result = $this->data->query($sql);
        $row = [];
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return json_encode($rows);
        } else {
          return  "0 results";
        }
    }
    public function all_rides($id) {
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id'";
        $result = $this->data->query($sql);
        $row = [];
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return json_encode($rows);
        } else {
          return  "0 results";
        }
    }
    public function update_user_info($id, $name, $contact) {
        $sql = "UPDATE `user` SET `name`='$name' , `mobile`='$contact' WHERE `userid`='$id'";

        if ($this->data->query($sql) === true) {
        $output =  "Record updated successfully";
        } else {
        $output =  "Error updating record: " . $$this->data->error;
        }
        return $output;
    }
    function update_user_password($id, $oldpass, $newpass) {  
        $oldpass = md5($oldpass);
        $newpass = md5($newpass);  
        $sql = "SELECT `password` FROM user WHERE `userid`='$id'";
        $result = $this->data->query($sql);
        $table_oldpass;
        if ($result->num_rows > 0) {
        // output data of each row  
        while($row = $result->fetch_assoc()) {
        //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $table_oldpass = $row['password'];
        } 
        if($oldpass === $table_oldpass) {
            $sql = "UPDATE `user` SET `password`='$newpass' WHERE `userid`='$id'";
            if ($this->data->query($sql) === true) {
            $output =  1;
            } else {
            $output =  "Error updating record: " . $$this->data->error;
            }
            return $output;
        } else {
            return "not matched";
        }
    }
        // return $table_oldpass;
    }
    function tiles_ride_info($id){
        $tiles_data=[];
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=1";
        $result = $this->data->query($sql);      
        $total_pending=0;
        $total_pending_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_pending_amount = $row['total_fare'] + $total_pending_amount;
            $total_pending++;
            }
        }
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=2";
        $result = $this->data->query($sql);      
        $total_complete=0;
        $total_complete_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_complete_amount = $row['total_fare'] + $total_complete_amount;
            $total_complete++;
            }
        
        } 
        $sql = "SELECT * FROM ride WHERE `cust_id`='$id'";
        $result = $this->data->query($sql);      
        $total_ride=0;
        $total_ride_amount = 0;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $total_ride_amount = $row['total_fare'] + $total_ride_amount;
            $total_ride++;
            }
        } 
        $tiles_data =array("total_pending"=>$total_pending, "total_pending_amount"=>$total_pending_amount, 
        "total_complete"=>$total_complete, "total_complete_amount"=>$total_complete_amount,
        "total_ride"=>$total_ride, "total_ride_amount"=>$total_ride_amount);
        return json_encode($tiles_data);
        
    }
    public function sort_fare($id) {
      $sql = "SELECT * FROM `ride` WHERE `cust_id`='$id' ORDER BY `total_fare` ";
      $result = $this->data->query($sql);
      $row = [];
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $rows[] = $row;
      }
      return json_encode($rows);
      } else {
        return  "0 results";
      }
    }
  public function sort_date($id) {
    $sql = "SELECT * FROM `ride` WHERE `cust_id`='$id' ORDER BY `ride_date` ";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
  }
  public function sort_distance($id) {
    $sql = "SELECT * FROM `ride` WHERE `cust_id`='$id' ORDER BY `total_distance` ";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
  }
  public function sort_status($id) {
    $sql = "SELECT * FROM `ride` WHERE `cust_id`='$id' ORDER BY `status` ";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
  }
  function filter_week($id) {
    $sql = "SELECT *, ride_date FROM ride WHERE ride_date >= DATE(NOW()) - INTERVAL 7 DAY AND `cust_id` = '$id' ORDER BY `ride_date` DESC";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
  }
  function filter_month($id) {
    $sql = "SELECT *, ride_date FROM ride WHERE ride_date >= DATE(NOW()) - INTERVAL 7 DAY AND `cust_id` = '$id' ORDER BY `ride_date` DESC";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
  }
  public function pend_ride_sort($id,$key) {
    $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=1 ORDER BY `$key` DESC ";
    $result = $this->data->query($sql);
    $row = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         $rows[] = $row;
    }
    return json_encode($rows);
    } else {
      return  "0 results";
    }
}

public function comp_ride_sort($id,$key) {
  $sql = "SELECT * FROM ride WHERE `cust_id`='$id' AND `status`=1 ORDER BY `$key` DESC ";
  $result = $this->data->query($sql);
  $row = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $rows[] = $row;
  }
  return json_encode($rows);
  } else {
    return  "0 results";
  }
}
public function invoice($id) {
  $sql = "SELECT * FROM ride WHERE `ride_id`='$id'";
  $result = $this->data->query($sql);
  $row = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }
  return json_encode($rows);
  } else {
    return  "0 results";
  }
}
}
?>