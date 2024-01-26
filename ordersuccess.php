  <?php
    include('global.php');
    if (!isset($_SESSION['islogin']) || $_SESSION['islogin']!=2 || $_SESSION['usertype'] != 'fronted') {
      $_SESSION['error_msg'] = "Invalid Request.";
      header("location:" . SITEURL . 'login.php');
    }
    if(!isset($_GET['ref'])){
       $_SESSION['error_msg'] = "Invalid Request.";
      header("location:" . SITEURL);
    }
   $ordersQuery = $conn->query("select orders.*,country.name as countryname,state.name as statename,city.name as cityname from orders left join country on orders.country_id=country.id left join state on orders.state_id=state.id left join city on orders.city_id=city.id where order_no = '".$_GET['ref']."' && user_id='".$_SESSION['user_id']."' order by id desc ");
   if($ordersQuery->num_rows > 0){
   $fetchorders = $ordersQuery->fetch_assoc();
  // prd($fetchorders['id']);die;
   }

   $productdaital = $conn->query("select order_products.*,products.name,products.image from order_products left join products on products.id=order_products.product_id where order_id='".$fetchorders['id']."'");
   // prd($productdaital);die;
   while ($fecthorder = $productdaital->fetch_assoc()) {
    // prd($fecthorder);die;
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
                <h4>Your Order</h4>
                <div class="breadcrumb__links">
                  <a href="./index.html">Home</a>
                  <span>Orders</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Breadcrumb Section End -->
      <section class="my-account spad-70">
        <div class="container">
          <div class="row">
            <!--  -->
          
              <div class="tab-content account-tabs" id="v-pills-tabContent">
                <div class="tab-pane fade show active order-details-section" id="v-pills-profile">
                  <div class="heading-box text-left">
                    <h5>Your Orders</h5>
                  </div>
                  <section id="allOrder">
                    <div class="current-order-wrapper">
                      <div class="current-order-header">
                        <div class="current-order-header-wrap">
                          <div class="row">
                                <div class="col-md-6 text-left">
                                    <h4 class="text-left">Ship TO:</h4>
                                    <p><?php echo $fetchorders['user_name']; ?></p>
                                    <p><?php echo $fetchorders['address1']; ?>, <?php echo $fetchorders['address2']; ?></p>
                                    <p><?php echo $fetchorders['cityname'] ?> / <?php echo $fetchorders['statename'] ?> / <?php echo $fetchorders['countryname'] ?> , <?php echo $fetchorders['pincode']; ?></p>
                                    <p><?php echo $fetchorders['phone_no']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-left">Order Detials:</h4>
                                    <p><strong>Order Number : </strong><?php echo $fetchorders['order_no']; ?></p>
                                    <?php 
                                      $order_status = '';
                                      if($fetchorders['order_status'] == 1){
                                        $order_status = 'Confirm';
                                      }else{
                                        $order_status = 'Pending';
                                      }
                                      ?>
                                    <p><strong>Order Status : </strong><?php echo $order_status; ?></p>
                                    <?php 
                                      $shipping_status = '';
                                      if($fetchorders['shipping_status'] == 1){
                                        $shipping_status = 'Confirm';
                                      }else{
                                        $shipping_status = 'Pending';
                                      }
                                      ?>
                                    <p><strong>Shipping Status : </strong><?php echo $shipping_status; ?></p>
                                    <p><strong>Delivery Date : </strong><?php echo $fetchorders['shipping_date']; ?></p>
                                    
                                </div>
                                
                            </div>
                        </div>
                      </div>
                      <div class="order-details-wrapper">
                        <h4 class="order-status text-left">Delivered 07-Oct-2022</h4> 
                          <?php 
                            $productQuery = $conn->query("select order_products.*,products.name,products.image from order_products left join products on order_products.product_id=products.id where order_id='".$fetchorders['id']."'");
                            $pro_qty = '';
                            $c = '';
                           while($fetchproducts = $productQuery->fetch_assoc()){
                            // prd($fetchproducts);
                            $pro_qty = $fetchproducts['qty'];
                            $price = $fetchproducts['price'];
                           
                          ?>
                        <div class="d-flex flex-wrap justify-content-between mb-5">
                          <div class="order-item-details p-0">
                            <div class="order-item-details-wrap d-flex">
                              <div class="order-item-img"><img src="<?php echo SITEURL; ?>upload/products/<?php echo $fetchproducts['image']; ?>">
                              </div>
                              <div class="order-item-desc d-flex flex-column">
                                <a href="<?php echo SITEURL; ?>product.php?ref=<?php echo base64_encode($fetchproducts['product_id']); ?>"><?php echo $fetchproducts['name']; ?></a>
                                <div class="buy-again">
                                  <a href="<?php echo SITEURL; ?>product.php?ref=<?php echo base64_encode($fetchproducts['product_id']); ?>"><span>Buy it again</span></a>
                                </div>                                    
                              </div>
                            </div>
                          </div>
                          <div class="order-items-btn p-0">
                            <div class="order-items-btn-wrap">
                              <div class="d-flex justify-content-center">Quantity : <?php echo $pro_qty; ?></div>
                              <div class="d-flex justify-content-center">Price : <?php echo displaycurrency($price); ?></div>
                              
                              <div class="d-flex justify-content-center">Total : <?php echo displaycurrency(($pro_qty*$price)); ?></div>
                              
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                      </div>
                      
                    </div>
                  </section>
                </div>
              </div>
            
          </div>
        </div>
      </section>
    </div>
    <?php include('partial/footer.php'); ?>
