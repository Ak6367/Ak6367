<?php
require('../../global.php');
$pagename = 'Pages';
$groupname = 'Pages';
?>
<?php
//print_r($_SESSION);
// print_r($_POST);die;
$iserror = 1;
if (isset($_POST['name'])) {
  if (empty(trim($_POST['name']))) {
    $iserror = 0;
    $nameerr = "Please Enter Bannner Name";
  }
  if (empty($_POST['category'])) {
    $iserror = 0;
    $categoryerr = "Please Select Page Category";
  }
  if (empty(trim($_POST['content']))) {
    $iserror = 0;
    $contenterr = "Please Enter Bannner Status";
  }
  if (empty($_POST['status'])) {
    $iserror = 0;
    $statuserr = "Please Select Page Status";
  }
  if (empty($_FILES['images']['name'])) {
    $iserror = 0;
    $imageserr = "Please Enter Page image php";
  } else {
    $ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
    if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
      $iserror = 0;
      $profilepictureerr = "profile picture allowed format is jpg, png, jpeg, gif";
    }
  }

  if ($iserror == 1) {
    $checkid = $conn->query("select * from pages where name = '" . $_POST['name'] . "' ");
    if ($checkid->num_rows > 0) {
      $nameerr = "Bannner Name Already Taken";
    } else {
      $pageimg = '';
      $pageimgname = 'Page_image_' . time() . '_' . rand(1, 9999999) . '.' . $ext;
      if (move_uploaded_file($_FILES['images']['tmp_name'], '../../upload/pages/' . $pageimgname)) {
        $pageimg = $pageimgname;
      }
      $insert_data = $conn->query("insert into `pages` set `name` = '" . $_POST['name'] . "', content='" . $_POST['content'] . "', `status` = '" . $_POST['status'] . "', category_id = '" . $_POST['category'] . "', `created_at` = '" . date('Y-m-d H:i:s') . "', image = '" . $pageimg . "' ");

      if ($insert_data) {
        $_SESSION['success_msg'] = 'Banner Added Successfully';
        header("location:" . SITEADMINURL . 'bannercategory');
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
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control">
                  </div>
                  <p class="error" id="error_name"><?php echo isset($nameerr) ? $nameerr : ''; ?></p>
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
                    <label for="Image">Image</label>
                    <input type="file" name="images" id="images" class="form-control">
                  </div>
                  <p class="error" id="error_img"><?php echo isset($imageserr) ? $imageserr : ''; ?></p>
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
                  <p class="error" id="error_status"><?php echo isset($statuserr) ? $statuserr : ''; ?></p>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputName">Content</label>
                    <textarea type="text" id="content" name="content" class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
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
  function checkvalidation() {
    iserror = 1;
    let name = document.getElementById('name').value;
    let status = document.getElementById('inputStatus').value;
    let content = document.getElementById('content').value;
    let category = document.getElementById('category').value;
    let image = document.getElementById('images').value;
    // alert(name);
    // alert(status);
    if (name == '') {
      document.getElementById('error_name').innerHTML = 'Please Enter Page Name';
      iserror = 0;
    } else {
      document.getElementById('error_name').innerHTML = '';
    }
    if (status == '') {
      document.getElementById('error_status').innerHTML = 'Please Enter Page Status';
      iserror = 0;
    } else {
      document.getElementById('error_status').innerHTML = '';
    }
    if (content == '') {
      document.getElementById('error_content').innerHTML = 'Please Enter Page Content';
      iserror = 0;
    } else {
      document.getElementById('error_content').innerHTML = '';
    }
    if (category == '') {
      document.getElementById('error_category').innerHTML = 'Please select Page Category';
      iserror = 0;
    } else {
      document.getElementById('error_category').innerHTML = '';
    }
    if (image == '') {
      document.getElementById('error_img').innerHTML = 'Please Enter Page Image';
      iserror = 0;
    } else {
      document.getElementById('error_img').innerHTML = '';
    }

    if (iserror == 1) {
      return true;
    }
    return false
  }
</script>
<?php include("../include/footer.php"); ?>