<?php 
    include('global.php'); 
    include('partial/header.php'); 
    $pagename = "Register";
?> 

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
                        <h4>Create Account</h4>
                        <div class="breadcrumb__links">
                            <a href="index-2.html">Home</a>
                            <span>Create Account</span>
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
                     <form id="form" method="post" onsubmit="return chechvalidation();" enctype="multipart/form-data">
                         <!-- <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA"> -->
                        <h2>REGISTER WITH VINAIKA</h2>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="fullname" class="form-control" name="name" placeholder="Full Name" value="<?php if(isset($_POST['name'])){echo $_POST['name']; } ?>" />
                        </div>
                        <p class="error" id="error_name"><?php if(isset($nameerr)){echo $nameerr;} ?></p>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Mobile Number" value="<?php if(isset($_POST['mobile'])){echo $_POST['mobile']; } ?>" />
                        </div>
                        <p class="error" id="error_mobile"><?php if(isset($moberr)){echo $moberr;} ?></p>
                        <div class="form-group">
                            <label>Your Email Address </label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>"/>
                        </div>
                         <p class="error" id="error_email"><?php if(isset($emailerr)){echo $emailerr;} ?></p>
                        <div class="form-group">
                            <label>Your Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" value="<?php if(isset($_POST['password'])){echo $_POST['password']; } ?>"/>
                        </div>
                         <p class="error" id="error_password"><?php if(isset($passerr)){echo $passerr;} ?></p>
                         <div class="form-group">
                            <label>Profile</label>
                            <input type="file" id="profile" class="form-control" name="profile"/>
                        </div>
                         <p class="error" id="error_profile"><?php if(isset($profileerr)){echo $profileerr;} ?></p>

                        <button type="submit" class="btn product__btn signin_btn w-100 save" >Create an account</button>
                          <div class="already-btnRegisterPage text-center">
                            <p>Already have an account? <a href="<?php echo SITEURL;?>login.php">Sign in</a></p>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
        </div>

<?php 
    include('partial/footer.php'); 
?> 
<script>
    function chechvalidation(){
        let name = $('#fullname').val();
        let profile = $('#profile').val();
        let mobile = $('#mobile').val();
        let email = $('#email').val();
        let password = $('#password').val();
        iserror = 1;
   if(name == ''){
    //alert(67343);
    iserror = 0;
    $('#error_name').text('Please Enter Your Name');
    $('#fullname').focus();
   }else{
     $('#error_name').text('');
   }

   if(profile == ''){
    //alert(67343);
    iserror = 0;
    $('#error_profile').text('Please Enter A Profile Pic');
   }else{
     $('#error_profile').text('');
   }

   if(mobile == ''){
    //alert(67343);
    iserror = 0;
    $('#mobile').focus();
    $('#error_mobile').text('Please Enter Your Mobile Number');
   }else{
     $('#error_mobile').text('');
   }

   if(email == ''){
    //alert(67343);
    iserror = 0;
    $('#email').focus();
    $('#error_email').text('Please Enter Your Email');
   }else{
     $('#error_email').text('');
   }

   if(password == ''){
    //alert(67343);
    iserror = 0;
    $('#password').focus();
    $('#error_password').text('Please Enter A Strong Password');
   }else{
     $('#error_password').text('');
   }
   if(iserror == 1){
    let formdata = new FormData();
    $.ajax({
          url: "<?php echo SITEURL; ?>ajax/frontregister.php",
          type: "POST",
          data: new FormData($('#form')[0]),
          dataType: "JSON",
          contentType : false,
          processData : false,
          success: function(res) {
            // alert(res.iserror);
            // alert(res.errormsg);
            if (res.iserror == 0) {
                //console.log(iserr);
              example = res.errormsg;
              for (let key in example) {
                if (example.hasOwnProperty(key)) {
                    //alert(example);
                  value = example[key];
                  document.getElementById(key).innerHTML = value;

                }
              }
            } else {
              window.location.href = "<?php echo SITEURL; ?>";
            }
          }
        });
   }
   return false;
    }
</script>