<?php
  include('../global.php');
  $pagename = 'Wishlist';
  include('../partial/account-sidebar.php');
  ?> 

    <div class="col-sm-12 mt-4 mt-md-0 col-md-12 col-lg-9">
              <div class="shopping__cart__table">
            <table>
              <tbody>
                <?php 
                  $wishlistQuery = $conn->query("select whishlist.*,products.name, products.price, products.image from whishlist left join products on whishlist.product_id=products.id where whishlist.user_id='".$_SESSION['user_id']."'");
                  
                    if($wishlistQuery->num_rows > 0){
                        while($fetch_pro = $wishlistQuery->fetch_assoc()){
                          // prd($fetch_pro);
                ?>
                <tr id="wishid_<?php echo $fetch_pro['product_id']; ?>">
                  <td>
                    <div class="product__cart__item d-flex align-items-center basis-50">
                          <div class="product__cart__item__pic" style="width: 150px;" >
                              <img src="<?php echo SITEURL; ?>upload/products/<?php echo $fetch_pro['image']; ?>">
                          </div>
                          <div class="product__cart__item__text">
                              <h6><?php echo $fetch_pro['name']; ?></h6>
                              <h5 style="text-align: left;"><?php echo displaycurrency($fetch_pro['price']);?></h5>
                          </div>
                      </div>
                  </td>
                  <td>
                    <input type="hidden" id="proid" value="<?php echo $fetch_pro['product_id']; ?>">
                    <a class="order-btn wish-to-cart" productid="<?php echo $fetch_pro['product_id']; ?>" href="javascript:void(0);"><span>Add To Cart</span></a>
                  </td>
                </tr>
                <?php } 
                  }else{ ?>
                    <div class="box" style="border: 1px solid gray; border-radius:20px;">
                      <h4 style="text-align: center; padding: 200px;">Wishlist Cart Empty<br><span><p>Please Add Some Products</p></span></h4>
                      </div>
                  <?php }
                ?>                
              </tbody>
            </table>
          </div>
            </div>
          
   <?php include('../partial/account-sidebar-footer.php'); ?>   
   <script>
     $(document).on('click', '.wish-to-cart', function () {
        var productId = $(this).attr('productid');
        $.ajax({
                    type: 'POST',
                    url: "<?php echo SITEURL;?>ajax/add-to-cart.php",
                    data: {
                        product_id: productId,
                        wishlist : 1,
                    },
                    dataType: "JSON",
                    success: function (resultData) {  
                    if (resultData.status == 'success') {
                            $('.carthtml').html(resultData.html);
                            $('.cartcount').html(resultData.totalqty);
                            $('.wishcount').html(resultData.wishlistcount);
                            $('.js-panel-cart').addClass('show-header-cart');
                            $('#wishid_'+productId).remove();
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