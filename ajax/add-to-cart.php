<?php
	include('../global.php');
	// print_r($_POST);
	// print_r($_SESSION);
	$status = '';
	$wishlist = '';
	$productid = $_POST['product_id'];
	$userid =$_SESSION['user_id'];
	$checkQuery = $conn->query("select * from carts where user_id = '".$userid."' && product_id = '".$productid."'");
	// prd($checkQuery);
	if($checkQuery->num_rows > 0){
		$fetchdata = $checkQuery->fetch_assoc();
		$qty = $fetchdata['qty'];
		$updatecart = $conn->query("update carts set qty='".($qty+1)."' where user_id = '".$userid."' &&  product_id = '".$productid."' ");
		$status = 'success';
	}else{
		$insertcart = $conn->query("insert into carts set user_id='".$userid."', product_id = '".$productid."', qty= 1 ");
		$status = 'success';
	}
	if(isset($_POST['wishlist']) && !empty($_POST['wishlist']) && $_POST['wishlist']==1){
		$wishdelete = $conn->query("DELETE FROM `whishlist` WHERE product_id='".$productid."' && user_id = '".$userid."'");
		$status = 'success';
	}

	$getcarsum =$conn->query("select sum(qty) as totalcartqty from carts where user_id = '".$userid."'");
		$fetchdata = $getcarsum->fetch_assoc();
		$totalqty = $fetchdata['totalcartqty']; 
	$varhtml = file_get_contents(SITEURL."ajax/viewcart.php?user_id=".$userid);
	
	 //$url = SITEURL."ajax/viewcart.php?user_id=".$userid;   
	// $ch = curl_init();   
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
	// curl_setopt($ch, CURLOPT_URL, $url);   
	// $varhtml = curl_exec($ch);   
	



	$res['status'] = $status;
	$res['html'] = $varhtml;
	$res['totalqty'] = $totalqty;
	echo json_encode($res);exit;
	//echo 1;exit;
?>

 	