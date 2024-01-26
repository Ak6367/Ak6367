<?php
require('../../global.php');
$pagename = 'Site Setting';
$groupname = 'Site Setting';
// prd($_FILES);
// prd($_POST);die;
$get_data = $conn->query("select * from `site_settings` where id = 1 ");
// prd($get_data);
if($get_data->num_rows > 0){
$site_data = $get_data->fetch_array();
// prd($productdata);die;
$name = $site_data['name'];
$email = $site_data['email']; 
$contact = $site_data['contact_no'];
$logo = $site_data['logo'];
$fav_image = $site_data['fav_image'];
$address = $site_data['address'];
$fb_page_link = $site_data['facebook_page_link'];
$ig_page_link = $site_data['instagram_page_link'];
$yt_page_link = $site_data['youtube_page_link'];
$twitter_page_link = $site_data['twitter_page_link'];
$footer_scripts = $site_data['footer_scripts'];
$header_scripts = $site_data['header_scripts'];
}
    if(isset($_POST['name'])){
        $logo = $_POST['old_logo_img'];
      $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
      $imgname = 'Logo_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
      if (move_uploaded_file($_FILES['logo']['tmp_name'], '../../upload/sitesetting/' . $imgname)) {
        $logo = $imgname;
        unlink('../../upload/sitesetting/'.$_POST['old_logo_img']);
      }
      $favIcon = $_POST['old_fav_img'];
      $ext = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
      $favname = 'Favicon_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
      if (move_uploaded_file($_FILES['favicon']['tmp_name'], '../../upload/sitesetting/' . $favname)) {
        $favIcon = $favname;
        unlink('../../upload/sitesetting/'.$_POST['old_fav_img']);
      }

      $insert_data = $conn->query("update `site_settings` set email = '" . $_POST['email'] . "',name = '" . $_POST['name'] . "', contact_no = '" . $_POST['contact'] . "', address = '" .mysqli_escape_string($conn,$_POST['address'])  . "', logo = '" . $logo. "', fav_image = '" . $favIcon . "', facebook_page_link =  '" . mysqli_escape_string($conn,$_POST['facebook']) . "', instagram_page_link = '" . mysqli_escape_string($conn,$_POST['instagram']) . "', youtube_page_link = '" . mysqli_escape_string($conn,$_POST['youtube']) . "', twitter_page_link = '" . mysqli_escape_string($conn,$_POST['twitter']) . "',footer_scripts = '".mysqli_escape_string($conn,$_POST['footer'])."',header_scripts = '".mysqli_escape_string($conn,$_POST['header'])."', updated_at = '" . date('Y-m-d H:i:s') . "' where id = 1 ");
      // prd($insert_data);die;
     
      if ($insert_data) {
        $_SESSION['success_msg'] = 'Setting Changed Successfully';
        header("location:" . SITEADMINURL . 'sitesetting/');
      } else {
        $nameerr = "Unable To Process";
      }
    
  


    }
    include("../include/header.php");   

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <?php echo $pagename; ?>
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMINURL; ?>">Home</a></li>
            <li class="breadcrumb-item active">
              <?php echo $pagename; ?> / Add New
            </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="" method="post" enctype="multipart/form-data" onsubmit="return checkvalidation()">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">
                <?php echo $pagename; ?>
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name: '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputCode">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_code"><?php echo isset($codeerr) ? $codeerr : ''; ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputMrp">Address</label>
                    <input type="text" id="address" name="address" onblur="checkprice()" value="<?php echo isset($address) ? $address : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_mrp"><?php echo isset($mrperr) ? $mrperr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Contact</label>
                    <input type="text" id="contact" name="contact" onblur="checkprice()" value="<?php echo isset($contact) ? $contact : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_price"><?php echo isset($priceerr) ? $priceerr : ''; ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputMrp">Logo</label>
                    <input type="hidden" name="old_logo_img" value="<?php echo $logo; ?>">
                    <input type="file" id="logo" name="logo" class="form-control">
                    <img src="<?php echo SITEURL;?>upload/sitesetting/<?php echo $logo;?>" width="80" style="border: 2px solid gray ; border-radius: 20px; padding: 10px;">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputMrp">Favicon</label>
                    <input type="hidden" name="old_fav_img" value="<?php echo $fav_image; ?>">
                    <input type="file" id="favicon" name="favicon" class="form-control">
                    <img src="<?php echo SITEURL;?>upload/sitesetting/<?php echo $fav_image;?>" width="40" style="border: 2px solid gray ; border-radius: 20px; padding: 10px;">
                  </div>
                </div>

                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Facebook</label>
                    <input type="text" id="facebook" name="facebook" onblur="checkprice()" value="<?php echo isset($fb_page_link) ? $fb_page_link : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Instagram</label>
                    <input type="text" id="instagram" name="instagram" onblur="checkprice()" value="<?php echo isset($ig_page_link) ? $ig_page_link : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Youtube</label>
                    <input type="text" id="youtube" name="youtube" onblur="checkprice()" value="<?php echo isset($yt_page_link) ? $yt_page_link : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Twitter</label>
                    <input type="text" id="twitter" name="twitter" onblur="checkprice()" value="<?php echo isset($twitter_page_link) ? $twitter_page_link : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Heaaer Scripts</label>
                    <input type="text" id="header" name="header" onblur="checkprice()" value="<?php echo isset($header_scripts) ? $header_scripts : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Footer Scripts</label>
                    <input type="text" id="footer" name="footer" onblur="checkprice()" value="<?php echo isset($footer_scripts) ? $footer_scripts : '' ?>" class="form-control">
                  </div>
                </div>

              <div class="form-group text-right">
                <input type="submit" id="inputProjectLeader" class="btn btn-success" value="ADD">
                <a href="" class="btn btn-danger">Cancel</a>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

        </div>
      </form>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("../include/footer.php"); ?>
<script>
  function checkvalidation() {
    iserror = 1;
    let name = document.getElementById('name').value;
    let status = document.getElementById('inputStatus').value;
    // let image = document.getElementById('images').value;
    let code = document.getElementById('code').value;
    let mrp = document.getElementById('mrp').value;
    let price = document.getElementById('price').value;
    let category = document.getElementById('category').value;
    let subcategory = document.getElementById('subcategory').value;
    let brand = document.getElementById('brand').value;
    let latest = document.getElementById('letest').value;
    let featured = document.getElementById('featured').value;
    // alert(name);
    var fileInput = document.getElementById('images');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
    if (name == '') {
      document.getElementById('error_name').innerHTML = 'Please Enter Page Name';
      iserror = 0;
    } else {
      document.getElementById('error_name').innerHTML = '';
    }
    if (code == '') {
      document.getElementById('error_code').innerHTML = 'Please Enter Product Code';
      iserror = 0;
    } else {
      document.getElementById('error_code').innerHTML = '';
    }
    if (mrp == '') {
      document.getElementById('error_mrp').innerHTML = 'Please Enter Product Mrp';
      iserror = 0;
    } else {
      document.getElementById('error_mrp').innerHTML = '';
    }
    if (price == '') {
      document.getElementById('error_price').innerHTML = 'Please Enter Product Price';
      iserror = 0;
    } else {
      document.getElementById('error_price').innerHTML = '';
    }
    if (category == '') {
      document.getElementById('error_category').innerHTML = 'Please  Selct Your Category';
      iserror = 0;
    } else {
      document.getElementById('error_category').innerHTML = '';
    }
    if (subcategory == '') {
      document.getElementById('error_scategory').innerHTML = 'Please Selct Your Subcategory';
      iserror = 0;
    } else {
      document.getElementById('error_scategory').innerHTML = '';
    }
    if (brand == '') {
      document.getElementById('error_brand').innerHTML = 'Please Select Your Brand';
      iserror = 0;
    } else {
      document.getElementById('error_brand').innerHTML = '';
    }
    if (latest == '') {
      document.getElementById('error_latest').innerHTML = 'Please Select One';
      iserror = 0;
    } else {
      document.getElementById('error_latest').innerHTML = '';
    }
    if (featured == '') {
      document.getElementById('error_featured').innerHTML = 'Please Select One';
      iserror = 0;
    } else {
      document.getElementById('error_featured').innerHTML = '';
    }
    if (status == '') {
      document.getElementById('error_status').innerHTML = 'Please Enter Page Status';
      iserror = 0;
    } else {
      document.getElementById('error_status').innerHTML = '';
    }
    // if (!allowedExtensions.exec(filePath)) {
    //   document.getElementById('error_img').innerHTML = 'Please upload file having extensions jpeg , jpg , png , gif only.';
    //   iserror = 0;
    // } else {
    //   document.getElementById('error_img').innerHTML = '';
    // }
    if (iserror == 1) {
      return true;
    }
    return false
  }

  function getsubcategories(categoryid) {
    $.ajax({
      url: "<?php echo SITEADMINURL; ?>ajax/subcategory.php",
      type: "post",
      data: {
        categoryid: categoryid
      },
      success: function(response) {
        //alert(reponse);
        $('#subcategory').html(response);
      }
    });
  }

  function checkprice() {
    var mrp = parseFloat($('#mrp').val());
    var price = parseFloat($('#price').val());
    if (mrp < price) {
      $('#price').val('');
      document.getElementById('error_price').innerHTML = "Price value should be less than Mrp";
    }
  }
  $('#name').change(function() {
    var nameval = $('#name').val();
    txtVal = nameval.toLowerCase().replace(/\s/g, '-');
    $('#code').val(txtVal);
  });
  function removegal(gellaryid){
    $.ajax({
      url: "<?php echo SITEADMINURL; ?>ajax/gallarydelete.php",
      type: "post",
      data: {
        galleryid: gellaryid
      },
      success: function(response) {
        $('#gal_'+gellaryid).remove();
      }
    });
  }
</script>