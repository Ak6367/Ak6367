<?php 
	include("../../global.php");
	$pagename = 'contact';
	$chekdata =$conn->query("select * from `contact` where id='".$_GET['id']."'");
	$fetchdata = $chekdata->fetch_assoc(); 
	include("../include/header.php");
?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo ucfirst($pagename);?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo SITEADMINURL;?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($pagename);?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h3 class="card-title"><?php echo ucfirst($pagename);?></h3>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
               	<div class="col-sm-2">
               		<h5>Name</h5>
               	</div>
               	<div class="col-sm-2">
               		<h5>Subject</h5>
               	</div>
               	<div class="col-sm-8">
               		<h5>Message</h5>
               	</div>
               </div>
               <hr>
               <div class="row">
               	<div class="col-sm-2">
               		<p><?php echo $fetchdata['name']; ?></p>
               	</div>
               	<div class="col-sm-2">
               		<p><?php echo $fetchdata['subject']; ?></p>
               	</div>
               	<div class="col-sm-8">
               		<p><?php echo $fetchdata['message']; ?></p>
               	</div>
               </div>
              </div>
              <!-- /.card-body -->  
              
            </div>
            
          </div>
     
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
		
<?php 
	include("../include/footer.php");
?>