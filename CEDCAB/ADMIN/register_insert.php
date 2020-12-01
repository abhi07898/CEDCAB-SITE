<?php
include 'userclasses.php';
include 'Config.php';
$obj = new Config();
$data = $obj->Connect();
$username_err = $name_err = $password_err = $repassword_err= $not_match = $mobile_err = '' ;
$username =  $name = $password = $repassword = $correct = $incorrect= $mobile = '';
if (isset($_POST ['register'])) {
    if (empty($_POST['username'])) {
        $username_err = "Required Field";
    } else {
        $username = $_POST['username'];
    }
    if (empty($_POST['name'])) {
        $name_err = "Required Field";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['password'])) {
        $password_err = "Required Field";
    } else {
        $password = $_POST['password'];
    }
    if (empty($_POST['repassword'])) {
        $repassword_err = "Required Field";
    } else {
        $repassword = $_POST['repassword'];
    }
    if ($password!=$repassword) {
        $not_match = "Password does not same as previous";
    } else {
        $repassword = md5($repassword);
    }
    if (empty($_POST['mobile'])) {
        $mobile_err = "Required Field";
    } else {
        $mobile = $_POST['mobile'];
    }
    if ($username_err=='' and $password_err == '' and $name_err == '' and $repassword_err=='' and $not_match =='' and $mobile_err == '') {
        $objclass = new userclasses();
        $output_data = $objclass->register($username, $name, $mobile, $repassword, $data);
        if ($output_data == "Inserted" ) {
            header('location:login.php');
        } else {
            header('location:registerpage.php');
        }
        
    } 
        $data->close();   
} 
?>