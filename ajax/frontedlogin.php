<?php
	// print_r($_FILES);
	// print_r($_POST);die;
include('../global.php');
$iserr = 0;
// $msg = '';
$error_msg = array();
		if(empty(trim($_POST['email']))){
            $iserr = 1;
            $error_msg['error_email'] = ucwords('please enter email address');
        }
        if(empty(trim($_POST['password']))){
            $iserr = 1;
           $error_msg['error_password'] = ucwords('please enter password');
        }
        if($iserr == 0){
        	$checkuser = $conn->query("select * from users where email='".$_POST['email']."' && password='".md5($_POST['password'])."' && type = 'fronted' && status = 1 ");
            //prd($checkuser);
            if($checkuser->num_rows>0){
               $getdata = $checkuser->fetch_assoc();
               // prd($getdata);
           		if($getdata['status'] == 1){
                    $_SESSION['user_id'] = $getdata['id'];
		            $_SESSION['islogin'] = 2;
		            $_SESSION['usertype'] = 'fronted';
		            $_SESSION['userdata'] = $getdata;
		            $_SESSION['success_msg'] = "Login Successfully";
		            }else{
			            $iserr = 1;
			            $errormsg['error_email'] = "Currntly Your Accont Not Active";
           			} 
            }else{
            	$iserr = 1;
                $error_msg['error_email'] = ucwords('invalid login details');
            }	
        }
        $responce['iserr'] = $iserr;
        $responce['errormsg'] = $error_msg;
	 	echo json_encode($responce);exit;
?>