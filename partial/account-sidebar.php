<?php 
   if (!isset($_SESSION['islogin']) || $_SESSION['usertype'] != 'fronted') {
     header("location:".SITEURL.'login.php');
  }
  // echo $pagename;
  include('../partial/header.php');
  // prd($_SESSION);

  // $userdataquery = $conn->query("select * from users where id='""'")
   $userdata = $_SESSION['userdata'];
   // prd($userdata);
   $profilepic = $userdata['profile_pic'];
   $user_name = $userdata['name'];
   $user_email = $userdata['email'];
   $user_mobile = $userdata['mobile_no'];
   $user_pass = $userdata['password'];

?>

    <!-- Page Preloder -->
    <div id="preloder" style="display: none">
      <div class="loader" style="display: none"></div>
    </div>
    <a id="button"></a>

    <div id="myModalsubscribe" class="modal fade subscribe">
      <div class="modal-dialog">
        <div class="modal-content">
          <button
            type="button"
            class="close2"
            data-dismiss="modal"
            aria-hidden="true"
          >
            ×
          </button>
          <div class="modal-body">
            <div class="row m-0">
              <div class="col-md-6 p-0 position-relative">
                <div class="newslettermodal-img">
                  <img
                    src="https://vinaikajaipur.com/html/img/popup-img.jpg"
                    alt=""
                    title=""
                    class="img-fluid"
                  />
                </div>
              </div>
              <div class="col-md-6 p-0">
                <div class="newslettermodal-content">
                  <div class="text-center">
                    <img
                      src="https://vinaikajaipur.com/html/img/logo.png"
                      alt=""
                      title=""
                    />
                  </div>
                  <h4 class="modal-title">Sign up our newsletter</h4>
                  <p>
                    Enter Your email address to sign up to receive our latest
                    news and offers
                  </p>
                  <form
                    action="/"
                    method="post"
                    id="homeForm"
                    onsubmit="return ajaxmailhome();"
                    class="newslettermodal-content-form"
                  >
                    <div class="form-group">
                      <input
                        type="email"
                        name="homemail"
                        id="homemail"
                        class="form-control"
                        placeholder="Enter Your e-mail address"
                      />
                    </div>
                    <button
                      type="button"
                      class="btn-product btn--animated w-100"
                      onclick="return ajaxmailhome();"
                    >
                      Subscribe
                    </button>
                  </form>
                  <ul>
                    <li>
                      <a href="#" class="icoRss" title=""
                        ><i class="fa fa-rss"></i
                      ></a>
                    </li>
                    <li>
                      <a href="#" class="icoFacebook" title=""
                        ><i class="fa fa-facebook"></i
                      ></a>
                    </li>
                    <li>
                      <a href="#" class="icoTwitter" title=""
                        ><i class="fa fa-twitter"></i
                      ></a>
                    </li>
                    <li>
                      <a href="#" class="icoGoogle" title=""
                        ><i class="fa fa-google-plus"></i
                      ></a>
                    </li>
                    <li>
                      <a href="#" class="icoLinkedin" title=""
                        ><i class="fa fa-linkedin"></i
                      ></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-wrap">
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
                  <h4>Account</h4>
                  <div class="breadcrumb__links">
                    <a href="./index.html">Home</a>
                    <span>Account</span>
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
              <div class="col-sm-12 col-md-5 col-lg-3">
                <div
                  class="nav flex-column nav-pills"
                  id="v-pills-tab"
                  role="tablist"
                  aria-orientation="vertical"
                >
                  <div class="profile-tabs">
                    <img
                      src="<?php echo SITEURL;?>upload/user/<?php echo $profilepic; ?>"
                      alt="profile-img"
                    />
                    <h2><?php echo $user_name;?></h2>
                  </div>
                  <a
                    class="nav-link <?php echo isset($pagename) && $pagename=='Account'?'active':''; ?>"
                    id="v-pills-home-tab"
                    href="<?php echo SITEURL; ?>my-account"
                    role="tab"
                    >My Dashboard</a
                  >
                  <a
                    class="nav-link <?php echo isset($pagename) && $pagename == 'My Order'?'active':''; ?>"
                    id="v-pills-profile-tab"
                    href="<?php echo SITEURL; ?>my-account/my-order.php"
                    >My Order</a
                  >
                  <!--  <a class="nav-link" id="v-pills-messages-tab" href="cancel-order.html">Cancel Order</a> -->
                  <a
                    class="nav-link"
                    id="v-pills-settings-tab"
                    href="<?php echo SITEURL; ?>my-account/"
                    >Return Order</a
                  >
                  <a
                    class="nav-link <?php echo isset($pagename) && $pagename=='Wishlist'?'active':''; ?>"
                    id="v-pills-wishlist-tab"
                    href="<?php echo SITEURL; ?>my-account/wishlist.php"
                    >My Wishlist</a
                  >
                  <a
                    class="nav-link"
                    id="v-pills-logout-tab"
                    href="<?php echo SITEURL;?>logout.php"
                    >Log Out</a
                  >
                </div>
              </div>