<?php
require('../../global.php');
$pagename = 'Banners';
$groupname = 'Banners';
?>
<?php
//print_r($_SESSION);

// prd($cat_id);die;
$iserror = 1;
// print_r($_FILES);
if (isset($_POST['title'])) {
  if (empty(trim($_POST['title']))) {
    $iserror = 0;
    $titleerr = "Please Enter Bannner Title";
  }
  if (empty(trim($_POST['status']))) {
    $iserror = 0;
    $statuserr = "Please Enter Bannner Status";
  }
  if (empty(trim($_POST['category']))) {
    $iserror = 0;
    $catgoryerr = "Please Select Category";
  }
  if (empty($_FILES['bannerimg']['name'])) {
    $iserror = 0;
    $imageerr = "Please Enter Bannner Image";
  } else {
    $ext = pathinfo($_FILES['bannerimg']['name'], PATHINFO_EXTENSION);
    if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
      $iserror = 0;
      $profilepictureerr = "profile picture allowed format is jpg, png, jpeg, gif";
    }
  }

  if ($iserror == 1) {
    // prd($iserror);die;
    $bannerimg = '';
    $bannername = 'Banner_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
    if (move_uploaded_file($_FILES['bannerimg']['tmp_name'], '../../upload/banners/' . $bannername)) {
     $bannerimg = $bannername;
    }
    $link = SITEADMINURL.'banners/'.$_POST['link'];
    ########################################################################################################
    // echo "insert into banner_categories set category_id= '".$cat_id."', title = '".$_POST['title']."', status = '".$_POST['status']."',sub_title ='".$_POST['stitle']."', description = '".$_POST['description']."', link = '".$link."', button_text = '".$_POST['bt_text']."', banner_image = '".$bannerimg ."', created_at = '".date('Y-m-d H:i:s')."', updated_at = '".date('Y-m-d H:i:s')."', dstatus = 0 ";die;
    ########################################################################################################
    $insert_data = $conn->query("insert into banners set category_id= '".$_POST['category']."', title = '".$_POST['title']."', status = '".trim($_POST['status'])."',sub_title ='".trim($_POST['stitle'])."', description = '".trim($_POST['description'])."', link = '".$link."', button_text = '".trim($_POST['bt_text'])."', banner_image = '".$bannerimg ."', created_at = '".date('Y-m-d H:i:s')."' ");

    if($insert_data){
      $_SESSION['success_msg'] = 'Banner Added Successfully';
      header("location:".SITEADMINURL.'banners');
    }else{
      $nameerr = "Unable To Process";
    }
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
          <h1 class="m-0"><?php echo $pagename; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMINURL; ?>">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> / Add New</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="" method="post" onsubmit="return checkvalidation()" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $pagename; ?></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control">
                      </div>
                  </div> -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_title"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
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
                  <p class="error" id="error_status"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control custom-select">
                      <option value="">Select Category</option>
                      <?php
      $bannercat = $conn->query("select name,id from banner_categories where dstatus = 0 && status = 1 ");
                      $cat_id = $cat_data['id'];
                      while ($categorydata = $bannercat->fetch_assoc()) {
                        prd($value);
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
                  <p class="error" id="error_category"><?php echo isset($catgoryerr) ? $catgoryerr : '' ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Sub Title</label>
                    <input type="text" id="sub_title" name="stitle" value="<?php echo isset($_POST['stitle']) ? $_POST['stitle'] : '' ?>" class="form-control">
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Description</label>
                    <input type="text" id="description" name="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Link</label>
                    <input type="text" id="link" name="link" value="<?php echo isset($_POST['link']) ? $_POST['link'] : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Button Text</label>
                    <input type="text" id="bt_text" name="bt_text" value="<?php echo isset($_POST['bt_text']) ? $_POST['bt_text'] : '' ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Banner Image</label>
                    <input class="form-control" type="file" id="formFile" name="bannerimg">
                  </div>
                  <p class="error" id="error_banimg"><?php echo isset($imageerr) ? $imageerr : '' ?></p>
                </div>


              </div>
              <!-- <div class="row">
                <div class="col-md-6">
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
                </div>
                <div class="col-md-6">
                  <p class="error" id="error_status"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                </div>
              </div> -->


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
<script>
  function checkvalidation(){
    iserror = 1;
    let status = document.getElementById('inputStatus').value;
    let title = document.getElementById('title').value;
    let bannerimg = document.getElementById('formFile').value;
    let category = document.getElementById('category').value;

    // alert(status);
    // alert(title);
    // alert(bannerimg);

    if(title == ''){
      document.getElementById('error_title').innerHTML= 'Please Enter Bannner Title';
      iserror = 0;
    }else{
      document.getElementById('error_title').innerHTML='';
    }
    if(status == ''){
      document.getElementById('error_status').innerHTML= 'Please Enter Bannner Status';
      iserror = 0;
    }else{
      document.getElementById('error_status').innerHTML='';
    }
    if(bannerimg == ''){
      document.getElementById('error_banimg').innerHTML= 'Please Select Bannner Image';
      iserror = 0;
    }else{
      document.getElementById('error_banimg').innerHTML='';
    }
    if(category == ''){
      document.getElementById('error_category').innerHTML= 'Please Select Bannner Image';
      iserror = 0;
    }else{
      document.getElementById('error_category').innerHTML='';
    }

    if(iserror == 1){
      return true;
    }
    return false
  }
</script>
<?php include("../include/footer.php"); ?>