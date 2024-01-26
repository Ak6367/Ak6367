<?php
  if(!isset($isinculeglobal)){
    include('../global.php');
  }
  $pagename = "View Cart";
  if(!isset($_GET['user_id'])){
    $_GET['user_id'] = $_SESSION['user_id'];
  }
  ?>
<div class="shopping__cart__table">
            <table>
              <tbody>
                <?php 
                  $totalamount = 0;
                  $cart_item_Query = $conn->query("select carts.*,products.name, products.image, products.price from carts left join products on products.id=product_id where user_id='".$_GET['user_id']."' order by carts.created_at desc");
                  
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
                              <h6><?php echo $fetch_pro['qty'].' X '.$fetch_pro['name']; ?></h6>
                              <h5><?php echo displaycurrency($fetch_pro['price']);?></h5>
                          </div>
                      </div>
                  </td>
                </tr>
                <?php } 
                  }
                ?>                
              </tbody>
            </table>
          </div>
          <?php if(!isset($isinculeglobal)){ ?>
          <div class="w-full">
            <div class="header-cart-total w-full p-tb-40">
              Total: <span class="total_cart"><?php echo displaycurrency($totalamount);?></span>
            </div>

            <div class="header-cart-buttons flex-w w-full">
              <a href="<?php echo SITEURL;?>cart.php" class="btn-product btn--animated size-107 m-r-8">
                View Cart
              </a>
              <a href="checkout.php" class="btn-product btn--animated size-107">
                Check Out
              </a>
            </div>
          </div>
          <?php } ?>