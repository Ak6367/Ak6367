<?php
  include('../global.php');
  $pagename = 'My Order';
  include('../partial/account-sidebar.php');
  ?> 

    <div class="col-sm-12 mt-4 mt-md-0 col-md-12 col-lg-9">
              <div class="tab-content account-tabs" id="v-pills-tabContent">
                <div class="tab-pane fade show active order-details-section" id="v-pills-profile">
                  <div class="heading-box text-left">
                    <h5>My Orders</h5>
                  </div>
                  <?php 
                    $ordersQuery = $conn->query("select id,shipping_date,order_no,created_at,order_status from orders where user_id='".$_SESSION['user_id']."' && dstatus=0 order by id desc ");
                     if($ordersQuery->num_rows > 0){ 
                     while($fetch_orders = $ordersQuery->fetch_assoc()){
                      // prd($fetch_orders);
                  ?>
                  <section id="allOrder" style="margin-top: 10px;">
                    <div class="current-order-wrapper">
                      <div class="current-order-header">
                        <div class="current-order-header-wrap">

                          <div class="row">
                                <div class="col-md-6 text-left">
                                    <h4 class="text-left">Order Date:</h4>
                                    <p><?php echo $fetch_orders['created_at']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-left">Order status:</h4>
                                    <?php
                                      $order_status = '';
                                        if($fetch_orders['order_status'] == 1){
                                          $order_status = 'Confirm';
                                        }else{
                                          $order_status = 'Pending';
                                        }
                                     ?>
                                     <p><?php echo $order_status; ?></p>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="order-details-wrapper">
                        <?php 
                        if($fetch_orders['shipping_date'] == ''){?>
                          <h4 class="order-status text-left">Not Delivered</h4>
                        <?php }else{?>
                        <h4 class="order-status text-left">Delivered <?= $fetch_orders['shipping_date']; ?></h4> 
                      <?php } ?>
                        <?php 
                            $productQuery = $conn->query("select order_products.*,products.name as pro_name,products.image from order_products left join products on order_products.product_id=products.id where order_id='".$fetch_orders['id']."'");
                          $fetchproducts = $productQuery->fetch_assoc();
                            // prd($fetchproducts);
                           
                          ?>
                        <div class="d-flex flex-wrap justify-content-between">
                          <div class="order-item-details p-0 mb-5">
                            <div class="order-item-details-wrap d-flex">
                              <div class="order-item-img"><img src="<?php echo SITEURL;?>upload/products/<?php echo $fetchproducts['image']; ?>" style="height: 100px!important;">
                              </div>
                              <div class="order-item-desc d-flex flex-column">
                                <a href="<?php echo SITEURL; ?>product.php?ref=<?php echo base64_encode($fetchproducts['product_id']); ?>"><?php echo $fetchproducts['pro_name']; ?></a>
                                <div class="buy-again">
                                  <a href="<?php echo SITEURL; ?>product.php?ref=<?php echo base64_encode($fetchproducts['product_id']); ?>"><span>Buy it again</span></a>
                                </div>                                    
                              </div>
                            </div>
                          </div>
                          <div class="order-items-btn p-0">
                            <div class="order-items-btn-wrap">
                              <div class="d-flex justify-content-center"><a class="order-btn" href="<?php echo SITEURL; ?>ordersuccess.php?ref=<?php echo $fetch_orders['order_no'] ?>"><span>View order details</span></a></div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </section>
                  <?php } 
                  }else{ ?>
                    <section id="allOrder" style="margin-top: 10px;">
                    <div class="current-order-wrapper">
                      <div class="current-order-header">
                        <div class="current-order-header-wrap">
                          <h4>You Don't Have A Order</h4>
                        </div>
                      </div>
                      
                      
                    </div>
                  </section>
                 <?php } ?>
                </div>
              </div>
            </div>
          
   <?php include('../partial/account-sidebar-footer.php'); ?>          