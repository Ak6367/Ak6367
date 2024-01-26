<?php 
include('../global.php');
// print_r($_POST);
// print_r($_FILES);
$iserror = 1;
$errormsg = array();
	if(empty(trim($_POST['name']))){
		$iserror = 0;
		$errormsg['error_name'] = ucwords('please enter your full name');
	}
	if(empty(trim($_POST['mobile']))){
		$iserror = 0;
		$errormsg['error_mobile'] = ucwords('please enter your full name');
	}
	if(empty(trim($_POST['email']))){
		$iserror = 0;
		$errormsg['error_email'] = ucwords('please enter your full name');
	}
	if(empty(trim($_POST['password']))){
		$iserror = 0;
		$errormsg['error_password'] = ucwords('please enter your full name');
	}

	if(empty($_FILES['profile']['name'])){
		$iserror = 1;
		//$errormsg['error_profile'] = ucwords('please enter your full name');
	}
	else{
		$extension = pathinfo($_FILES['profile']['name'],PATHINFO_EXTENSION);
		// echo $extension;
		if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'webp' && $extension != 'GIF'){
			$iserror = 0;
			$errormsg['error_profile'] = ucwords('profile only allowed jpg,jpeg,png,webp,gif format');
		}
	}
	if($iserror == 1){
		$checkuser = $conn->query("select * from users where email = '".$_POST['email']."' ");
		// prd($checkuser);
		if($checkuser->num_rows > 0){
			$iserror = 0;
			$errormsg['error_email'] = ucwords('Email already taken');
		}else{
			$checknum = $conn->query("select * from users where mobile_no = '".$_POST['mobile']."' ");
			if($checknum->num_rows > 0){
				$iserror = 0;
				$errormsg['error_mobile'] = ucwords('mobile number already taken');
			}else{
				//echo 5665;
				if(empty($_FILES['profile']['name'])){
					$profile = 'userdefault.png';
				}else{
					$profile = '';
					$ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
					$profile_name = 'Profile_pic_'.time().'_'.rand(1,99999999).'.'.$ext;
					//echo $profile_name;die;
					if(move_uploaded_file($_FILES['profile']['tmp_name'], '../upload/user/'.$profile_name)){
					$profile = $profile_name;
				}
				}
				
				$insert_query = $conn->query("INSERT INTO users SET name='".$_POST['name']."', email='".$_POST['email']."', mobile_no='".$_POST['mobile']."', type='fronted', password='".md5($_POST['password'])."', profile_pic='".$profile."', created_at='".date('Y-m-d H:i:s')."' ");
				if($insert_query){
					$last_id = $conn->insert_id;
					$getuserdata = $conn->query("select * from users where id='".$last_id."' ");
					$fetchdata = $getuserdata->fetch_assoc();
					$_SESSION['user_id'] = $last_id;
					$_SESSION['islogin'] = 2;
		            $_SESSION['usertype'] = 'fronted';
		            $_SESSION['userdata'] = $fetchdata;
		            $_SESSION['success_msg'] = "WELCOME ! Register successfully";
				}
			}
		}
	}
	$responce['iserror'] = $iserror;
	$responce['errormsg'] = $errormsg;
	echo json_encode($responce);exit;

?>