<?php 
	include('../global.php');
	// prd($_POST);
	$userid = $_SESSION['user_id'];
	$pro_id = $_POST['product_id'];
	$image = '';
	$status = '';
	$wishlistcount = '';
	$img = '';
	$checkwhis = $conn->query("select * from whishlist where user_id='".$userid."' && product_id='".$pro_id."' ");
	if($checkwhis->num_rows > 0){
		$delete = $conn->query("delete from whishlist where user_id='".$userid."' && product_id='".$pro_id."' ");
		$status = 'remove';
		$image = SITEURL.'assets/back/html/img/icon/heart.png' ;
	}else{
		$insert_whis = $conn->query("insert into whishlist set user_id='".$userid."', product_id='".$pro_id."' ");
		$status = 'add_whish';
		$image = SITEURL.'assets/back/html/img/icon/heartfill.png' ;
	}
	$count = $conn->query("select * from whishlist where user_id='".$userid."'");
	$wishlistcount = $count->num_rows;
	$responce['status'] = $status;
	$responce['wishlistcount'] = $wishlistcount;
	$responce['imghtml'] = $image;
	echo json_encode($responce);exit;
?>