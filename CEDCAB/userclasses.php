<?php
session_start();
// include 'Config.php';
// $obj = new Config();
// $data = $obj->Connect();
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
        $sql = "SELECT * FROM user WHERE `user_name` = '" . $user_name . "' AND `password`='" . $password . "'";
        $result = $data->query($sql);
        if ($result->num_rows > 0) {       
            while ($row = $result-> fetch_assoc()) {
                $_SESSION['user'] = array('name'=>$row['user_name'],'id'=>$row['userid'],'your_name'=>$row['name'],'contact'=>$row['mobile']);  
                if ($row['isadmin'] == 0 && $row['isblock']== 1 ) {
                    $rtn = "USER";
                } else if ($row['isadmin'] == 1) {
                    $_SESSION['admin'] = array('admin_name'=>$row['user_name'],'admin_id'=>$row['userid']);
                    $rtn = "ADMIN";
                } else if($row['isblock'] == 0) {
                    $rtn = "WAIT_LOGIN";
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
            $reg_info   = "Error: " . $sql . "<br>" . $data->error;
        }
        return $reg_info;
    }

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
   
}
?>