<?php 
  require('../global.php'); 
  //print_r($_SESSION);die;
  if(isset($_SESSION['islogin']) && $_SESSION['islogin'] == 1 && $_SESSION['usertype'] == 'backend'){
    header("location:".SITEADMINURL.'dashboard.php');
  }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/front/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/front/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/front/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post" onsubmit="return checkvalidation();">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p class="error" id="error_email"></p>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="error" id="error_password"></p>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo SITEURL; ?>assets/front/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo SITEURL; ?>assets/front/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo SITEURL; ?>assets/front/dist/js/adminlte.min.js"></script>
  <script>
    function checkvalidation() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      isvalid = 0
      if (email == '') {
        document.getElementById('error_email').innerHTML = "Please enter Your Email Address";
        document.getElementById('email').focus();
        isvalid = 1;
      } else {
        document.getElementById('error_email').innerHTML = '';
      }
      if (password == '') {
        document.getElementById('error_password').innerHTML = "Please enter Your Password";
        document.getElementById('password').focus();
        isvalid = 1;
      } else {
        document.getElementById('error_password').innerHTML = '';
      }
      if (isvalid == 0) {
        $.ajax({
          url: "<?php echo SITEADMINURL; ?>ajax/userlogin.php",
          type: "post",
          dataType: "json",
          data: {email: email,password: password},
          success: function(responce) {
            if (responce.status == 1) {
              example = responce.resmsg;
              for (let key in example) {
                if (example.hasOwnProperty(key)) {
                  value = example[key];
                  document.getElementById(key).innerHTML = value;

                }
              }
            } else {
              window.location.href = "<?php echo SITEADMINURL; ?>dashboard.php";
            }
          }
        });
      }
      return false;
    }
  </script>
</body>

</html>