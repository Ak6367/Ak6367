<!-- Footer Section Begin -->
<footer class="footer" style="background-color: #ed1e79">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer__logo text-center site-logo">
              <a href="<?php echo SITEURL; ?>" class="js-logo-clone"><img onerror="" src="<?php echo $logopath ;?>" alt="Vinaika" /></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer__widget">
              <h6>CUSTOMER SERVICE</h6>
              <div class="addresFooterOption">
                <!-- <div class="addressFooterInner">
                  <i class="fa fa-clock-o"></i>
                  <p>MON-FRI - 10.00 AM TO 7.00 PM (IST)</p>
                </div> -->

                <div class="addressFooterInner">
                  <i class="fa fa-phone"></i>
                  <p><a href="tel:(+91)%209314966969">(+91) <?php echo $f_setting['contact_no']; ?></a></p>
                </div>

                <div class="addressFooterInner">
                  <i class="fa fa-map-marker"></i>
                  <p>
                  <?php echo $f_setting['address']; ?>
                  </p>
                </div>
                <div class="addressFooterInner">
                  <i class="fa fa-envelope"></i>

                  <p>
                    <a href="mailto:customercare@jaipurkurti.com"><?php echo $f_setting['email']; ?></a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="footer__widget">
              <h6>USFULL LINKS</h6>
              <ul>
              <?php 
                $page_cate = $conn->query("select * from page_category where status = 1 LIMIT 5");
                if( $page_cate->num_rows>0){
                  while($fetch_pagecate = $page_cate->fetch_assoc()){              
              ?>
                <li><a href="new-help.html"><?php echo ucfirst($fetch_pagecate['name']) ?></a></li>
                <?php }
                }
                ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="footer__widget">
              <h6>Sub Category</h6>
              <ul>
                <?php 
                $sub_cate = $conn->query("select * from subcategories where status = 1 LIMIT 5");
                if( $sub_cate->num_rows>0){
                  while($fetch_subcate = $sub_cate->fetch_assoc()){              
              ?>
                <li><a href="<?php echo SITEURL; ?>category.php?ref=<?php echo base64_encode($fetch_subcate['id']); ?>&type=subcategory"><?php echo ucfirst($fetch_subcate['name']) ?></a></li>
                <?php }
                }
                ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer__widget">
              <h6>STAY CONNECTED</h6>
              <div class="footer__newslatter">
                <form action="#">
                  <input type="text" placeholder="Your email" />
                  <button type="submit">
                    <span class="icon_mail_alt"></span>
                  </button>
                </form>


                <ul class="social-icon">
                  <?php
                    //prd( $f_setting);
                  if(!empty($f_setting['facebook_page_link'])){ ?>
                  <li>
                    <a href="<?php echo $f_setting['facebook_page_link']; ?>" target="_blank">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>

                <?php
                    //prd( $f_setting);
                  if(!empty($f_setting['instagram_page_link'])){ ?>
                  <li>
                    <a href="<?php echo $f_setting['instagram_page_link']; ?>" target="_blank">
                      <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                  </li>
                  <?php } ?>

                  <?php
                    //prd( $f_setting);
                  if(!empty($f_setting['twitter_page_link'])){ ?>
                  <li>
                    <a href="<?php echo $f_setting['twitter_page_link']; ?>" target="_blank">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>


                  <li>
                    <a href="#">
                      <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                  </li>
                
                  <li>
                    <a href="#">
                      <i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>


              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="footer__copyright__text">
              <p>
                All Rights Reserved - <?php echo date('Y');?>, VINAIKA | Powered
                <i class="fa fa-heart-o" aria-hidden="true"></i> by
                <a href="https://dzoneindia.co.in/" target="_blank">Dzone India</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
      <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
          <input type="text" id="search-input" placeholder="Search here....." />
        </form>
      </div>
    </div>
    <!-- Search End -->

    <!-- signup form popup -->
    <div class="sign__popup__form">
      <div class="signin-overlay"></div>
      <div class="offcanvas-menu-wrapper2">
        <div class="offcanvas__option2">
          <div class="text-right d-flex align-items-center justify-content-sm-between">
            <h5>My Account</h5>
            <div class="js_close-btn close__icon">+</div>
          </div>

          <form id="loginform">
            <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA" />
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email" />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password" />
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" />
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn product__btn signin_btn">
              Login
            </button>
            <div class="mb-20 mt-10 text-center">
              <a href="forgot.html" class="forgot_password">Forgot Your Password?</a>
            </div>
            <div class="text-center mb-20">
              <span>OR</span>
            </div>
            <button class="loginBtn loginBtn--facebook">
              Login with Facebook
            </button>

            <button class="loginBtn loginBtn--google mb-20">
              Login with Google@
            </button>
            <a href="new-register.html" class="btn product__btn signin_btn">Sign up Now!</a>
          </form>
        </div>
      </div>
    </div>
    <!-- Cart popup -->
    <div class="wrap-header-cart js-panel-cart">
      <div class="header-cart flex-col-l p-l-20 p-r-20">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
          <h5>Your Cart </h5>
          <div class="js-hide-cart close__icon">+</div>
        </div>

        <div class="header-cart-content flex-w js-pscroll carthtml">
          <div class="shopping__cart__table">
            <table>
              <tbody>
                <?php 
                if(isset($_SESSION['user_id']) && $_SESSION['islogin'] ==2 ){
                  $totalamount = 0;
                  $cart_item_Query = $conn->query("select carts.*,products.name, products.image, products.price from carts left join products on products.id=carts.product_id where user_id='".$_SESSION['user_id']."' order by carts.id desc");
                  
                    if($cart_item_Query->num_rows > 0){
                        while($fetch_pro = $cart_item_Query->fetch_assoc()){
                        $totalamount += $fetch_pro['price']*$fetch_pro['qty'];
                ?>
                <tr>
                  <td>
                    <div class="product__cart__item d-flex align-items-center basis-50">
                          <div class="product__cart__item__pic" style="width: 150px;">
                              <img src="<?php echo SITEURL; ?>upload/products/<?php echo $fetch_pro['image']; ?>">
                          </div>
                          <div class="product__cart__item__text">
                              <h6><?php echo $fetch_pro['qty'];?> X <?php echo $fetch_pro['name']; ?></h6>
                              <h5><?php echo displaycurrency($fetch_pro['price']);?></h5>
                          </div>
                      </div>
                  </td>
                </tr>
                <?php } 
                  }
                }else{ ?>
                  <tr>
                  <td>
                    <div class="product__cart__item d-flex align-items-center basis-50">
                         
                          <div class="product__cart__item__text">
                              <h6 >Your Cart Is Empty...</h6>
                              <h5>Please Login To View Your Cart?Click Login/Register button To Login/Register Here</h5>
                          </div>
                      </div>
                  </td>
                </tr>
               <?php }
                ?>                
              </tbody>
            </table>
          </div>
          <?php 
            if(isset($_SESSION['user_id']) && $_SESSION['islogin'] ==2 ){ ?>
              <div class="w-full">
            <div class="header-cart-total w-full p-tb-40">
              Total: ₹<span class="total_cart"><?php echo  $totalamount;?></span>
            </div>

            <div class="header-cart-buttons flex-w w-full">
              <a href="<?php echo SITEURL;?>cart.php" class="btn-product btn--animated size-107 m-r-8">
                View Cart
              </a>
              <a href="<?php echo SITEURL; ?>checkout.php" class="btn-product btn--animated size-107">
                Check Out
              </a>
            </div>
          </div>
           <?php }else{ ?>
            <div class="w-full">
            <div class="header-cart-buttons flex-w w-full">
              <a href="<?php echo SITEURL;?>login.php" class="btn-product btn--animated size-107 m-r-8">
                Login
              </a>
              <a href="<?php echo SITEURL;?>register.php" class="btn-product btn--animated size-107">
                Register
              </a>
            </div>
          </div>
           <?php }
          ?>
          
        </div>
      </div>
    </div>
    <!-- <div class="cookie-bar-section">
      <img src="<?php echo SITEURL;?>assets/back/html/img/cookie.png" alt="" />
        <div class="content">
            <h3>Cookies Consent</h3>
            <p class="font-light">
              This website use cookies to ensure you get the best experience on our
              website.
            </p>
            <div class="cookie-buttons">
              <button class="btn-product btn--animated" id="js_understand">
                I understand
              </button>
              <a href="javascript:void(0)" class="btn-product btn--animated"
                >Learn more</a
              >
        </div>
      </div>
    </div> -->
    
  </div>


  <!-- Js Plugins -->
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/bootstrap.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/lib/wow/wow.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery.nice-select.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery.countdown.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/jquery.slicknav.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/mixitup.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/owl.carousel.min.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/js/main.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/js/Vendor/fancybox/jquery.fancybox.js"></script>
  <script src="<?php echo SITEURL;?>assets/back/html/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <!-- Swiper Slider Init -->
  <!-- Bootsrap Cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Bootsrap Cdn -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
      },
    });
  </script>
  <script>
      $(".cookie-bar-section #js_understand").on("click", function () {
        $(".cookie-bar-section").toggleClass("hide");
      });

      const unique = (list) => {
        return [...new Set(list)];
      };

      const inArray = (needle, haystack) => {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
          if (haystack[i] == needle) return true;
        }
        return false;
      };
    </script>

    <script>
      $(".search-icon").click(function () {
        $(".search-wrapper").toggleClass("open");
        $("body").toggleClass("search-wrapper-open");
      });
      $(".search-cancel").click(function () {
        $(".search-wrapper").removeClass("open");
        $("body").removeClass("search-wrapper-open");
      });
    </script>
    <script>
      // Initiate the wowjs
      new WOW().init();
    </script>
    
  <script>
        $(".js-pscroll").each(function () {
            $(this).css("position", "relative");
            $(this).css("overflow", "hidden");
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on("resize", function () {
                ps.update();
            });
        });
    </script>
  <script>
    var swiper = new Swiper(".blogSwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      clickable: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,        
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
      },
    });
  </script>

  <script>
    $(".search-icon").click(function () {
      $(".search-wrapper").toggleClass("open");
      $("body").toggleClass("search-wrapper-open");
    });
    $(".search-cancel").click(function () {
      $(".search-wrapper").removeClass("open");
      $("body").removeClass("search-wrapper-open");
    });
  </script>
  <script>
    // Initiate the wowjs
    new WOW().init();
  </script>
  <script>
        var default_avatar =
            '../../d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg';

        function handleError(image) {
            image.src = default_avatar;
        }

        $(document).ready(function () {
            if (localStorage.getItem('IsModalShown').toString() != 'true') {
                $("#myModalsubscribe").modal('show');
                localStorage.setItem('IsModalShown', true);
            }

            $('[data-toggle="tooltip"]').tooltip();

            mark_fav();
        });

        

        
    </script>
    <script>
        var swiper = new Swiper(".productSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
          breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 10,
          },
        },
        });
    </script> 

    <script>
        $(document).ready(function () {
            $("a.grouped_elements").fancybox({
                'transitionIn': 'elastic',
                'transitionOut': 'elastic',
                'speedIn': 600,
                'speedOut': 200,
                'overlayShow': false
            });
        });    
    </script>
    

    <script>
        $('.search-icon').click(function () {
            $('.search-wrapper').toggleClass('open');
            $('body').toggleClass('search-wrapper-open');
        });
        $('.search-cancel').click(function () {
            $('.search-wrapper').removeClass('open');
            $('body').removeClass('search-wrapper-open');
        });
    </script>
    <script>
        // Initiate the wowjs
        new WOW().init();
    </script>
    <script>
        $(".js-pscroll").each(function () {
            $(this).css("position", "relative");
            $(this).css("overflow", "hidden");
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on("resize", function () {
                ps.update();
            });
        });
    </script>
    
    <script>
        $(document).ready(function () {
            $(document).on('click', '.add_to_cart_btn', function () {
                var product_id = $(this).attr('product_id');
                  $.ajax({
                    type: 'POST',
                    url: "<?php echo SITEURL;?>ajax/add-to-cart.php",
                    data: {
                        product_id: product_id,
                    },
                    dataType: "JSON",
                    success: function (resultData) {  
                    if (resultData.status == 'success') {

                            $('.carthtml').html(resultData.html);
                            $('.cartcount').html(resultData.totalqty);
                            $('.js-panel-cart').addClass('show-header-cart');


                        } 
                        //else {
                    //         title = 'Item Added Successfully...';
                    //     }
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: title,
                    //         confirmButtonText: 'OK',
                    //     }).then((result) => {
                    //         console.log(view_type);
                    //         /* Read more about isConfirmed, isDenied below */
                    //         if (result.isConfirmed && view_type == 'main') {
                    //             window.location.reload()
                    //         }
                    //     })
                    // } else {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Failed',
                    //         text: 'Something went wrong try again later....'
                    //     })
                    // }

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
    </script>
</body>

</html>