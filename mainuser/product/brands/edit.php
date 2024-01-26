<?php
    //print_r($_GET);
    require('../../../global.php');
    $pagename = 'Brands';
    $groupname = 'Product';

  //print_r($_SESSION);
 // print_r($_POST);
  $get_user_data = $conn->query("select *  from brands where id = '".$_GET['id']."' ");
  // print_r($get_user_data);die;
  $f_data = $get_user_data->fetch_object();
  // prd($f_data);die;
  $name = $f_data->name;
  $brandimage = $f_data->image;
  $status = $f_data->status;
  //print_r($name);die;
  $iserror = 1;
  if (isset($_POST['name'])) {
    if (empty(trim($_POST['name']))) {
      $iserror = 0;
      $nameerr = "Please Enter Page Name";
    }
    if (empty(trim($_POST['status']))) {
      $iserror = 0;
      $statuserr = "Please Select page Status";
    }
    
      
      if($iserror == 1){
        $brandimg = $_POST['old_img'];
        $ext = pathinfo($_FILES['pageimg']['name'], PATHINFO_EXTENSION);
        $brandname = 'updated_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
        if (move_uploaded_file($_FILES['pageimg']['tmp_name'], '../../../upload/brands/' . $brandname)) {
          //echo $brandimg;die;
          $brandimg = $brandname;
          unlink('../../../upload/brands/'.$_POST['old_img']);
        }
        
        
        $updatedata = $conn->query("update `brands` set  name = '".$_POST['name']."', status = '".trim($_POST['status'])."', image = '".$brandimg ."', updated_at = '".date('Y-m-d H:i:s')."'   where id = '".$_GET['id']."'");
        // prd($updatedata);die;
        if($updatedata){
          $_SESSION['success_msg'] = 'Banner Updated Successfully';
          header("location:".SITEADMINURL.'product/brands');
        }else{
          $nameerr = "Unable To Process";
        }
      }
      //print_r($insert_data);
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
          <h1 class="m-0"><?php echo $pagename; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMINURL; ?>">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> / Edit</li>
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
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
                </div>
                
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Brands Image</label>
                    <input type="hidden" name="old_img" value="<?php echo $brandimage; ?>">
                    <input class="form-control" type="file" id="pageimg" name="pageimg">
                    <img src="<?php echo SITEURL;?>upload/brands/<?php echo $brandimage?>" width="80" >
                  </div>
                </div>
                <div class="col-md-12">
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
              <div class="form-group text-right">
                <input type="submit" id="inputProjectLeader" class="btn btn-success" value="Update">
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
<?php include("../../include/footer.php"); ?>