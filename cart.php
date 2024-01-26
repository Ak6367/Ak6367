<?php 
    include('global.php');
     if (!isset($_SESSION['islogin']) || $_SESSION['islogin']!=2 || $_SESSION['usertype'] != 'fronted') {
     header("location:".SITEURL.'login.php');
    }
    $pagename = "Cart";
    //prd($_POST);die;
    if(isset($_POST['qty']) && count($_POST['qty'])>0){
        foreach($_POST['qty'] as $cartid=>$cartqty){
            $updatecart = $conn->query("update carts set qty='".$cartqty."' where id='".$cartid."' ");
            if($updatecart){
                header("location:".SITEURL.'cart.php');
            }
        }
    }

    if(isset($_POST['couponcode']) && !empty($_POST['couponcode'])){
        $userids = array(0);
        $userids[] = $_SESSION['user_id'];
     
        $sqlcheck = "select * from coupones where user_id IN(".implode(',',$userids).") && start_date<='".date('Y-m-d')."' && end_date>='".date('Y-m-d')."' && dstatus=0 && code='".trim($_POST['couponcode'])."'";
        $getrec = $conn->query($sqlcheck);
        if($getrec->num_rows>0){
            $_SESSION['coupondata'] = $getrec->fetch_assoc();
        }else{
            $couponerr = "Invalid or Expiered coupon code.";
        }

    }

    //prd($_SESSION);
    $cartitem = $conn->query("select carts.*,products.name, products.image, products.price from carts left join products on products.id=product_id where user_id='".$_SESSION['user_id']."' order by carts.id desc");
   if($cartitem->num_rows<1){
    header("location:".SITEURL);
   }
    
    include('partial/header.php');
?>
        <div class="content">
            <!-- Breadcrumb Section Begin -->
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
                                <h4>Shopping Cart</h4>
                                <div class="breadcrumb__links">
                                    <a href="index-2.html">Home</a>
                                    <a href="shop.html">Shop</a>
                                    <span>Shopping Cart</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Breadcrumb Section End -->

            <!-- Shopping Cart Section Begin -->
            <section class="shopping-cart spad pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="" method="post" id="cartsubmit">
                            <div class="shopping__cart__table">
                                <div class="">
                                    <div class="product-table-header">
                                        <div class="product-table-header-inner">
                                            <div class="pro-header basis-50"><h3>Product</h3></div>
                                            <div class="qty-header basis-20"><h3>Quantity</h3></div>
                                            <div class="total-header basis-20"><h3>Total</h3></div>
                                            <div class="empty-head basis-10"><h3></h3></div>
                                        </div>
                                    </div>
                                    <?php 
                                        $totalamount = 0;
                                        if($cartitem->num_rows > 0){
                                            while($fetch_pro = $cartitem->fetch_assoc()){
                                                $totalamount += $fetch_pro['price']*$fetch_pro['qty'];
                                            //prd($fetch_pro); 
                                             // prd($_SESSION);   

                                    ?>
                                    <div class="product-table-body" id="cartid_<?php echo $fetch_pro['id'];?>">
                                        <div class="product-table-body-inner">
                                            <div class="product__cart__item d-flex align-items-center basis-50">
                                                <div class="product__cart__item__pic" style="width: 150px;">
                                                    <img src="<?php echo SITEURL;?>upload/products/<?php echo $fetch_pro['image']; ?>" />
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6><?php echo $fetch_pro['name'];?></h6>
                                                    <h5><?php echo displaycurrency($fetch_pro['price']); ?></h5>
                                                </div>
                                            </div>
                                            <div class="quantity__item basis-20">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="<?php echo $fetch_pro['qty'];?>" readonly="readonly" name="qty[<?php echo $fetch_pro['id'];?>]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart__price basis-20">
                                                <span><?php echo displaycurrency($fetch_pro['price']*$fetch_pro['qty']); ?></span>                                               
                                            </div>
                                            <div class="cart__close remove_fron_cart_btn basis-10" cart_id="<?php echo $fetch_pro['id'];?>" >
                                                <i class="fa fa-close"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                        }
                                    ?>


                                </div>
                            </form> 
                            </div>
                            
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="continue__btn">
                                        <a href="<?php echo SITEURL;?>">Continue Shopping</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="continue__btn update__btn">
                                        <a class="btn-product btn--animated updatecartbtn" href="javascript:void(0);"><i class="fa fa-spinner"></i>
                                            Update Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cart__discount">
                                <h6>Discount codes</h6>
                                <form action="" method="post">
                                    <input type="text" name="couponcode" placeholder="Coupon code">
                                    <button type="submit">Apply</button>
                                    <p class="error"><?php echo isset($couponerr)?$couponerr:''?></p>
                                </form>
                            </div>
                            <div class="cart__total">
                                <h6>Cart total</h6>
                                <ul>
                                    <li>Subtotal <span><?php echo displaycurrency($totalamount); ?> </span></li>
                                    <?php 
                                    $discountamt = 0;
                                    // prd($_SESSION['coupondata']);
                                    if(isset($_SESSION['coupondata']) && !empty($_SESSION['coupondata'])){

                                       if($_SESSION['coupondata']['type']==1){
                                            $discountamt = $_SESSION['coupondata']['value']*$totalamount/100;

                                       }else{
                                            $discountamt =$_SESSION['coupondata']['value'];
                                            if($_SESSION['coupondata']['value']>$totalamount){
                                                $discountamt = $totalamount;
                                            }
                                       }
                                    ?> 

                                    <li>Coupon (<?php echo $_SESSION['coupondata']['code'];?>) <a href="<?php echo SITEURL;?>removecoupon.php" class="text-danger">X</a><span><?php echo displaycurrency($discountamt); ?> </span></li>
                                    <?php } ?>
                                    <li>Total <span><?php echo displaycurrency($totalamount-$discountamt); ?></span></li>
                                </ul>
                                <a href="<?php echo SITEURL; ?>checkout.php" class="primary-btn btn-product btn--animated">Proceed to
                                    checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Shopping Cart Section End -->

        </div>

        <!-- Footer Section Begin -->
        <?php include("partial/footer.php"); ?>
       
        <!-- Footer Section End -->
       
    


    <script>
        $(document).ready(function () {
            $(document).on('click', '.remove_fron_cart_btn', function () {
                var cart_id = $(this).attr('cart_id');
                $.ajax({
                type: 'POST',
                url: "<?php echo SITEURL;?>ajax/remove-cart.php",
                data: {cart_id: cart_id},
                dataType: "JSON",
                success: function (resultData) {
                    //resultData = JSON.parse(resultData);
                    // alert(resultData.type)
                    if (resultData.type == 'remove') {
                        $('#cartid_'+cart_id).remove();
                        $('.cartcount').html(resultData.totalqty);
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Item Deleted Successfully'
                        })
                    }
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Something went wrong',
                    })
                }
            });
        });
    });
    $('.updatecartbtn').click(function(){
        $('#cartsubmit').submit();
    });
    </script>