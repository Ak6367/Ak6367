<?php 
include('global.php');
if (!isset($_SESSION['islogin']) || $_SESSION['islogin']!=2 || $_SESSION['usertype'] != 'fronted') {
	$_SESSION['error_msg'] = "Login to checkout.";
    header("location:" . SITEURL . 'login.php');
}
if(!isset($_GET['addressid']) || empty($_GET['addressid']) || !isset($_GET['paymenttype']) || empty($_GET['paymenttype'])){
	$_SESSION['error_msg'] = "Invalid request.";
	header("location:" . SITEURL);
}

$getaddress= $conn->query("select * from user_addresses where user_id='".$_SESSION['user_id']."' && id='".$_GET['addressid']."'");
if($getaddress->num_rows<1){
	$_SESSION['error_msg'] = "Invalid request.";
	header("location:" . SITEURL);
}
$orderaddress = $getaddress->fetch_assoc();

$shipping_Query = $conn->query("select amount from shippings where pincode='".$orderaddress['pincode']."'");
$shipchr = 0;
if($shipping_Query->num_rows > 0){
    $fetchshipping = $shipping_Query->fetch_assoc();
    $shipchr = $fetchshipping['amount'];  
}else{
   $shipchr = 0;
}

$orderquery = "insert into orders set order_no='".time()."',user_id='".$_SESSION['user_id']."', user_name='".$orderaddress['name']."', country_id='".$orderaddress['country_id']."', state_id='".$orderaddress['state_id']."', city_id='".$orderaddress['city_id']."', address1='".$orderaddress['address']."', address2='".$orderaddress['land_mark']."', pincode='".$orderaddress['pincode']."', phone_no='".$orderaddress['mobile']."', order_net_amount='0', shipping_charges='".$shipchr."', created_at='".date('Y-m-d H:i:s')."', updated_at='".date('Y-m-d H:i:s')."'";
if($conn->query($orderquery)){
	$orderid = $conn->insert_id;
	$cartitem = $conn->query("select carts.*,products.name, products.image, products.price from carts left join products on products.id=product_id where user_id='".$_SESSION['user_id']."' order by carts.id desc");
	$ordermaount = 0;
	while($cartsingle = $cartitem->fetch_assoc()){
		$ordermaount+=$cartsingle['qty']*$cartsingle['price'];
		$conn->query("insert into order_products set order_id='".$orderid."', product_id='".$cartsingle['product_id']."', price='".$cartsingle['price']."', qty='".$cartsingle['qty']."'");
	}

	$discountamt = 0;
    if(isset($_SESSION['coupondata']) && !empty($_SESSION['coupondata'])){
	       if($_SESSION['coupondata']['type']==1){
	            $discountamt = $_SESSION['coupondata']['value']*$ordermaount/100;

	       }else{
	            $discountamt =$_SESSION['coupondata']['value'];
	            if($_SESSION['coupondata']['value']>$ordermaount){
	                $discountamt = $ordermaount;
	            }
	       }

	       $conn->query("insert into order_coupons set order_id='".$orderid."', coupon_code='".$_SESSION['coupondata']['code']."',amount='".$discountamt."'");
    }
    $ordernumber = ORDERPREPIX.$orderid;
    $ordertotal = ($ordermaount+$shipchr)-$discountamt;
    $conn->query("update orders set order_no='".$ordernumber."',order_net_amount='".$ordermaount."',discount_amount='".$discountamt."',order_total='".$ordertotal."' where id='".$orderid."'");
    unset($_SESSION['coupondata']);
    $conn->query("delete from carts where user_id='".$_SESSION['user_id']."'");
    $_SESSION['success_msg'] = "Order successfully placed.";
    header("location:".SITEURL.'ordersuccess.php?ref='.$ordernumber);
}


?>