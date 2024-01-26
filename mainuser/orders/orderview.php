<?php 
  include('../../global.php');
  $pagename = 'Orders';
  $siteQuery = $conn->query("select * from `site_settings` ");
  $fetch_Site = $siteQuery->fetch_assoc();
  $getdata = $conn->query("select * from `orders` where id='".$_GET['id']."'");
  $fetch_pro = $getdata->fetch_assoc();
  if($getdata->num_rows<1){
    header("location:".SITEADMINURL.'orders');
  }
  // prd($_POST);die;
  if(isset($_POST['order']) && $_POST['order'] != '' && isset($_POST['shipping']) && $_POST['shipping'] != '' && isset($_POST['ship_date']) && $_POST['ship_date'] != ''){
    $updateQuery = $conn->query("update orders set order_status='".$_POST['order']."', shipping_status='".$_POST['shipping']."', shipping_date='".$_POST['ship_date']."' where id='".$_GET['id']."' ");
    if($updateQuery){
      header("location:".SITEADMINURL.'orders/orderview.php?id='.$_GET["id"].'');
    }
  }
  include('../include/header.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?php echo SITENAME;?> Inc.
                    <small class="float-right">Date: <?php echo date("Y/m/d"); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
  <?php 
  // prd($fetch_pro);
  //prd($fetch_Site);
   ?>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?php echo $fetch_Site['name'] ?>, Inc.</strong><br>
                    <?php echo $fetch_Site['address'] ?><br>
                    Phone: <?php echo $fetch_Site['contact_no']; ?><br>
                    Email: <?php echo $fetch_Site['email']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $fetch_pro['user_name'];?></strong><br>
                    <?php echo $fetch_pro['address1']; ?><br>
                    <?php echo $fetch_pro['address2']; ?><br>
                    Phone: <?php echo $fetch_pro['phone_no']; ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <b>Invoice #<?php echo $fetch_pro['order_no']; ?></b><br>
                  <br>
                  <b>Order ID:</b> <?php echo $fetch_pro['order_no']; ?><br>
                  <b>Order Status: </b> 
                  <?php
                  $order_status = ''; 
                      if($fetch_pro['order_status'] == 1){
                        $order_status = 'Confirm';
                      }
                      if($fetch_pro['order_status'] == 2){
                        $order_status = 'Pending';
                      }
                      if($fetch_pro['order_status'] == 0){
                        $order_status = 'Cancel';
                      }
                      echo $order_status;
                  ?>
                <br>
                  <b>Shipping Status:</b>
                  <?php
                  $shipping_status = ''; 
                      if($fetch_pro['shipping_status'] == 1){
                        $shipping_status = 'Confirm';
                      }
                      if($fetch_pro['shipping_status'] == 2){
                        $shipping_status = 'Pending';
                      }
                      if($fetch_pro['shipping_status'] == 0){
                        $shipping_status = 'Cancel';
                      }
                      echo $shipping_status;
                  ?>
                </div>
                <div class="col-sm-1 invoice-col text-center">
                  <button type="button" style="margin-left: -79px; margin-top:40px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Update Status
                  </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <form action="" method="post">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="row">
                                      <div class="col-4">
                                        <label>Order Status :</label>
                                      </div>
                                      <div class="col-8">
                                      <select name="order" class="form-control custom-select">
                                        <option value="">Select Order Status</option>
                                        <option value="1" <?php echo isset($fetch_pro['order_status']) && $fetch_pro['order_status'] == 1?'selected':'' ?>>Confirm</option>
                                        <option value="2" <?php echo isset($fetch_pro['order_status']) && $fetch_pro['order_status'] == 2?'selected':'' ?>>Pending</option>
                                        <option value="0" <?php echo isset($fetch_pro['order_status']) && $fetch_pro['order_status'] == 0?'selected':'' ?>>Cancel</option>
                                      </select>
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="row">
                                      <div class="col-4">
                                        <label>Shipping Status :</label>
                                      </div>
                                      <div class="col-8">
                                      <select name="shipping" class="form-control custom-select">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php echo isset($fetch_pro['shipping_status']) && $fetch_pro['shipping_status'] == 1?'selected':'' ?>>Confirm</option>
                                        <option value="2" <?php echo isset($fetch_pro['shipping_status']) && $fetch_pro['shipping_status'] == 2?'selected':'' ?>>Pending</option>
                                        <option value="0" <?php echo isset($fetch_pro['shipping_status']) && $fetch_pro['shipping_status'] == 0?'selected':'' ?>>Cancel</option>
                                      </select>
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="row">
                                      <div class="col-4">
                                        <label>Shipping Date :</label>
                                      </div>
                                      <div class="col-8">
                                      <input type="date" class="form-control" name="ship_date" value="<?php echo isset($_POST['ship_date'])?$_POST['ship_date']:$fetch_pro['shipping_date']; ?>">
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                  <!-- <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Shipping Date</label>
                                      <input type="date" class="form-control" name="date" value="">
                                    </div>
                                  </div> -->
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <!-- <input type="submit" class="btn btn-primary">Save changes</button> -->
                              <input type="submit" name="" class="btn btn-primary" value="Save Changes">
                            </div>
                          </div>

                      </div>
                    </form>
                    </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Serial #</th>
                      <th>Product</th>
                      <th>Image</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $orderproducts = $conn->query("select order_products.*,products.name,products.image from order_products left join products on products.id=order_products.product_id where order_id='".$_GET['id']."'");
                        $count=1;
                        while ($productdata = $orderproducts->fetch_assoc()) {
                      ?>
                    <tr>
                      <td><?=$count++; ?></td>
                      <td><?=$productdata['name']; ?></td>
                      <td>
                        <img src="<?=SITEURL;?>upload/products/<?=$productdata['image'];?>" width="60px" height="80px">
                      </td>
                      <td><?=$productdata['qty']; ?></td>
                      <td><?=$productdata['price']; ?></td>
                      <td><?=displaycurrency($productdata['price']*$productdata['qty']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead"><strong>Discount Amount:</strong></p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <?php 
                    $couponQuery = $conn->query("select * from order_coupons where order_id='".$_GET['id']."' ");
                    if($couponQuery->num_rows>0){
                      $getcoupon = $couponQuery->fetch_assoc();
                      if(isset($getcoupon['coupon_code'])){
                        echo 'Coupon : '.strtoupper($getcoupon['coupon_code']).'<br>';
                      }
                      }else{
                        echo 'No Coupon Code'.'<br>';
                    }
                  ?>
                   Discount : <?=displaycurrency($fetch_pro['discount_amount']); ?>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?=displaycurrency($fetch_pro['order_net_amount']); ?></td>
                      </tr>
                      <tr>
                        <th>Discount Amount</th>
                        <td><?=displaycurrency($fetch_pro['discount_amount']); ?></td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td><?=displaycurrency($fetch_pro['shipping_charges']); ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?=displaycurrency($fetch_pro['order_total']); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php 
  include('../include/footer.php');
  ?>