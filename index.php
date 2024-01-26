<?php
  if (isset($_SESSION['user_id']) && $_SESSION['islogin'] == 2 && $_SESSION['usertype'] == 'fronted') {
    header("location:".SITEURL);
  }
  $pagename = "dashboard";
  include('global.php');
  // prd($_SESSION);
  include('partial/header.php');
?>

    <div class="content">
      <section class="hero">
        <div class="hero__slider owl-carousel">
          <?php 
            $banner_sql = $conn->query("select *from banners where dstatus = 0 && status = 1");
             
            //prd($fetch_banner); 
            while($fetch_banner =  $banner_sql->fetch_assoc()){
          ?>
          <div class="hero__items set-bg" data-setbg="<?php echo SITEURL;?>upload/banners/<?php echo $fetch_banner['banner_image'];?>">
            <div class="container">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <?php if(!empty($fetch_banner['link'])){?>
                      <a href="<?php echo $fetch_banner['link'];?>" class="btn sliderbtn" target="_blank"><?php echo !empty($fetch_banner['button_text'])?ucfirst($fetch_banner['button_text']):'View';?></a>
                  <?php } ?>
                  
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          
        </div>
      </section>
      &nbsp;
      <section class="section section-cat pt-0 animTop shop-by-category">
        <div class="container">
          <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
            <h3>Categories</h3>
            <p>A beautiful rendition of modern pieces to elevate your look</p>
          </div>
          <div class="row justify-content-center">
            
            <?php
            $catego = getcategory($conn);
              if($catego->num_rows > 0){
                while($getcatedata = $catego->fetch_assoc()){
                 //prd($getcatedata); 
                  $name = $getcatedata['name'];
                  $pic = $getcatedata['image'];
             ?>

            <div class="col-xs-12 col-md-4 mb-4 mb-md-0 col-lg-4 catList">
              <a href="<?php echo SITEURL;?>category.php?ref=<?php echo base64_encode($getcatedata['id']);?>&type=category" class="catBox">
                <div class="imgBox">
                  <img src="<?php echo SITEURL;?>upload/category/<?php echo $pic; ?>" width="400" height="475" alt="<?php echo $name; ?>" />
                </div>
                <h3><?php echo $name; ?></h3>
              </a>
            </div>
          <?php } 
            }
          ?>
          </div>
        </div>
      </section>

            <section class="section section-cat pt-0 animTop shop-by-category">
        <div class="container">
          <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="mt-5">Shop By Brands</h3>
            <p>A beautiful rendition of modern pieces to elevate your look</p>
          </div>
          <div class="row justify-content-center">
            
            <?php
            $brands_res = getbrands($conn);
              if($brands_res->num_rows > 0){
                while($getbranddata = $brands_res->fetch_assoc()){
                 //prd($getcatedata); 
                  $name = $getbranddata['name'];
                  $pic = $getbranddata['image'];
             ?>

            <div class="col-xs-12 col-md-4 mb-4 mb-md-0 col-lg-4 catList">
              <a href="<?php echo SITEURL;?>category.php?ref=<?php echo base64_encode($getbranddata['id']);?>&type=brand" class="catBox">
                <div class="imgBox">
                  <img src="<?php echo SITEURL;?>upload/brands/<?php echo $pic; ?>" width="400" height="475" alt="<?php echo $name; ?>" />
                </div>
                <h3><?php echo $name; ?></h3>
              </a>
            </div>
          <?php } 
            }
          ?>
          </div>
        </div>
      </section>


      <section class="product spad">
        <div class="container">
          <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
            <h3>See What’s Trending</h3>
            <p>A beautiful rendition of modern pieces to elevate your look</p>
          </div>
          <div class="product__filter">
            <div class="mix new-arrivals">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  
                  <?php 
                    $product_sql = $conn->query("select * from products where dstatus = 0 && status = 1 && is_featured = 1");
                   // $fetch_pro = $product_sql->fetch_assoc();
                    //prd($fetch_pro);
                    while($fetch_pro = $product_sql->fetch_assoc()){
                      $image = $fetch_pro['image'];
                  ?>

                  <div class="swiper-slide">
                    <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                      <div class="product__item__pic set-bg">
                        <a class="pro-img" href="" style="width: fit-content;">
                          <img onerror="" src="<?php echo SITEURL;?>upload/products/<?php echo $image; ?>" style="width: 380px; height: 400px!important;" alt="" />
                        </a>
                        <span class="label">Featured</span>
                        <ul class="product__hover">
                          <li>
                            <a href="#"><img onerror="" src="<?php echo SITEURL;?>assets/back/html/img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                          </li>
                          <li>
                            <a class="add-cart" href="#"><img onerror="" src="<?php echo SITEURL;?>assets/back/html/img/icon/cart.png" alt="" />
                              <span>Cart</span></a>
                          </li>
                        </ul>
                      </div>

                      <div class="product__item__text">
                        <a href="Vinaika-women-white-printed-sf-shrug-with-kurta.html">
                        </a>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                  
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
            </div>
      </section>

        <section class="product spad">
        <div class="container">
          <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
            <h3>See What’s Letest</h3>
            <p>A beautiful rendition of modern pieces to elevate your look</p>
          </div>
          <div class="product__filter">
            <div class="mix new-arrivals">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  
                  <?php 
                    $letestpro_sql = $conn->query("select * from products where dstatus = 0 && status = 1 && is_latest = 1");
                   // $fetch_pro = $product_sql->fetch_assoc();
                    //prd($fetch_pro);
                    while($fetch_letest_pro = $letestpro_sql->fetch_assoc()){
                      $imageletest = $fetch_letest_pro['image'];
                  ?>

                  <div class="swiper-slide">
                    <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                      <div class="product__item__pic set-bg">
                        <a class="pro-img" href="">
                          <img onerror="" src="<?php echo SITEURL;?>upload/products/<?php echo $imageletest; ?>" style="width: 380px; height: 400px!important;" alt="" />
                        </a>
                        <span class="label">New</span>
                        <ul class="product__hover">
                          <li>
                            <a href="#"><img onerror="" src="<?php echo SITEURL;?>assets/back/html/img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                          </li>
                          <li>
                            <a class="add-cart" href="#"><img onerror="" src="<?php echo SITEURL;?>assets/back/html/img/icon/cart.png" alt="" />
                              <span>Cart</span></a>
                          </li>
                        </ul>
                      </div>

                      <div class="product__item__text">
                        <a href="Vinaika-women-white-printed-sf-shrug-with-kurta.html">
                        </a>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                  
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
            </div>
      </section>

      <?php 
        $page_1_sql = $conn->query("select * from pages where id=3 && status=1");
        $fetch_1_page = $page_1_sql->fetch_array();
      ?>

      <section class="spad about-us about-us-vinaika spacing-top">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="about__text">
                <h4><?php echo $fetch_1_page['name'] ?></h4>
                <p>
                <?php echo $fetch_1_page['content'] ?>
                </p>
              </div>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
              <div class="about__img">
                <img onerror="" src="<?php echo SITEURL;?>upload/pages/<?php echo $fetch_1_page['image'] ?>" alt="image" />
                <img onerror="" class="right__img" src="<?php echo SITEURL;?>assets/back/html/img/product/about-img2.jpg" alt="image" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php 
        $page_sql = $conn->query("select * from pages where id=1 && status=1");
        $fetch_page = $page_sql->fetch_array();
      ?>

      <section class="spad about-us about-us-vinaika">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 wow fadeInUp order-2 order-md-1" data-wow-delay="0.1s">
              <div class="about__img">
                <img onerror="" src="<?php echo SITEURL;?>upload/pages/<?php echo $fetch_page['image'];?>" alt="image" />
                <img onerror="" class="right__img" src="<?php echo SITEURL;?>assets/back/html/img/product/about-img4.jpg" alt="image" />
              </div>
            </div>
            <div class="col-md-6 wow fadeInUp order-1 order-md-2" data-wow-delay="0.3s">
              <div class="about__text">
                <h4><?php echo $fetch_page['name'] ?></h4>
                <p>
                <?php echo $fetch_page['content'] ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="spad client_reviews">
        <div class="container">
          <div class="heading-box">
            <h3>REVIEWS</h3>
            <p>A beautiful rendition of modern pieces to elevate your look</p>
          </div>
          <div class="customers-testimonials owl-carousel owl-loaded owl-drag">
            <div class="item">
              <div class="product-collection-wrap">
                <div class="product-collection-summery">
                  <p class="testimonialText">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe voluptas voluptatem ipsa commodi quibusdam numquam pariatur.
                  </p>
                  <hr />
                  <p class="testimonialHeading">Shubham Bhowmik</p>
                  <div class="rating_star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="product-collection-wrap">
                <div class="product-collection-summery">
                  <p class="testimonialText">
                    NICE FABRIC AND COMFORT FEEL AFTER WEAR THE KURTI. I
                    RECOMMAND TO ALL MUST BUY MYAZA KURTIS and FABRIC.
                  </p>
                  <hr />
                  <p class="testimonialHeading">SWETA DAS</p>
                  <div class="rating_star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="product-collection-wrap">
                <div class="product-collection-summery">
                  <p class="testimonialText">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident ipsa laboriosam recusandae fugiat nesciunt nobis, tempore!
                  </p>
                  <hr />
                  <p class="testimonialHeading">Swani Rai</p>
                  <div class="rating_star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Latest Blog Section Begin -->
      
      <style>
        img,
        svg {
          vertical-align: middle;
        }
      </style>

      <!-- Latest Blog Section End -->
    </div>

    <?php include('partial/footer.php') ?>