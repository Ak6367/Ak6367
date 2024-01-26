<?php
include('global.php');
// print_r($_SESSION);
if (!isset($_SESSION['islogin']) || $_SESSION['islogin']!=2 || $_SESSION['usertype'] != 'fronted') {
    header("location:" . SITEURL . 'login.php');
}
    $cartitem = $conn->query("select * from carts where user_id='".$_SESSION['user_id']."' order by carts.id desc");
        if($cartitem->num_rows<1){
            header("location:".SITEURL);
        }
$pagename = "Checkout";
$isinculeglobal = 0;
// prd($_POST);die;
// prd($_GET);die;

$iserror = 0;
if (isset($_POST['first_name'])) {
    if (empty(trim($_POST['first_name']))) {
        $iserror = 1;
        $fnameerr = ucwords('please enter your first name');
    }
    if (empty(trim($_POST['country_id']))) {
        $iserror = 1;
        $countryerr = ucwords('please select your country');
    }
    if (empty(trim($_POST['state_id']))) {
        $iserror = 1;
        $stateerr = ucwords('please select your state');
    }
    if (empty(trim($_POST['city']))) {
        $iserror = 1;
        $cityerr = ucwords('please select your city');
    }
    if (empty(trim($_POST['area']))) {
        $iserror = 1;
        $areaerr = ucwords('please enter your address');
    }
    if (empty(trim($_POST['pincode']))) {
        $iserror = 1;
        $pinerr = ucwords('please enter your area pincode');
    }
    if (empty(trim($_POST['mobile']))) {
        $iserror = 1;
        $moberr = ucwords('please enter your mobile number');
    }
    if (empty(trim($_POST['email']))) {
        $iserror = 1;
        $emailerr = ucwords('please enter your email address');
    }
    if ($iserror == 0) {
        if(isset($_POST['addressid']) && !empty($_POST['addressid'])){
            $updateQuery = $conn->query("update user_addresses set user_id='" . $_SESSION['user_id'] . "', name = '" . $_POST['first_name'] ."',email='".$_POST['email']."',address='" . $_POST['area'] . "',mobile='" . $_POST['mobile'] . "',land_mark='" . $_POST['address_type'] . "',country_id='" . $_POST['country_id'] . "',state_id='" . $_POST['state_id'] . "',city_id='" . $_POST['city'] . "', pincode='" . $_POST['pincode'] . "', created_at='" . date('Y-m-d H:i:s') . "' where id='".$_POST['addressid']."'");
            if ($updateQuery) {
            header("location:" . SITEURL . 'checkout.php');
        }
        }else{
           $insetQuery = $conn->query("insert into user_addresses set user_id='" . $_SESSION['user_id'] . "', name = '" . $_POST['first_name'] . "',address='" . $_POST['area'] . "',mobile='" . $_POST['mobile'] . "',land_mark='" . $_POST['address_type'] . "',country_id='" . $_POST['country_id'] . "',state_id='" . $_POST['state_id'] . "',city_id='" . $_POST['city'] . "', pincode='" . $_POST['pincode'] . "', created_at='" . date('Y-m-d H:i:s') . "' "); 
           if ($insetQuery) {
            header("location:" . SITEURL . 'checkout.php');
        }
        }
        
    }
}
    if(isset($_GET['type']) && $_GET['type'] == 1){
            $deleteQuery = $conn->query("update user_addresses set dstatus = 1 where id='".$_GET['addressid']."'");
        }
$getuser_Sql = $conn->query("select * from users where id = '" . $_SESSION['user_id'] . "' ");
$getUserInfo = $getuser_Sql->fetch_object();
// prd($getUserInfo);
$fname = $getUserInfo->name;
$mobile = $getUserInfo->mobile_no;
$user_email = $getUserInfo->email;


//prd($fetchuseraddress);
include('partial/header.php');
?>

<div class="content">
    <section class="breadcrumb-option">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad-70">
        <div class="container">
            <div class="checkout__form">


                <div class="row ">
                    <div class="col-lg-8 col-md-6">
                        <?php
                        $user_add_Query = $conn->query("select * from user_addresses where user_id = '" . $_SESSION['user_id'] . "' && status=1 && dstatus=0");
                        if($user_add_Query->num_rows > 0){
                        while($fetchuseraddress = $user_add_Query->fetch_assoc()){
                            //prd($fetchuseraddress);
                        $stateQuery = $conn->query("select name from state where id = '".$fetchuseraddress['state_id']."' ");
                        $fetchState = $stateQuery->fetch_assoc();
                        $countryQuery = $conn->query("select name from country where id = '".$fetchuseraddress['country_id']."' ");
                        $fetchCountry = $countryQuery->fetch_assoc();
                        $cityQuery = $conn->query("select name from city where id = '".$fetchuseraddress['city_id']."' ");
                        $fetchCity = $cityQuery->fetch_assoc();
                        $u_a_id = $fetchuseraddress['id']; 

                        $shipping_Query = $conn->query("select amount from shippings where pincode='".$fetchuseraddress['pincode']."'");
                                $shipchr = 0;
                                if($shipping_Query->num_rows > 0){
                                    $fetchshipping = $shipping_Query->fetch_assoc();
                                    $shipchr = $fetchshipping['amount'];  
                                }else{
                                   $shipchr = 0;
                                }

                        ?>
                        <div class="row addressmain mt-2">
                            <div class="col-md-8">
                                <input type="hidden" id="shipping_charges_<?php echo $fetchuseraddress['id'];?>" value="<?php echo $shipchr; ?>">
                                <input type="radio" name="addressid" onchange="shippingcharge(this.value);" value="<?php echo $fetchuseraddress['id'];?>">
                                <strong><?php echo $fetchuseraddress['name'];?></strong>
                                <p><?php echo $fetchuseraddress['address'];?>,<?php echo $fetchuseraddress['land_mark'];?></p>
                                <p><?php echo $fetchCountry['name'];?>/<?php echo $fetchState['name'];?>/<?php echo $fetchCity['name'];?>, <?php echo $fetchuseraddress['pincode'];?></p>
                                <p><?php echo $fetchuseraddress['mobile'];?></p>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo SITEURL; ?>checkout.php?addressid=<?php echo $u_a_id; ?>" class="btn btn-success mt-5">Edit</a>
                                <a href="<?php echo SITEURL; ?>checkout.php?addressid=<?php echo $u_a_id; ?>&type=1" class="btn btn-danger mt-5">Delete</a>
                            </div>
                        </div>
                   <?php }
                    }
                    ?>
                        <?php 
                        if(isset($_GET['addressid'])){
                            $user_address_Query = $conn->query("select * from user_addresses where id='".$_GET['addressid']."' && user_id = '" . $_SESSION['user_id'] . "'");
                        
                                $fetchuseraddress = $user_address_Query->fetch_assoc();

                                    }
                        ?>

                        <form action="" class="checkoutForm mt-5" method="post">
                            <input type="hidden" name="addressid" value="<?php echo isset($_GET['addressid'])?$_GET['addressid']:0?>">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input type="text" class="form-control" name="first_name" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['name'];
                                        }else{
                                            echo isset($_POST['first_name'] ) ? $_POST['first_name'] : $fname;
                                        } ?>">
                                    </div>
                                    <p class="error">
                                        <?php echo isset($fnameerr) ? $fnameerr : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <select class="form-select custome-form-select countrySelect" id="validationCustom04" name="country_id" onchange="getstate(this.value);" style="display: none;">
                                    <option selected="" value="">Choose...</option>
                                    <?php
                                    $getCountry = $conn->query("select name, id from country where dstatus=0 && status=1");
                                    while ($getCountrydata = $getCountry->fetch_assoc()) {
                                        $select = '';
                                        if ((isset($_POST['country_id']) && $_POST['country_id'] == $getCountrydata["id"]) || (isset($fetchuseraddress['country_id']) && $fetchuseraddress['country_id']==$getCountrydata["id"]) ){
                                            $select = 'selected';
                                        }
                                        echo '<option value="' . $getCountrydata["id"] . '" ' . $select . ' >' . $getCountrydata["name"] . '</option>';
                                    }

                                    ?>
                                </select>
                               
                                <p class="error">
                                    <?php echo isset($countryerr) ? $countryerr : ''; ?>
                                </p>
                            </div>

                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <div class="stateSelectDiv">
                                    <select class="form-select custome-form-select stateSelect" onchange="getcity(this.value);" id="State" name="state_id" style="display: none;">
                                        <option selected="" value="">Choose...</option>
                                    </select>
                                    
                                </div>
                                <p class="error">
                                    <?php echo isset($stateerr) ? $stateerr : ''; ?>
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>

                                <div class="citySelectDiv">
                                    <select class="form-select custome-form-select citySelect" id="city" name="city" style="display: none;">
                                        <option selected="" value="">Choose...</option>
                                        
                                    </select>
                                </div>
                                <p class="error">
                                    <?php echo isset($cityerr) ? $cityerr : ''; ?>
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="area" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['address'];
                                        }else{
                                            echo isset($_POST['area'] ) ? $_POST['area'] : '';
                                        } ?>">
                                <p class="error">
                                    <?php echo isset($areaerr) ? $areaerr : ''; ?>
                                </p>
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="address_type" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['land_mark'];
                                        }else{
                                            echo isset($_POST['address_type'] ) ? $_POST['address_type'] : '';
                                        } ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" class="form-control" name="pincode" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['pincode'];
                                        }else{
                                            echo isset($_POST['pincode'] ) ? $_POST['pincode'] : '';
                                        } ?>">
                                <p class="error">
                                    <?php echo isset($pinerr) ? $pinerr : ''; ?>
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" class="form-control" name="mobile" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['mobile'];
                                        }else{
                                            echo isset($_POST['mobile']) ? $_POST['mobile'] : $mobile;
                                        } ?>">
                                        <p class="error">
                                            <?php echo isset($moberr) ? $moberr : ''; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" class="form-control" name="email" value="<?php 
                                        if(isset($_GET['addressid'])){ 
                                            echo $fetchuseraddress['email'];
                                        }else{
                                            echo isset($_POST['email']) ? $_POST['email'] : $user_email;
                                        } ?>">
                                    </div>
                                    <p class="error">
                                        <?php echo isset($emailerr) ? $emailerr : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="saveAdress">
                                    Save this information for next time
                                    <input type="checkbox" id="saveAdress" name="by_default" value="1">
                                    <span class="checkmark check-small"></span>
                                </label>
                            </div>

                            <button type="submit" class="btn product__btn signin_btn w-100 save">Save Address</button>
                        </form>
                 
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <form action="<?php echo SITEURL;?>payment.php" id="checkoutform">
                            <input type="hidden" name="addressid" id="selectedaddress" value="0">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>

                            <ul class="checkout__total__products">
                                <?php include('ajax/viewcart.php');?>

                            </ul>

                            <ul class="checkout__total__all">
                                <?php 
                                        $totalamount = 0;
                                        $cartitem = $conn->query("select carts.*,products.name, products.image, products.price from carts left join products on products.id=product_id where user_id='".$_SESSION['user_id']."' order by carts.id desc");
                                        if($cartitem->num_rows > 0){
                                            while($fetch_pro = $cartitem->fetch_assoc()){
                                                $totalamount += $fetch_pro['price']*$fetch_pro['qty'];
                                            //prd($fetch_pro); 
                                             // prd($_SESSION);   
                                            }  
                                        }
                                    ?>
                                <input type="hidden" id="subtotal" value="<?php echo $totalamount; ?>">
                                
                                
                                <li>Subtotal <span id="subtotals"><?php echo displaycurrency($totalamount); ?></span></li>
                                <?php 
                                    $discountamt = 0;
                                    if(isset($_SESSION['coupondata']) && !empty($_SESSION['coupondata'])){

                                       if($_SESSION['coupondata']['type']==1){
                                            $discountamt = $_SESSION['coupondata']['value']*$totalamount/100;

                                       }else{
                                            $discountamt =$_SESSION['coupondata']['value'];
                                            if($_SESSION['coupondata']['value']>$totalamount){
                                                $discountamt = $totalamount;
                                            }
                                       } ?>
                                       <li>Coupon <span id="coupon"><?php echo displaycurrency($discountamt); ?></span></li>
                                  <?php  }
                                    ?>
                                    <input type="hidden" id="couponamount" value="<?php echo $discountamt; ?>">
                                
                                <li>Shipping Charges : <span id="shippingchr">₹0</span></li>
                                <li>Total <span id="total"><?php echo displaycurrency($totalamount-$discountamt); ?></span></li>
                            </ul>
                            <h4 class="order__title">Payment Type</h4>
                            <div class="col-lg-12 col-md-12 mb-5">
                                <input type="radio" name="paymenttype" class="paymenttype" value="1" checked>  Cash on  Delivery
                            </div>
                            
                            <div class="col-lg-12 col-md-12 text-center">
                                <a href="javascript:void(0);" class="primary-btn btn-product btn--animated" onclick="checkisorder();">Place Order</a>
                                <p class="error checkouterr"></p>
                            </div>
                        </div>
                    </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</div>

<!-- Footer Section Begin -->


</div>


<?php include('partial/footer.php'); ?>
<script>
    function getstate(countryid) {
        //alert(countryid);
        $.ajax({
            url: "<?php echo SITEURL; ?>ajax/state.php",
            type: "post",
            data: {
                country_id: countryid
            },
            success: function(response) {
                $('#State').html(response);
                $('#State').niceSelect('update');
            }
        });
    }

    function getcity(stateid) {
        $.ajax({
            url: "<?php echo SITEURL; ?>ajax/getcity.php",
            type: "post",
            data: {
                state_id: stateid
            },
            success: function(response) {
                $('#city').html(response);
                $('#city').niceSelect('update');
            }
        });
    }
    // function shippingcharge(shippingid) {
    //     //alert(shippingid);
    //     $.ajax({
    //         url: "<?php echo SITEURL; ?>ajax/getshipping.php",
    //         type: "post",
    //         data: {
    //             shipping_charge: shippingid
    //         },
    //         success: function(response) {
    //             alert(response);
    //           $('#shipping_charge').html(response); 
    //         }
    //     });
    // }
    function shippingcharge(shippingid) {
        $('#selectedaddress').val(shippingid);
        var shippingcharge = parseFloat($('#shipping_charges_'+shippingid).val());
        var subtotal = parseFloat($('#subtotal').val());
        var coupon = parseFloat($('#couponamount').val());
       // alert(coupon);
        $('#subtotals').html('<?php echo $currencysym; ?>'+subtotal);
        $('#coupon').html('<?php echo $currencysym; ?>'+coupon);
        $('#shippingchr').html('<?php echo $currencysym; ?>'+shippingcharge);
        $('#total').html('<?php echo $currencysym; ?>'+((subtotal+shippingcharge)-coupon));
    }
    function checkisorder(){
        if($('#selectedaddress').val()==0){
            $('.checkouterr').text('Select address to checkout.');
            return false;
        }else{
            $('#checkoutform').submit();
        }

    }
</script>