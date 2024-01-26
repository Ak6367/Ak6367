<?php
    //print_r($_GET);
require('../../global.php');
$pagename = 'Pages';
$groupname = 'Pages';

  //print_r($_SESSION);
 // print_r($_POST);
  $get_user_data = $conn->query("select *  from pages where id = '".$_GET['id']."' ");
  // print_r($get_user_data);die;
  $f_data = $get_user_data->fetch_object();
  // prd($f_data);die;
  $name = $f_data->name;
  $content = $f_data->content;
  $pageimage = $f_data->image;
  $status = $f_data->status;
  $category = $f_data->category_id;
  //print_r($name);die;
  $iserror = 1;
  if (isset($_POST['name'])) {
    if (empty(trim($_POST['name']))) {
      $iserror = 0;
      $titleerr = "Please Enter Page Name";
    }
    if (empty(trim($_POST['status']))) {
      $iserror = 0;
      $statuserr = "Please Select page Status";
    }
    if (empty(trim($_POST['category']))) {
      $iserror = 0;
      $catgoryerr = "Please Select Category";
    }
      
      if($iserror == 1){
        $pageimg = $_POST['old_img'];
        $ext = pathinfo($_FILES['pageimg']['name'], PATHINFO_EXTENSION);
        $page_imgname = 'updated_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
        if (move_uploaded_file($_FILES['pageimg']['tmp_name'], '../../upload/pages/' . $page_imgname)) {
          $pageimg = $page_imgname;
          unlink('../../upload/pages/'.$_POST['old_img']);
        }
        
        
        $updatedata = $conn->query("update `pages` set  name = '".$_POST['name']."', category_id='".$_POST['category']."', status = '".trim($_POST['status'])."', image = '".$pageimg ."', updated_at = '".date('Y-m-d H:i:s')."'   where id = '".$_GET['id']."'");
        // prd($updatedata);
        if($updatedata){
          $_SESSION['success_msg'] = 'Page Updated Successfully';
          header("location:".SITEADMINURL.'pages/');
        }else{
          $nameerr = "Unable To Process";
        }
      }
      //print_r($insert_data);
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
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Title</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select name="status" id="inputStatus" class="form-control custom-select">
                      <option value="">Select Status</option>
                      <?php
                      foreach ($statusarr as $key => $value) {
                        $sel = '';
                        if ($status == $key) {
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
                          $bannercat = $conn->query("select name,id from page_category where dstatus = 0 && status = 1 ");
                      $cat_id = $cat_data['id'];
                      while ($categorydata = $bannercat->fetch_assoc()) {
                        // prd($value);die;
                         $sel = '';
                        if ($category == $categorydata['id']) {
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
                    <label for="inputName">Page Image</label>
                    <input type="hidden" name="old_img" value="<?php echo $pageimage; ?>">
                    <input class="form-control" type="file" id="pageimg" name="pageimg">
                    <img src="<?php echo SITEURL;?>upload/pages/<?php echo $pageimage?>" width="80" >
                  </div>
                  <p class="error" id="error_pageimg"><?php echo isset($imageerr) ? $imageerr : '' ?></p>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputName">Content</label>
                    <textarea type="text" id="content" name="content" class="form-control"><?php echo isset($content) ? $content : '' ?></textarea>
                  </div>
                  <p class="error" id="error_content"><?php echo isset($contenterr) ? $contenterr : ''; ?></p>
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
<script>
  function checkvalidation(){
    iserror = 1;
    let status = document.getElementById('inputStatus').value;
    let name = document.getElementById('name').value;
    let pageimg = document.getElementById('pageimg').value;
    let category = document.getElementById('category').value;
    let content = document.getElementById('content').value;

    // alert(status);
    // alert(name);
    // alert(bannerimg);

    if(name == ''){
      document.getElementById('error_name').innerHTML= 'Please Enter Page Name';
      iserror = 0;
    }else{
      document.getElementById('error_name').innerHTML='';
    }
    if(status == ''){
      document.getElementById('error_status').innerHTML= 'Please Enter Bannner Status';
      iserror = 0;
    }else{
      document.getElementById('error_status').innerHTML='';
    }
    if(pageimg == ''){
      document.getElementById('error_pageimg').innerHTML= 'Please Select Bannner Image';
      iserror = 0;
    }else{
      document.getElementById('error_pageimg').innerHTML='';
    }
    if(category == ''){
      document.getElementById('error_category').innerHTML= 'Please Select Bannner Image';
      iserror = 0;
    }else{
      document.getElementById('error_category').innerHTML='';
    }
    if(content == ''){
      document.getElementById('error_content').innerHTML= 'Please Select Bannner Image';
      iserror = 0;
    }else{
      document.getElementById('error_content').innerHTML='';
    }

    if(iserror == 1){
      return true;
    }
    return false
  }
</script>
<?php include("../include/footer.php"); ?>