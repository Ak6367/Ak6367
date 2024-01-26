<?php
    //print_r($_GET);
require('../../global.php');
$pagename = 'Coupones';
$groupname = 'Coupones';

  //print_r($_SESSION);
 // print_r($_POST);
  $get_user_data = $conn->query("select *  from coupones where id = '".$_GET['id']."' ");
  // print_r($get_user_data);die;
  $f_data = $get_user_data->fetch_object();
  // prd($f_data);die;
  $user_id = $f_data->user_id;
  $type = $f_data->type;
  $value = $f_data->value;
  $startdate = $f_data->start_date;
  $enddate = $f_data->end_date;
  $multiple = $f_data->is_multiple;
  //print_r($name);die;
//print_r($_SESSION);
// print_r($_POST);die;

$iserror = 1;
if (isset($_POST['coupones'])) {
  if (empty(trim($_POST['code']))) {
    $iserror = 0;
    $codeerr = "please add a unique code";
  }
  if ($_POST['coupones'] == '') {
    $iserror = 0;
    $couponeerr = ucwords("please enter coupon user type");
  }
  if (empty(trim($_POST['type']))) {
    $iserror = 0;
    $typeerr = ucwords("please select type");
  }
  if (empty($_POST['value'])) {
    $iserror = 0;
    $valueerr = ucwords("please add value");
  }
  if (empty($_POST['startdate'])) {
    $iserror = 0;
    $startdateerr = "Please Enter Coupon Start Date";
  }
  if (empty($_POST['enddate'])) {
    $iserror = 0;
    $enddateerr = "Please Enter Coupon End Date";
  } 
  if ($_POST['multiple'] == '') {
    $iserror = 0;
    $multipleerr = "Select One";
  } 


  if ($iserror == 1) {
    if($checksql->num_rows > 0){
      $codeerr = 'Coupon Code Already Taken';
    }else{
      $insert_data = $conn->query("update `coupones` set `code` = '" . $_POST['code'] . "', user_id='" . $_POST['coupones'] . "', `type` = '" . $_POST['type'] . "', value   = '" . $_POST['value'] . "', start_date = '".$_POST['startdate']."', end_date = '".$_POST['enddate']."', is_multiple = '".$_POST['multiple']."', `updated_at` = '" . date('Y-m-d H:i:s') . "' where id = '".$_GET['id']."' ");

      if ($insert_data) {
        $_SESSION['success_msg'] = 'Coupon Added Successfully';
        header("location:" . SITEADMINURL . 'coupones');
      } else {
        $nameerr = "Unable To Process";
      }
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
                    <label for="inputName">Code</label>
                    <input type="text" name="code" id="code" value="<?php echo isset($_POST['code'])?$_POST['code']:''; ?>"  class="form-control">
                  </div>
                  <p class="error" id="error_code"><?php echo isset($codeerr) ? $codeerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Coupones">Coupones</label>
                    <select name="coupones" id="coupones" class="form-control custom-select">
                      <option value="">Select User Type</option>
                      <option value="0" <?php echo isset($user_id) && $user_id == 0 ?'selected':'';?>>All User</option>
                      <?php 
                        $front_user = $conn->query("select id,name from users where type='fronted' && status=1 order by name desc");
                        // prd($front_user);
                        while($front_user_data = $front_user->fetch_array()){
                          $select ='';
                          if($user_id == $front_user_data['id']){
                            $select = 'selected';
                          }
                          echo '<option value="'.$front_user_data['id'].'" '.$select.'>'.$front_user_data['name'].'</option>';
                        }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_coupones">
                    <?php echo isset($couponeerr) ? $couponeerr : ''; ?>
                  </p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <label for="Coupones">Type</label>
                  <select name="type" id="type" class="form-control custom-select" onchange="checkvalue();">
                      <option value="">Select Coupone Type</option>
                      <option value="1" <?php echo isset($type) && $type == 1?'selected':'';?>>Percentage</option>
                      <option value="2"<?php echo isset($type) && $type == 2?'selected':'';?>>Fixed</option>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_type"><?php echo isset($typeerr) ? $typeerr : ''; ?></p>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputStatus">Value</label>
                    <input type="text" name="value" id="value" value="<?php echo isset($value)?$value:'';?>"  class="form-control" onchange="checkvalue();">
                  </div>
                  <p class="error" id="error_value"><?php echo isset($valueerr) ? $valueerr : ''; ?></p>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">Start Date</label>
                    <input type="date" name="startdate" id="startdate" value="<?php echo isset($startdate)?$startdate:''; ?>"  class="form-control">
                  </div>
                  <p class="error" id="error_startdate"><?php echo isset($startdateerr) ? $startdateerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName">End Date</label>
                    <input type="date" name="enddate" id="enddate" value="<?php echo isset($enddate)?$enddate:''; ?>"  class="form-control">
                  </div>
                  <p class="error" id="error_enddate"><?php echo isset($enddateerr) ? $enddateerr : ''; ?></p>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <label for="Coupones">Multiple</label>
                  <select name="multiple" id="multiple" class="form-control custom-select">
                      <option value="">Select Coupone Type</option>
                      <option value="0" <?php echo isset($multiple) && $multiple == 0?'selected':'';?>>Yes</option>
                      <option value="1"<?php echo isset($multiple) && $multiple == 1?'selected':'';?>>No</option>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_multiple"><?php echo isset($multipleerr) ? $multipleerr : ''; ?></p>
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
  function checkvalidation() {
    iserror = 1;
    //let code = document.getElementById('code').value;
    let coupones = document.getElementById('coupones').value;
    let type = document.getElementById('type').value;
    let value = document.getElementById('value').value;
    let startdate = document.getElementById('startdate').value;
    let enddate = document.getElementById('enddate').value;
    //let multiple = document.getElementById('multiple').value;
    let multiple = $('#multiple').val();
    // alert(name);
    // alert(status);
    // if (code == '') {
    //   document.getElementById('error_code').innerHTML = 'Please Enter Page Name';
    //   iserror = 0;
    // } else {
    //   document.getElementById('error_code').innerHTML = '';
    // }
    if (coupones == '') {
      //$('#error_coupones').html('Please Enter Coupones');
      $('#error_coupones').text('Please Enter Coupones');
      $('#coupones').css('border','black');
      //document.getElementById('error_coupones').innerHTML = 'Please Enter Coupones';
      iserror = 0;
    } else {
      $('#error_coupones').text('');
      $('#coupones').focus();
      $('#coupones').css('border','red');
      //document.getElementById('error_coupones').innerHTML = '';
    }
    if (type == '') {
      document.getElementById('error_type').innerHTML = 'Please Select Coupon Type';
      iserror = 0;
    } else {
      document.getElementById('error_type').innerHTML = '';
    }
    if (value == '') {
      document.getElementById('error_value').innerHTML = 'Please Enter Coupon Value';
      iserror = 0;
    } else {
      document.getElementById('error_value').innerHTML = '';
    }
    if (startdate == '') {
      document.getElementById('error_startdate').innerHTML = 'Please Enter Coupon Start Date';
      iserror = 0;
    } else {
      document.getElementById('error_startdate').innerHTML = '';
    }
    if (enddate == '') {
      document.getElementById('error_enddate').innerHTML = 'Please Enter Coupon End Date';
      iserror = 0;
    } else {
      document.getElementById('error_enddate').innerHTML = '';
    }
    if (multiple == '') {
      document.getElementById('error_multiple').innerHTML = 'Please Enter Kuch Bhi';
      iserror = 0;
    } else {
      document.getElementById('error_multiple').innerHTML = '';
    }

    if (iserror == 1) {
      return true;
    }
    return false
  }


  function checkvalue(){
    $('#error_value').text('');
      let type = $('#type').val(); 
      let value = $('#value').val(); 
      if(type==1 && value>100){
        $('#value').val('');
        $('#error_value').html('<span style="color:blue;">Percentage value max allowed 100%</span>');
      }
  }
  
</script>
<?php include("../include/footer.php"); ?>