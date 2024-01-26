<?php
    include('global.php');
    $pagename = 'login';
    if(isset($_GET['redirecturi']) && !empty($_GET['redirecturi'])){
        $_SESSION['isredirect'] =$_GET['redirecturi']; 
    }
    include("partial/header.php");
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
                        <h4>Login</h4>
                        <div class="breadcrumb__links">
                            <a href="index.html">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="register-page spad-70">
        <div class="container">
            <div class="row create-an-account">
                <div class="col-md-12">
                     <form id="signinform" method="post" onsubmit="return checkvalue();">
                         <!-- <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA"> -->
                        <h2>Sign IN</h2>
                        <div class="form-group">
                            <label>Your Email Address </label>
                            <input type="email" id="email_main" class="form-control" name="email" placeholder="Enter email" />
                        </div>
                        <p class="error" id="error_email"></p>
                        <div class="form-group">
                            <label>Your Password</label>
                            <input type="password" id="password_main"class="form-control" name="password" placeholder="Enter Password" />
                        </div>
                         <p class="error" id="error_password"></p>
                        <button type="submit" class="btn product__btn signin_btn w-100 save" >Sign IN</button>
                          <div class="already-btnRegisterPage text-center">
                            <p>Don't have an account? <a href="<?php echo SITEURL;?>register.php">Sign up</a></p>
                          </div>

                          <div class="col-md-12 text-center">
                            <a href="https://www.facebook.com/v3.3/dialog/oauth?client_id=1764025217293855&amp;redirect_uri=https%3A%2F%2Fvinaikajaipur.com%2Flogin%2Ffacebook%2Fcallback&amp;scope=email&amp;response_type=code&amp;state=eDC6dCJAeRQFvbCpfuwMIIs8fyCzWZEETG2RKdHX" class="btn btn-social btnfb"><i class="fa fa-facebook-f"></i> <span class="divider"></span> Login with Facebook</a>
                            <a href="https://accounts.google.com/o/oauth2/auth?client_id=997285346866-p2st47ok3jv0nr61vna7ra2otjs7u0uv.apps.googleusercontent.com&amp;redirect_uri=https%3A%2F%2Fvinaikajaipur.com%2Flogin%2Fgoogle%2Fcallback&amp;scope=openid+profile+email&amp;response_type=code&amp;state=3qjr5ZqDLXxN6cZ7unJUVm17dvWsAuJWS9SnTOCP" class="btn btn-social btn-gmail"><i class="fa fa-google"></i> <span class="divider"></span> Login with Google</a>
                         </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
        </div>

        <!-- Footer Section End -->
    <?php
        include("partial/footer.php");
    ?>
<script type="text/javascript">
            function checkvalue(){
                // alert(6434);
                let email = $('#email_main').val();
                let password = $('#password_main').val();
                iserror = 1;
                if(email == ''){
                    iserror = 0;
                    $('#email_main').focus();
                    $('#error_email').text('Please Enter Your Email');
                }else{
                     $('#error_email').text('');
                }

                if(password == ''){
                    //alert(67343);
                    iserror = 0;
                    $('#password_main').focus();
                    $('#error_password').text('Please Enter A Strong Password');
                }else{
                     $('#error_password').text('');
                }
                            //var fd = new FormData();
                if(iserror == 1){
                  $.ajax({
                    url: 'ajax/frontedlogin.php',
                    type: 'post',
                    dataType: "JSON",
                    data: {email : email, password: password},
                    // contentType: false,
                    // processData: false,
                    success: function(response){
                        // alert(response);
                        if (response.iserr == 1) {
                          example = response.errormsg;
                          for (let key in example) {
                            if (example.hasOwnProperty(key)) {
                              value = example[key];
                              document.getElementById(key).innerHTML = value;

                            }
                          }
                        } else {
                            <?php if(isset($_SESSION['isredirect']) && !empty($_SESSION['isredirect'])){ 
                                $redirect = $_SESSION['isredirect'];
                                unset($_SESSION['isredirect']);
                                ?>
                                window.location.href = "<?php echo $redirect; ?>";
                            <?php }else{?>
                                window.location.href = "<?php echo SITEURL; ?>";
                          <?php } ?>
                        }
                    },
                });  
                } 
              return false;
        }
</script>