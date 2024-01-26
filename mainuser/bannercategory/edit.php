<?php
    //print_r($_GET);
require('../../global.php');
$pagename = 'Banner Category';
$groupname = 'Banners';
?>
<?php
  //print_r($_SESSION);
 // print_r($_POST);
  $get_user_data = $conn->query("select *  from banner_categories where id = '".$_GET['id']."' ");
  // print_r($get_user_data);die;
  $f_data = $get_user_data->fetch_object();
  $name = $f_data->name;
  $status = $f_data->status;
  //print_r($name);die;
  $iserror = 1;
    if(isset($_POST['name'])){
      if(empty(trim($_POST['name']))){
        $iserror = 0;
        $nameerr = "Please Enter Bannner Name";
      }
      if(empty($_POST['status'])){
        $iserror = 0;
        $statuserr = "Please Enter Bannner Status";
      }
      
      if($iserror == 1){
        $updatedata = $conn->query("update `banner_categories` set `name` = '".$_POST['name']."', `status` = '".$_POST['status']."', `updated_at` = '".date('Y-m-d H:i:s')."'  where id = '".$_GET['id']."'");
        // prd($updatedata);
        if($updatedata){
          $_SESSION['success_msg'] = 'Banner Added Successfully';
          header("location:".SITEADMINURL.'bannercategory');
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
            <h1 class="m-0"><?php echo $pagename;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo SITEADMINURL;?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $pagename;?> / Add New</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="" method="post" onsubmit="return checkvalidation()">
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit <?php echo $pagename;?></h3>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $name; ?> " class="form-control" placeholder="<?php echo $name; ?>">
                      </div>
                  </div>
                 
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select name="status" id="inputStatus" class="form-control custom-select">
                          <option value="">Select Status</option>
                            <?php 
                              foreach($statusarr as $key=>$value){
                                $sel = '';
                                if($status==$key){
                                  $sel = 'selected';
                                }
                                echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
                              }
                          ?>
                          </option> 
                        </select>
                      </div>
                  </div>
                 
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p class="error" id="error_name"><?php echo isset($nameerr)?$nameerr:'' ?></p>
                </div>
                <div class="col-md-6">
                  <p class="error" id="error_status"><?php echo isset($statuserr)?$statuserr:'' ?></p>
                </div>
              </div>
             

              <div class="form-group text-right">
                <input type="submit" id="inputProjectLeader" class="btn btn-success" value="Edit">
                <a href="<?php echo SITEADMINURL;?>bannercategory" onclick="alert('Are You Sure')" class="btn btn-danger">Cancel</a>
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
    let name = document.getElementById('name').value;
    let status = document.getElementById('inputStatus').value;
    // alert(name);
    // alert(status);
    if(name == ''){
      document.getElementById('error_name').innerHTML= 'Please Enter Bannner Name';
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
    
    if(iserror == 1){
      return true;
    }
    return false
  }
  </script>
 <?php include("../include/footer.php");?>
?>