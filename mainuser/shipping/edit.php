<?php
    //print_r($_GET);
require('../../global.php');
$pagename = 'Shipping';
$groupname = 'Shipping';
  //print_r($_SESSION);
 // print_r($_POST);
  $get_user_data = $conn->query("select *  from shippings where id = '".$_GET['id']."' ");
  // print_r($get_user_data);die;
  $f_data = $get_user_data->fetch_object();
  // prd($f_data);die;
  $pincode = $f_data->pincode;
  $amount = $f_data->amount;
  //print_r($name);die;
  if (isset($_POST['pincode'])) {
  $iserror = 1;
  if (empty(trim($_POST['pincode']))) {
    $iserror = 0;
    $pinerr = "Please Enter Your Area Pincode";
  }
  if (empty($_POST['amount'])) {
    $iserror = 0;
    $amounterr = "Please Enter Amount";
  }
      
      if($iserror == 1){
       // echo "update `shippings` set  pincode = '".$_POST['pincode']."', amount='".$_POST['amount']."', updated_at = '".date('Y-m-d H:i:s')."'   where id = '".$_GET['id']."'";die;
        $updatedata = $conn->query("update `shippings` set  pincode = '".$_POST['pincode']."', amount='".$_POST['amount']."', updated_at = '".date('Y-m-d H:i:s')."'   where id = '".$_GET['id']."'");
        // prd($updatedata);
        if($updatedata){
          $_SESSION['success_msg'] = 'Banner Updated Successfully';
          header("location:".SITEADMINURL.'shipping/');
        }else{
          $nameerr = "Unable To Process";
        }
      }
      //print_r($insert_data);
    }
include("../include/header.php");

?>



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
                    <label for="inputName">Pincode</label>
                    <input type="text" id="pincode" name="pincode" value="<?php echo isset($pincode) ? $pincode : ''; ?>" class="form-control">
                  </div>
                  <p class="error" id="error_pin"><?php echo isset($pinerr) ? $pinerr : ''; ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="<?php echo isset($amount)?$amount:''; ?>">
                  </div>
                  <p class="error" id="error_amount">
                    <?php echo isset($amounterr) ? $amounterr : '' ?>
                  </p>
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
    function checkvalidation() {
    iserror = 1;
    let pincode = document.getElementById('pincode').value;
    let amount = document.getElementById('amount').value;
    
    // alert(pincode);
    // alert(amount);
    if (pincode == '') {
      document.getElementById('error_pin').innerHTML = 'Please Enter Your Area Pincode';
      iserror = 0;
    } else {
      document.getElementById('error_pin').innerHTML = '';
    }
    if (amount == '') {
      document.getElementById('error_amount').innerHTML = 'Please Enter Amount';
      iserror = 0;
    } else {
      document.getElementById('error_amount').innerHTML = '';
    }
    if (iserror == 1) {
      return true;
    }
    return false
  }
</script>
<?php include("../include/footer.php"); ?>