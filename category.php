<?php
  include('global.php');
  $pagename = "Category";
  //prd(base64_decode($_GET['ref']));
  $refid = base64_decode($_GET['ref']);

  $query = "select * from products where dstatus=0 && status=1";

    if($_GET['type']=='category'){
      $query .=" && category_id='".$refid."'";
    }     
    if($_GET['type']=='brand'){
      $query .=" && brand_id='".$refid."'";
      $getsub = $conn->query("select * from brands where id='".$refid."' && status=1 && dstatus=0");
    }
    if($_GET['type']=='subcategory'){
      $query .=" && sub_category_id='".$refid."'";
    }
    if(isset($_GET['min'])){
      $query .=" && price >='".$_GET['min']."'";
    }
    if(isset($_GET['max']) && !empty($_GET['max'])){
      $query .=" && price <='".$_GET['max']."'";
    }
    if(isset($_GET['ord']) && $_GET['ord'] == 'asc'){
      $query .=" && price order by id asc";
    }
    if(isset($_GET['ord']) && $_GET['ord'] == 'desc'){
      $query .=" && price order by id desc";
    }

    $runquery = $conn->query($query);
    $currentPageUrl = SITEURL.'category.php?ref='.$_GET["ref"].'&type='.$_GET["type"];
    //prd($runquery);

  include('partial/header.php');


?>
 <div class="content">
        <section class="shop spad">
          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div id="sideBarFilter" class="shop__sidebar left-bar">
                    <span class="icon icon-cancel block d-lg-none" onclick="closeSidebar()"></span>
                  <div class="shop__sidebar__search">
                    <form action="#">
                      <input type="text" placeholder="Search..." />
                      <button type="submit">
                        <span class="icon_search"></span>
                      </button>
                    </form>
                  </div>
                  <div class="shop__sidebar__accordion">
                    <div class="accordion" id="accordionExample">
                      <div class="card">
                        <div class="card-heading">
                          <a data-toggle="collapse" data-target="#collapseOne"
                            >Categories</a
                          >
                        </div>
                        <div
                          id="collapseOne"
                          class="collapse show"
                          data-parent="#accordionExample"
                        >
                          <div class="card-body">
                            <div class="shop__sidebar__categories">
                              <ul class="filter-wrap">
                                <?php

                                $getsub = $conn->query("select * from subcategories where category_id='".$refid."' && status=1 && dstatus=0");
                                if($getsub->num_rows > 0){                      
                                 while($subcate = $getsub->fetch_assoc()){
                                    // prd($subcate);
                                  ?>
                                  
                                <li><a href="<?php echo SITEURL;?>category.php?ref=<?php echo base64_encode($subcate['id']);?>&type=subcategory"><?php echo ucwords($subcate['name']); ?></a></li>
                              <?php } 
                                }
                              
                              ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-heading">
                          <a data-toggle="collapse" data-target="#collapseThree"
                            >Filter Price</a
                          >
                        </div>
                        <div
                          id="collapseThree"
                          class="collapse show"
                          data-parent="#accordionExample"
                        >
                          <div class="card-body">
                            <div class="shop__sidebar__price">
                              <ul class="filter-wrap">
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=0&max=500"
                                    >₹0.00 - ₹500.00</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=500&max=1000"
                                    >₹500.00 - ₹1000.00</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=1000&max=1500"
                                    >₹1000.00 - ₹1500.00</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=1500&max=2000"
                                    >₹1500.00 - ₹2000.00</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=2000&max=2500"
                                    >₹2000.00 - ₹2500.00</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href="<?php echo $currentPageUrl; ?>&min=2500&max=0"
                                    >2500.00+</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function openSidebar(){
                    var sideabr = document.getElementById("sideBarFilter");
                    sideabr.classList.toggle("open");
                } 
                function closeSidebar(){
                    var sideabr = document.getElementById("sideBarFilter");
                    sideabr.classList.toggle("open");
                } 
              </script>
              <div class="col-lg-9">
                <div class="shop__sidebar__right">
                  <div class="shop__product__option">
                    <div class="row align-items-center justify-content-lg-between">
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6  d-block d-lg-none">
                        <button class="product-filter-mobile filter-toggle p-0" onclick="openSidebar()">FILTER
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#808080c9">
                                <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z">
                                </path>
                            </svg>
                        </button>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="shop__product__option__left">
                          <p>Showing <?php echo $runquery->num_rows; ?> results</p>
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="shop__product__option__right">
                          <p>Sort by Price:</p>
                          <select onchange="changeorder(this.value);">
                            <option value="<?php echo $currentPageUrl;?>&ord=asc" <?php echo (isset($_GET['ord']) && $_GET['ord']=='asc')?'selected':''?>>Low To High</option>
                            <option value="<?php echo $currentPageUrl;?>&ord=desc" <?php echo (isset($_GET['ord']) && $_GET['ord']=='desc')?'selected':''?>>High To Low</option>
                            <option></option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row product_add_row">
                    <?php 
                      while($fetch_pro = $runquery->fetch_assoc()){
                        $img = $fetch_pro['image'];
                        $name = $fetch_pro['name'];
                        $price = $fetch_pro['price'];
                      ?>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp"
                      data-wow-delay="0.1s">
                      <div class="product__item">
                        <div class="product__item__pic set-bg">
                          <a
                            href="<?php echo SITEURL;?>product.php?ref=<?php echo base64_encode($fetch_pro['id']); ?>" 
                          >
                            <img
                              onerror style="height: 260px!important;" src="<?php echo SITEURL ?>upload/products/<?php echo $img?>"
                            />
                          </a>

                          <ul class="product__hover">
                            <?php 
                              if(isset($_SESSION['user_id']) && $_SESSION['usertype'] == 'fronted'){
                                  $checkwhish = $conn->query("select * from whishlist where user_id='".$_SESSION['user_id']."' && product_id='".$fetch_pro['id']."' ");
                                  // prd($checkwhish);
                              
                              if($checkwhish->num_rows > 0){ ?>
                              <li
                              class="toggle-whish"
                              product_id="<?php echo $fetch_pro['id']; ?>"
                            >
                              <img
                                onerror="" class="whis-list-<?php echo $fetch_pro['id']; ?>"
                                src="<?php echo SITEURL ?>assets/back/html/img/icon/heartfill.png"
                                alt=""
                              />
                              <span>Cart</span>
                            </li>
                          <?php }else{ ?>
                              <li
                              class="toggle-whish"
                              product_id="<?php echo $fetch_pro['id']; ?>"
                            >
                              <img
                                onerror="" class="whis-list-<?php echo $fetch_pro['id']; ?>"
                                src="<?php echo SITEURL ?>assets/back/html/img/icon/heart.png"
                                alt=""
                              />
                              <span>Cart</span>
                            </li>
                          <?php } } ?>
                            <li
                              class="add-cart add_to_cart_btn"
                              product_id="<?php echo $fetch_pro['id']; ?>"
                            >
                              <img
                                onerror=""
                                src="<?php echo SITEURL ?>assets/back/html/img/icon/cart.png"
                                alt=""
                              />
                              <span>Cart</span>
                            </li>
                          </ul>
                          <div class="product__hover__details">
                            <a
                              href="<?php echo SITEURL;?>product.php?ref=<?php echo base64_encode($fetch_pro['id']); ?>"
                              ><span>View Details</span></a
                            >
                          </div>
                        </div>

                        <div class="product__item__text">
                          <a
                            title="<?php echo $name; ?>"
                            href="<?php echo SITEURL;?>product.php?ref=<?php echo base64_encode($fetch_pro['id']); ?>"
                          >
                            <span><?php echo $name; ?></span>
                          </a>

                          <span style="margin: "><?php echo displaycurrency($price); ?></span>

                          
                        </div>
                      </div>
                    </div>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


    <?php include('partial/footer.php') ?>
    <script>
      $(document).ready(function () {
        $(document).on("click", ".add_to_cart_btn", function () {
          var product_id = $(this).attr("product_id");
          var qty = "1";
          add_to_cart_items(product_id, "outer", "insert", qty, "inner");
        });
      });
    </script>
    <script>
      function changeorder(curruntpageurl){
          window.location.href = curruntpageurl;
      }
    </script>
    <script>
      $(document).on('click', '.toggle-whish', function (e) {
        let productid = $(this).attr('product_id');
        //alert(productid);
            $.ajax({
                      type: 'POST',
                      url: "<?php echo SITEURL;?>ajax/add-to-whishlist.php",
                      data: {
                          product_id: productid,
                      },
                      dataType: "JSON",
                      success: function (resultData) { 
                      if (resultData.status == 'add_whish') {
                        $('.whis-list-'+productid).attr('src',resultData.imghtml);
                        $('.wishcount').html(resultData.wishlistcount);
                        Swal.fire({
                          icon: 'success',
                          title: 'Successfully',
                          text: 'Product Wishlist Successfully',
                          });
                      }
                      if (resultData.status == 'remove') {
                        $('.whis-list-'+productid).attr('src',resultData.imghtml);
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