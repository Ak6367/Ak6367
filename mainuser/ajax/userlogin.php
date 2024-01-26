<?php 
require('../../global.php');
$status = 0;
$msg = '';
$errormsg = array();
    if(empty($_POST['email'])){                                             
        $status = 1;
        $errormsg['error_email'] = "Please Enter Your Email Address";  
    }
    if(empty($_POST['password'])){
        $status = 1;
        $errormsg['error_password'] = "Please Enter Your Email Address";  
    }
    if($status == 0){
       
        $checkuser = $conn->query("select * from users where email = '".$_POST['email']."' && password = '".md5($_POST['password'])."' && type = 'backend'");
        // console.log($checkuser);
        //print_r($checkuser);die;
        if($checkuser->num_rows > 0){
            $getdata = $checkuser->fetch_assoc();
            // print_r($getdata['status']);die;
           if($getdata['status'] == 1){
            $_SESSION['islogin'] = 1;
            $_SESSION['usertype'] = 'backend';
            $_SESSION['userdata'] = $getdata;
            $_SESSION['success_msg'] = "Login Successfully";
           }else{
            $status = 1;
            $errormsg['error_email'] = "Currntly Your Accont Not Active";
           }
        }else{
            $status = 1;
            $errormsg['error_email'] = "Invalid Login Details";
        }
    }
    $res['status'] = $status;
    $res['resmsg'] = $errormsg;
    echo json_encode($res);exit;
?>