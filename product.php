<?php 
    include('global.php');
    $pagename = "Product";
    $proid = base64_decode($_GET['ref']);
    $mainproquery = $conn->query("select * from products where id='".$proid."'");
    if($mainproquery->num_rows > 0){
        $getprodetails = $mainproquery->fetch_object();
        //prd($getprodetails);
        $productid = $getprodetails->id;
        $pro_name = $getprodetails->name;
        $mrp = $getprodetails->mrp;
        $price = $getprodetails->price;
        $image = $getprodetails->image;
        $description = $getprodetails->description;
        $category = $getprodetails->category_id;
        $sub_category_id = $getprodetails->sub_category_id;
    }else{
        header("location:".SITEURL);
    }
    include('partial/header.php');
    // echo $proid;
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
                                <h4>Shop</h4>
                                <div class="breadcrumb__links">
                                    <a href="<?php echo SITEURL;?>">Home</a>
                                    <span>Product Details</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Shop Details Section Begin -->
            <section class="shop-details">
                <div class="product__details__pic">
                    <div class="container">
                       
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="product__single__item_details">
                                    <ul class="nav nav-tabs img-thumb-wrapper" role="tablist">
                                        <?php 
                                        
                                        ?>
                                        <li class="nav-item">
                                            <a class="nav-link img-thumb active" data-toggle="tab" href="#tabs-14"
                                                role="tab">
                                                <div class="product__thumb__pic set-bg"
                                                    data-setbg="<?php echo SITEURL;?>upload/products/<?php echo $image;?>" >
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                            $galleryquery = $conn->query("select * from product_images where product_id='".$proid."' && dstatus = 0");
                                            $cnt = 15;
                                            if($galleryquery->num_rows > 0){
                                              while($fetchgallery = $galleryquery->fetch_object()){
                                        ?>
                                            <li class="nav-item">
                                            <a class="nav-link img-thumb" data-toggle="tab" href="#tabs-<?php echo $cnt++; ?>" role="tab">
                                                <div class="product__thumb__pic set-bg"
                                                    data-setbg="<?php echo SITEURL;?>upload/products/galleryimage/<?php echo $fetchgallery->image;?>">
                                                </div>
                                            </a>
                                        </li>
                                    <?php }
                                } ?>

                                    </ul>

                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-14" role="tabpanel">
                                            <div class="product__details__pic__item">
                                                <a class="grouped_elements"
                                                    href="<?php echo SITEURL;?>upload/products/<?php echo $image;?>">
                                                    <img onerror="" src="<?php echo SITEURL;?>upload/products/<?php echo $image;?>" alt="" style="height: 520px;" />
                                                </a>
                                            </div>
                                        </div>
                                        <?php 
                                            $galimgQuery = $conn->query("select * from product_images where product_id='".$proid."' && dstatus = 0");
                                            $cnt = 15;
                                            if($galimgQuery->num_rows > 0){
                                              while($fetchgalimg = $galimgQuery->fetch_object()){
                                        ?>
                                        <div class="tab-pane " id="tabs-<?php echo $cnt++; ?>" role="tabpanel">
                                            <div class="product__details__pic__item">
                                                <a class="grouped_elements"
                                                    href="<?php echo SITEURL;?>upload/products/galleryimage/<?php echo $fetchgalimg->image; ?>" style="height: 520px;">
                                                    <img onerror="" src="<?php echo SITEURL;?>upload/products/galleryimage/<?php echo $fetchgalimg->image; ?>" style="height: 520px;" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                    <?php }
                                     }
                                ?>


                                        

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="product__details__text">
                                    <h4 class="text-left"><?php echo $pro_name;?></h4>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <span> - 0 Reviews</span>
                                        <span class="toggle-whishlist" data-product-id="<?php echo $productid;?>">
                                            <?php 
                                            if(isset($_SESSION['user_id']) && $_SESSION['usertype'] == 'fronted'){
                                                $checkwhish = $conn->query("select * from whishlist where user_id='".$_SESSION['user_id']."' && product_id='".$productid."' ");
                                                // prd($checkwhish);
                                            
                                            if($checkwhish->num_rows > 0){ ?>
                                        <img class="whishlist whis-list" style="width: 25px;height:25px" src="<?php echo SITEURL;?>assets/back/html/img/icon/heartfill.png"
                                                alt="" /><span>Wishlist</span>

                                        </span>
                                           <?php }else{ ?>
                                                <img class="whishlist whis-list" style="width: 25px;height:25px" src="<?php echo SITEURL;?>assets/back/html/img/icon/heart.png"
                                                alt="" /><span>Wishlist</span>

                                        </span> 
                                           <?php }
                                       }
                                        ?>
                                            
                                    </div>
                                    <h3 class="text-left"><?php echo displaycurrency($price);?><span><?php echo displaycurrency($mrp);?></span></h3>
                                    <p>
                                    <p>Dummy Details</p>
                                    </p>
                                    
                                    <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype']=='fronted' && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){ ?> 
                                        <a href="javascript:void(0);" class="primary-btn btn-product btn--animated shake add_to_cart_btn" product_id="<?php echo $productid;?>">add to cart</a>

                                    <?php }else{ ?> 
                                        <a href="<?php echo SITEURL;?>login.php?redirecturi=<?php echo SITEURL;?>product.php?ref=<?php echo $_GET['ref'];?>" class="primary-btn btn-product btn--animated shake add_to_cart_btn"
                                        >Login to Add to Cart</a>

                                    <?php } ?>
                                    
                                </div>
                                <div class="product__details__btns__option">

                                </div>
                                <div class="product__details__last__option">
                                    <div class="safe-checkout">
                                        <img src="<?php echo SITEURL;?>assets/back/safe-checkout.png" />
                                    </div>
                                    <ul style="padding-top:0px">
                                        <li><span>SKU:</span> M500</li>
                                        <?php 
                                            $cateQuery = $conn->query("select name from categories where id = '".$category."'");
                                            $cateName = $cateQuery->fetch_object();
                                        ?>
                                        <li><span>Categories:</span> <?php echo $cateName->name;?></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_description_area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">Specification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                        aria-controls="review" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <p>
                                    <p><?php echo $description; ?></p>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <p>Dummy Details</p>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row total_rate">
                                                <div class="col-6">
                                                    <div class="box_total">
                                                        <h5>Overall</h5>
                                                        <h4>0</h4>
                                                        <h6>(0 Reviews)</h6>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="rating_list">
                                                        <h3>Based on 0 Reviews</h3>


                                                        <ul class="list">
                                                            <li>
                                                                <a href="#">5 Star
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    0</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">4 Star <i class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i>
                                                                    0</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">3 Star <i class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i>
                                                                    0</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">2 Star <i class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i>
                                                                    0</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">1 Star <i class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i><i
                                                                        class="fa fa-star"></i>
                                                                    0</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review_list">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="review_box">
                                                <h4>Add a Review</h4>
                                                <p>Your Rating:</p>
                                                <ul class="list">
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                </ul>
                                                <p>Outstanding</p>
                                                <form class="row contact_form"
                                                    action="https://vinaikajaipur.com/product/contact_process.php"
                                                    method="post" id="contactForm" novalidate="novalidate">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" placeholder="Your Full name"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Your Full name'" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Email Address"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Email Address'" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="number"
                                                                name="number" placeholder="Phone Number"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Phone Number'" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="message" id="message"
                                                                rows="1" placeholder="Review"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Review'"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" value="submit"
                                                            class="primary-btn btn-product btn--animated">Submit
                                                            Now</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Shop Details Section End -->

        <!-- Related Section Begin -->
        <section class="related spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="related-title">Related Product</h3>
                    </div>
                </div>
                <div class="product__filter wow fadeInUp" data-wow-delay="0.1s">


                    <div class="swiper productSwiper">
                        <div class="swiper-wrapper">

                        <?php 
                            $relateproquery = $conn->query("select * from products where sub_category_id='".$sub_category_id."' && id !='".$productid."' && status = 1 && dstatus = 0");
                            if($relateproquery->num_rows > 0){
                            while($getrelatepro = $relateproquery->fetch_array()){
                            // prd($getrelatepro);
                            $relateproimg = $getrelatepro['image'];
                            $relateproname = $getrelatepro['name'];
                            $relateproprice = $getrelatepro['price'];
                        ?>
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="<?php echo SITEURL;?>product.php?ref=<?=base64_encode($getrelatepro['id']);?>">

                                            <img onerror="" style="height: 380px!important;" src="<?php echo SITEURL;?>upload/products/<?php echo $relateproimg;?> "
                                                alt="">
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="<?php echo $productid;?>">
                                                <img onerror="" class="heart" src="<?php echo SITEURL;?>assets/back/html/img/icon/heart.png"
                                                    alt=""  /><span>Wishlist</span>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img src="<?php echo SITEURL;?>assets/back/html/img/icon/cart.png"
                                                        alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text d-flex flex-column">
                                        <a href="javascript:void(0)">
                                            <span><?php echo $relateproname;?></span>
                                        </a>
                                        <span><?php echo displaycurrency($relateproprice);?></span>                                        
                                    </div>
                                </div>
                            </div>

                            <?php }
                            } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>   
                    </div>

                </div>
            </div>
        </section>
        <!-- Related Section End -->
    </div>

   <?php include('partial/footer.php'); ?> 
   <script>
      $(document).on('click', '.toggle-whishlist', function (e) {
        let productid = $(this).attr('data-product-id');
            $.ajax({
                      type: 'POST',
                      url: "<?php echo SITEURL;?>ajax/add-to-whishlist.php",
                      data: {
                          product_id: productid,
                      },
                      dataType: "JSON",
                      success: function (resultData) { 
                      if (resultData.status == 'add_whish') {
                        $('.whis-list').attr('src',resultData.imghtml);
                        $('.wishcount').html(resultData.wishlistcount);
                            Swal.fire({
                              icon: 'success',
                              title: 'Successfully',
                              text: 'Product Wishlist Successfully',
                              });
                          }
                          if (resultData.status == 'remove') {
                        $('.whis-list').attr('src',resultData.imghtml);
                        $('.wishcount').html(resultData.wishlistcount);
                            Swal.fire({
                              icon: 'success',
                              title: 'Deleted',
                              text: 'Wishlist Removed Successfully',
                              });
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
    </script>
    