<?php 
	include("../../global.php");
	$pagename = 'Country';
  $iserror = 0;
  if(isset($_POST['name'])){
    if(empty(trim($_POST['name']))){
      $iserror = 1;
      $nameerr = ucwords('Please Enter country name');
    }
    if($iserror == 0){
      $checkCountry = $conn->query("select * from country where name='".$_POST['name']."' ");
      if($checkCountry->num_rows > 0){
        $nameerr = ucwords('duplicate entry');
      }else{
        $insertQuery = $conn->query("insert into country set name='".$_POST['name']."',created_at='".date('Y-m-d H:i:s')."' ");
        if($insertQuery){
          $_SESSION['success_msg'] = ucwords('Country added sucessfuly');
          header("location:".SITEADMINURL.'country');
        }
      }
    }
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
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