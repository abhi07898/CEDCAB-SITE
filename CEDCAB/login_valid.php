<?php
include 'userclasses.php';
include 'Config.php';
$obj = new Config();
$data  = $obj->Connect();
//echo $data;
$username_err = $password_err = $incorrect= '';
$username = $password = '';
if (isset($_POST ['login'])) {
    if (empty($_POST['username'])) {
        $username_err = "Required Field";
    } else {
        $username = $_POST['username'];
    }
    if (empty($_POST['password'])) {
        $password_err = "Required Field";
    } else {
        $password = $_POST['password'];
        $encpassword = md5($password);
    }
    if ($username_err=='' and $password_err == '') {
        $obj = new userclasses();
        $data = $obj->login($username, $encpassword, $data);
        if ($data == 'USER') {
            header('location:user_dashboard.php');
            if(!empty($_POST['remember'])) {
                setcookie("user", $username, time()+(10*365*24*60*60));
                setcookie("pass", $password, time()+(10*365*24*60*60));
            } else {
                if(isset($_COOKIE['user'])) {
                    setcookie("user","");
                }
                if(isset($_COOKIE['pass'])) {
                    setcookie('pass',"");
                }
            }
        } 
        if($data == 'ADMIN') {
            header('location:ADMIN/admin_home.php');
        }
        if($data == 'WAIT_LOGIN'){
            header('location:loginwait.php');
        } else {
            $incorrect="Wrong User Name or Password";
        }
    }    
} 
?>
