<?php 
	include("../../global.php");
	$pagename = 'city';
  $iserror = 0;
  if(isset($_POST['name'])){
    if(empty(trim($_POST['name']))){
      $iserror = 1;
      $nameerr = ucwords('Please Enter country name');
    }
    if($iserror == 0){
      $checkCountry = $conn->query("select * from city where name='".$_POST['name']."' ");
      if($checkCountry->num_rows > 0){
        $nameerr = ucwords('duplicate entry');
      }else{
        $insertQuery = $conn->query("UPDATE city SET name='".$_POST['name']."', status='".$_POST['status']."', country_id ='".$_POST['country']."', state_id='".$_POST['state']."', updated_at='".date('Y-m-d H:i:s')."' where id='".$_GET['id']."' ");
        if($insertQuery){
          $_SESSION['success_msg'] = ucwords('city added sucessfuly');
          header("location:".SITEADMINURL.'city');
        }
      }
    }
  }
  $getCitySql = $conn->query("select * from city where id ='".$_GET['id']."' ");
  if($getCitySql->num_rows > 0){
    $fetchCity = $getCitySql->fetch_object();
    $cityName =  $fetchCity->name;
    $country_id =  $fetchCity->country_id;
    $state_id =  $fetchCity->state_id;
    $status =  $fetchCity->status;
  }else{
    header("location:".SITEADMINURL.'city');
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
                    <label for="inputName">City Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $cityName ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="subCategory">Country</label>
                    <select name="country" id="country" onchange="getstate(this.value);" class="form-control custom-select">
                      <option value="">Select Country</option>
                      <?php
                      $check_country = $conn->query("select name,id from country where dstatus = 0 && status = 1 ");
                      while ($countrydata = $check_country->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if ($country_id == $countrydata['id']) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $countrydata['id'] . '" ' . $sel . '>' . $countrydata['name'] . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_country">
                    <?php echo isset($countryerr) ? $countryerr : '' ?>
                  </p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="subCategory">State</label>
                    <select name="state" id="state" class="form-control custom-select">
                      <option value="">Select State</option>
                      <?php
                      $check_state = $conn->query("select name,id from state where dstatus = 0 && status = 1 ");
                      while ($state_data = $check_state->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if ($state_id == $state_data['id']) {
                          $sel = 'selected';
                        }
                        echo '<option value="' . $state_data['id'] . '" ' . $sel . '>' . $state_data['name'] . '</option>';
                      }
                      ?>
                      </option>
                    </select>
                  </div>
                  <p class="error" id="error_state">
                    <?php echo isset($stateerr) ? $stateerr : '' ?>
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
                        if ($status == $key) {
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
<?php include("../include/footer.php"); ?>
<script>
  function checkvalidation(){
    let city = $('#name').val();
    let state = $('#state').val();
    let country = $('#country').val();
    let status = $('#inputStatus').val();
   // let city = $('#name').val();
    iserror = 0;
    if(city == ''){
      $('#error_name').text('Please Enter City Name');
      iserror = 1;
      $('#name').focus();
    }else{
      $('#error_name').text('');
    }
    if(country == ''){
      $('#error_country').text('Please Select Your Country');
      iserror = 1;
    }else{
      $('#error_country').text('');
    }
    if(state == ''){
      $('#error_state').text('Please Select Your State');
      iserror = 1;
    }else{
      $('#error_state').text('');
    }
    if(status == ''){
      $('#error_status').text('Please Select Status');
      iserror = 1;
    }else{
      $('#error_status').text('');
    }
    if(iserror == 0){
      return true;
    }
    return false; 
  }
  function getstate(countryid){
    // alert(stateid);
     $.ajax({
      url: "<?php echo SITEADMINURL; ?>ajax/getstate.php",
      type: "post",
      data: {
        country_id: countryid
      },
      success: function(response) {
        //alert(reponse);
        $('#state').html(response);
      }
    });
  }

</script>