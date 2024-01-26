 <?php
 include('../global.php');
  $pagename = 'Account';
  $issubmit = 1;
  if(isset($_POST['name'])){
    //print_r($_POST);die;
    if(empty($_POST['name'])){
      $issubmit = 0;
      $nameerr = ucwords('please enter your name');
    }
    if(empty($_POST['email'])){
      $issubmit = 0;
      $emailerr = ucwords('please enter your email');
    }
    if(empty($_POST['mobile'])){
      $issubmit = 0;
      $moberr = ucwords('please enter your mobile number');
    }
    if($issubmit==1){
      $checkuser = $conn->query("select * from users where email='".$_POST['email']."'");
      if($checkuser->num_rows > 0){
        $emailerr = ucwords('email already taken');
      }else{
        $checkmob = $conn->query("select * from users where mobile_no='".$_POST['mobile']."'");
        if($checkmob->num_rows >0){
          $moberr = ucwords('mobile number already taken');
        }else{
          $updateQuery = $conn->query("update users set name='".$_POST['name']."', email='".$_POST['email']."', mobile_no='".$_POST['mobile']."' where id='".$_SESSION['user_id']."' ");
          if( $updateQuery){
            header("location:".SITEURL.'my-account');
          }
        }
      }
    }
  }
  include('../partial/account-sidebar.php');
  ?>   

          <div class="col-sm-12 mt-4 mt-md-0 col-md-7 col-lg-9">
                <div
                  class="tab-content account-tabs dashboard"
                  id="v-pills-tabContent"
                >
                  <div
                    class="tab-pane fade show active"
                    id="v-pills-home"
                    role="tabpanel"
                    aria-labelledby="v-pills-home-tab"
                  >
                    <div class="page-title title title1 title-effect">
                      <h2>My Dashboard</h2>
                    </div>
                    <div class="profile-edit-form">
                      <div class="welcome-msg">
                        <h6 class="font-light">Hello, <span><?php echo $user_name;?> !</span></h6>
                        <p class="font-light">
                          From your My Account Dashboard you have the ability to
                          view a snapshot of your recent account activity and
                          update your account information. Select a link below
                          to view or edit information.
                        </p>
                      </div>
                      <div class="order-box-contain my-4">
                        <div class="row g-4">
                          <div class="col-lg-4 col-sm-12 mb-3 mb-lg-0">
                            <div class="order-box">
                              <div class="order-box-image">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                              </div>
                              <div class="order-box-contain">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                                <div>
                                  <h5 class="font-light">total order</h5>
                                  <?php
                                  $ordersQuery = $conn->query("select * from orders where user_id='".$_SESSION['user_id']."' && dstatus=0 order by id desc ");  
                                  if($ordersQuery->num_rows >0){ ?>
                                    <h3><?php echo $ordersQuery->num_rows;   ?></h3>
                                 <?php }else{ ?>
                                 <h3>0</h3>
                                 <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-4 col-sm-12 mb-3 mb-lg-0">
                            <div class="order-box">
                              <div class="order-box-image">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                              </div>
                              <div class="order-box-contain">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                                <div>
                                  <h5 class="font-light">completed orders</h5>
                                  <h3>0</h3>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-4 col-sm-12">
                            <div class="order-box">
                              <div class="order-box-image">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                              </div>
                              <div class="order-box-contain">
                                <img
                                  src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg"
                                  class="img-fluid blur-up lazyloaded"
                                  alt=""
                                />
                                <div>
                                  <h5 class="font-light">wishlist</h5>
                                  <?php 
                                  $getwish =$conn->query("select * from whishlist where user_id = '".$_SESSION['user_id']."'");
                                  if($getwish->num_rows > 0){ ?>
                                    <h3 id="wishlistCount"><?php echo $getwish->num_rows; ?></h3>
                                 <?php }else{  ?>
                                  <h3 id="wishlistCount">0</h3>
                                <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-head">
                        <h3>Account Information</h3>
                      </div>
                      <form class="userDetailForm" method="post">
                        <div class="row">
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>Name</label>
                            <input
                              type="name"
                              class="form-control"
                              placeholder="Name"
                              name="name"
                              value="<?php echo isset($_POST['name'])?$_POST['name']:$user_name?>"
                            />
                          <p class="error"><?php echo isset($nameerr)?$nameerr:''; ?></p>
                          </div>
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>Your Email Address </label>
                            <input
                              type="email"
                              class="form-control"
                              placeholder="Enter email"
                              name="email"
                              value="<?php echo isset($_POST['email'])?$_POST['email']:$user_email?>"
                            />
                           <p class="error"><?php echo isset($emailerr)?$emailerr:''; ?></p>
                          </div>
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>Your Phone</label>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Your Phone"
                              name="mobile"
                              value="<?php echo isset($_POST['mobile'])?$_POST['mobile']:$user_mobile?>"
                            />
                           <p class="error"><?php echo isset($moberr)?$moberr:''; ?></p>
                          </div>
                          
                          <!-- <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>PostCode</label>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Postcode"
                              name="postcode"
                              value=""
                            />
                          </div>
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>Address1</label>
                            <input
                              type=""
                              class="form-control"
                              placeholder="Address 1"
                              name="address"
                              value=""
                            />
                          </div>
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <label>Address2</label>
                            <input
                              type=""
                              class="form-control"
                              placeholder="Address 2"
                            />
                          </div> -->
                          
                        </div>
                        <div class="row">
                          <div
                            class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"
                          >
                            <button
                              type="submit"
                              class="btn product__btn signin_btn"
                            >
                              Update
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php include('../partial/account-sidebar-footer.php'); ?>