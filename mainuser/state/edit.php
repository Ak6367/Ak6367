<?php 
	include("../../global.php");
	$pagename = 'state';
  $iserror = 0;
  $stateid = $_GET['id'];
  if(isset($_POST['name'])){
    if(empty(trim($_POST['name']))){
      $iserror = 1;
      $nameerr = ucwords('Please Enter state name');
    }
    if($iserror == 0){
      $checkCountry = $conn->query("select * from state where name='".$_POST['name']."' ");
      if($checkCountry->num_rows > 0){
        $nameerr = ucwords('duplicate entry');
      }else{
        $insertQuery = $conn->query("update state set name='".$_POST['name']."', country_id='".$_POST['country']."', updated_at='".date('Y-m-d H:i:s')."' where id='".$stateid."' ");
        if($insertQuery){
          $_SESSION['success_msg'] = ucwords('state name edited sucessfuly');
          header("location:".SITEADMINURL.'state');
        }
      }
    }
  }
  // echo "select state.*,country.id,country.name from city left join state on state.id=country_id where id = '".$stateid."' ";die;
  $getCountry = $conn->query("select state.*,country.id,country.name as cname from state left join country on country.id=state.country_id where state.id = '".$stateid."' ");
  // prd($getCountry);
  if($getCountry->num_rows > 0){
    $fetchCountry = $getCountry->fetch_assoc();
    // prd($fetchCountry);
    $state_name = $fetchCountry['name'];
    $countryid = $fetchCountry['country_id'];
    // prd($Cname);

  }else{
    header("location:".SITEADMINURL.'state');
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
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $state_name ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="subCategory">Country</label>
                    <select name="country" id="country" class="form-control custom-select">
                      <option value="">Select Category</option>
                      <?php
                      $checkcat = $conn->query("select name,id from country where dstatus = 0 && status = 1 ");
                      $cat_id = $cat_data['id'];
                      while ($categorydata = $checkcat->fetch_assoc()) {
                        // prd($value);
                        $sel = '';
                        if ($countryid == $categorydata['id']) {
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