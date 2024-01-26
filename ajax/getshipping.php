<?php
	include('../global.php');
	if(!empty($_POST['shipping_charge'])){
		$shipping = $conn->query("select shippings.*, user_addresses.pincode from shippings left join user_addresses on shippings.pincode=user_addresses.pincode  where user_addresses.id = '".$_POST['shipping_charge']."' && user_id='".$_SESSION['user_id']."'");
		// prd($shipping);
		if($shipping->num_rows > 0){
			$fetch_shipping_charge = $shipping->fetch_assoc();
		// prd($fetch_shipping_charge);
		$shipping_amount = displaycurrency($fetch_shipping_charge['amount']);
	}else{
		$shipping_amount = 'No Shipping Charge'; 
	}
	echo $shipping_amount;exit;
 	}
 ?>
