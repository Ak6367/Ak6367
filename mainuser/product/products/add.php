<?php
require('../../../global.php');
$pagename = 'Products';
$groupname = 'Product';
?>
<?php
//print_r($_SESSION);
// print_r($_POST);die;
// prd($_FILES);
$iserror = 1;
if (isset($_POST['name'])) {
  if (empty(trim($_POST['name']))) {
    $iserror = 0;
    $nameerr = "Please Enter Bannner Name";
  }
  if (empty(trim($_POST['code']))) {
    $iserror = 0;
    $codeerr = "Please Enter Code Name";
  }
  if (empty(trim($_POST['mrp']))) {
    $iserror = 0;
    $mrperr = "Please Enter Mrp Name";
  }
  if (empty(trim($_POST['price']))) {
    $iserror = 0;
    $priceerr = "Please Enter Price Name";
  }
  if (empty($_POST['status'])) {
    $iserror = 0;
    $statuserr = "Please Select Page Status";
  }
  if (empty($_POST['category'])) {
    $iserror = 0;
    $categoryerr = "Please Select Page Status";
  }
  if (empty($_POST['subcategory'])) {
    $iserror = 0;
    $scategoryerrerr = "Please Select Page Status";
  }
  if (empty($_POST['brand'])) {
    $iserror = 0;
    $branderr = "Please Select Page Status";
  }
  // $allowedExts = array("jpg", "jpeg", "gif", "png");
  // $extension = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
  // // prd(in_array($extension, $allowedExts));
  // // echo $extension;die;
  // if ((($_FILES["images"]["type"] == "image/gif") || ($_FILES["images"]["type"] == "image/jpeg") || ($_FILES["images"]["type"] == "image/webp") || ($_FILES["images"]["type"] == "image/png") || ($_FILES["images"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts)) {
  //   $iserror  = 1;
  // } else {
  //   $iserror  = 0;
  //   $imageserr = "profile picture allowed format is jpg, png, jpeg, gif";
  // }
  // $ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
  // if($_FILES['images']['name'] !=$ext('jpg' && 'png' && 'jpeg' && 'gif' && 'webp')){
  //   $iserror = 0;
  //   $profilepictureerr = "profile picture allowed format is jpg, png, jpeg, gif";
  // }
  // if (empty($_FILES['images']['name'])) {
  //   $iserror = 1;

  // } elseif($_FILES['images']['name'] !=$ext) {
  //   $ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
  //   if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
  //     $iserror = 0;
  //     $profilepictureerr = "profile picture allowed format is jpg, png, jpeg, gif";
  //   }
  // }

  if ($iserror == 1) {
      $mainimg = '';
      $ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
      $imgname = 'Brand_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
      if (move_uploaded_file($_FILES['images']['tmp_name'], '../../../upload/products/' . $imgname)) {
        $mainimg = $imgname;
      }
      // echo "insert into products set code = '" . mysqli_real_escape_string($conn,$_POST['code']) . "',name = '" .mysqli_real_escape_string($conn,$_POST['name']) . "', mrp = '" . $_POST['mrp'] . "', price = '" . $_POST['price'] . "', category_id = '" . $_POST['category'] . "', sub_category_id = '" . $_POST['subcategory'] . "', brand_id =  '" . $_POST['brand'] . "', description = '" .mysqli_real_escape_string($conn, $_POST['desc']) . "', is_latest='".$_POST['letest']."', is_featured='".$_POST['featured']."',status = '" . $_POST['status'] . "', image = '" . $mainimg . "', created_at = '" . date('Y-m-d H:i:s') . "' ";die;
      $insert_data = $conn->query("insert into products set code = '" . mysqli_real_escape_string($conn,$_POST['code']) . "',name = '" .mysqli_real_escape_string($conn,$_POST['name']) . "', mrp = '" . $_POST['mrp'] . "', price = '" . $_POST['price'] . "', category_id = '" . $_POST['category'] . "', sub_category_id = '" . $_POST['subcategory'] . "', brand_id =  '" . $_POST['brand'] . "', description = '" .mysqli_real_escape_string($conn, $_POST['desc']) . "', is_latest='".$_POST['letest']."', is_featured='".$_POST['featured']."',status = '" . $_POST['status'] . "', image = '" . $mainimg . "', created_at = '" . date('Y-m-d H:i:s') . "' ");
     
      if ($insert_data) {
        $last_id = $conn->insert_id;
        //prd($last_id);die;
        if (count($_FILES['gallery']['name']) > 0 ) {
          foreach ($_FILES['gallery']['name'] as $key => $val) {
            $ext = pathinfo($val, PATHINFO_EXTENSION);
            $fileName = 'Gallery_IMG_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
            //$targetFilePath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['gallery']['tmp_name'][$key], '../../../upload/products/galleryimage/' . $fileName)) {
              $insert_img = $conn->query("insert into product_images set product_id ='" . $last_id . "' ,image = '" . $fileName. "' ");
            }
          }
        }
        $_SESSION['success_msg'] = 'Product Added Successfully';
        header("location:" . SITEADMINURL . 'product/products');
      } else {
        $nameerr = "Unable To Process";
      }
    
  }
}
include("../../include/header.php");

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
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputCode">Code</label>
                    <input type="text" id="code" name="code" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_code"><?php echo isset($codeerr) ? $codeerr : ''; ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputMrp">Mrp</label>
                    <input type="text" id="mrp" name="mrp" onblur="checkprice()" value="<?php echo isset($_POST['mrp']) ? $_POST['mrp'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_mrp"><?php echo isset($mrperr) ? $mrperr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPrice">Price</label>
                    <input type="text" id="price" name="price" onblur="checkprice()" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_price"><?php echo isset($priceerr) ? $priceerr : ''; ?></p>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea rows="5" id="desc" name="desc" class="form-control"><?php echo isset($_POST['desc']) ? $_POST['desc'] : '' ?></textarea>
                  </div>
                  <p class="error" id="error_mrp"><?php echo isset($mrperr) ? $mrperr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Image">Image</label>
                    <input type="file" name="images" id="images" class="form-control">
                  </div>
                  <p class="error" id="error_img"><?php echo isset($imageserr) ? $imageserr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="galleryImage">Gallery</label>
                    <input type="file" multiple name="gallery[]" id="gallery" class="form-control">
                  </div>

                  <p class="error" id="error_img"><?php echo isset($imageserr) ? $imageserr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" onchange="getsubcategories(this.value)" class="form-control custom-select">
                      <option value="">Select Category</option>
                      <?php
                      $checkcat = $conn->query("select name,id from categories where dstatus = 0 && status = 1 ");
                      // $cat_id = $cat_data['id'];
                      while ($categorydata = $checkcat->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if (isset($_POST['category']) && $_POST['category'] == $categorydata['id']) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $categorydata['id'] . '" ' . $sel . '>' . $categorydata['name'] . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_category">
                    <?php echo isset($categoryerr) ? $categoryerr : '' ?>
                  </p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="subCategory">Sub Category</label>
                    <select name="subcategory" id="subcategory" class="form-control custom-select">
                      <option value="">Select Category</option>
                      <?php
                      $checkcat = $conn->query("select name,id from subcategories where dstatus = 0 && status = 1 ");
                      $cat_id = $cat_data['id'];
                      while ($categorydata = $checkcat->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if (isset($_POST['subcategory']) && $_POST['subcategory'] == $categorydata['id']) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $categorydata['id'] . '" ' . $sel . '>' . $categorydata['name'] . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_scategory">
                    <?php echo isset($scategoryerr) ? $scategoryerr : '' ?>
                  </p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputBrand">Brand</label>
                    <select name="brand" id="brand" class="form-control custom-select">
                      <option value="">Select Brand</option>
                      <?php
                      $checkcat = $conn->query("select name,id from brands where dstatus = 0 && status = 1 ");
                      //$cat_id = $cat_data['id'];
                      while ($branddata = $checkcat->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if (isset($_POST['brand']) && $_POST['brand'] == $branddata['id']) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $branddata['id'] . '" ' . $sel . '>' . $branddata['name'] . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_brand">
                    <?php echo isset($branderr) ? $branderr : '' ?>
                  </p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputStatus" style="text-align: center;">Status</label>
                    <select name="status" id="inputStatus" class="form-control custom-select">
                      <option value="">Select Status</option>
                      <?php
                      foreach ($statusarr as $key => $value) {
                        $sel = '';
                        if (isset($_POST['status']) && $_POST['status'] == $key) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $key . '" ' . $sel . '>' . $value . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_status"><?php echo isset($statuserr) ? $statuserr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="isLatest" style="text-align: center;">Latest</label>
                    <select name="letest" id="letest" class="form-control custom-select">
                      <option value="">Select One</option>
                      <option value="1" <?php echo isset($_POST['letest']) &&  $_POST['letest'] == 1?'selected':''; ?>>Yes</option>
                      <option value="0" <?php echo isset($_POST['letest']) &&  $_POST['letest'] == 0?'selected':''; ?>>No</option>
                      
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="featured" style="text-align: center;">Featured</label>
                    <select name="featured" id="featured" class="form-control custom-select">
                      <option value="">Select One</option>
                      <option value="1" <?php echo isset($_POST['featured']) &&  $_POST['featured'] == 1?'selected':''; ?>>Yes</option>
                      <option value="0" <?php echo isset($_POST['featured']) &&  $_POST['featured'] == 0?'selected':''; ?>>No</
                    </select>
                  </div>
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
<?php include("../../include/footer.php"); ?>
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
</script>