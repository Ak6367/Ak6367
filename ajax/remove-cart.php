<?php 
	include("../global.php");
	$status = '';
	$type = '';
	$removecartQuery=$conn->query("delete from carts where id='".$_POST['cart_id']."' ");
	if($removecartQuery){
		//$status = 'success';
		$type = 'remove';
	}else{
		$status = '';
		$type = '';
	}
	$getcarsum =$conn->query("select sum(qty) as totalcartqty from carts where user_id = '".$_SESSION['user_id']."'");
	$fetchdata = $getcarsum->fetch_assoc();
	if($fetchdata['totalcartqty'] == 0){
		$totalqty=0;
	}else{
		$totalqty = $fetchdata['totalcartqty']; 
	}
	$res['type'] = $type;
	$res['totalqty'] = $totalqty;
	echo json_encode($res);exit;

?>