<?php
include 'Config.php';
class locationclass {
    public $location_id;
    public $name;
    public $distance;
    public $isavailable;
    public function __construct() {
        $obj = new Config();
        $this->data = $obj->Connect();
    }
    public function createarray() {
        $destpick = [];
        $sql = "SELECT * from `location` WHERE `isavailable` = 0 ";
        $result = $this->data->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $destpick+= array($row['name']=>$row['distance']);
        }
        return $destpick;
        } else {
        echo "0 results";
        }
    }
    public function for_pickup_location(){
        $option='';
        $sql = "SELECT * from `location` WHERE `isavailable` = 0 ";
        $result = $this->data->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $option.= '<option value="'.$row['name'].'">' .$row['name'] .' </option>';
        }
        return $option;
        } else {
        echo "0 results";
        }
    }
    public function for_drop_location(){
        $option='';
        $sql = "SELECT * from `location` WHERE `isavailable` = 0 ";
        $result = $this->data->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $option.= '<option value="'.$row['name'].'">' .$row['name'] .' </option>';
        }

        return $option;
        } else {
        echo "0 results";
        }
    }
    
}
?>