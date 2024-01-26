<?php 
require('../../global.php');
$pagename = 'Orders';


$per_page_record = PAGINATION;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
  $page=1;    
}    

$searchvar = '';
if(isset($_REQUEST['name']) && !empty($_REQUEST['name'])){
  $searchvar .= ' && name Like "%'.$_REQUEST['name'].'%"';
}
if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
  $searchvar .= ' && status ="'.$_REQUEST['status'].'"';
}

$start_from = ($page-1) * $per_page_record;   


$getdata = $conn->query("select * from `orders` where dstatus = 0 ".$searchvar."  order by id desc LIMIT $start_from, $per_page_record ");
// print_r($getdata);die;

$chekdata =$conn->query("select * from `orders` where dstatus = 0  ".$searchvar."");  
// print_r($chekdata);die;  
$total_records = $chekdata->num_rows;     
$total_pages = ceil($total_records / $per_page_record);     
// print_r($total_pages);die;

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
              <li class="breadcrumb-item active"><?php echo $pagename;?></li>
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
                    <h3 class="card-title"><?php echo $pagename;?></h3>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="get">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name to Search.." value="<?php echo isset($_GET['name'])?$_GET['name']:''?>">
                    </div>
                    <div class="col-md-3 form-group">
                    <select name="status" id="status" class="form-control custom-select">
                          <option value="">Select Status</option>
                            <?php 
                            $status = isset($_GET['status'])?$_GET['status']:'';
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
                    <div class="col-md-3 form-group">
                              <button class="btn btn-info">Search</button>
                              <a href="<?php echo SITEADMINURL;?>city/" class="btn btn-danger">Reset</a>
                    </div>
                </div>
                </form>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px;color: red;">#</th>
                      <th style="color: red;">Order No</th>
                      <th style="color: red;">Username</th>
                      <th style="color: red;">Mobile No</th>
                      <th style="color: red;">Order Status</th>
                      <th style="color: red;">Shipping Status</th>
                      <th style="color: red;">Order Amount</th>
                      <th style="color: red;">Image</th>
                      <th style="color: red; " >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cnt = (isset($_GET['page'])?($_GET['page']-1)*$per_page_record:1);
                 
                  if($getdata->num_rows>0){
                    while($file = $getdata->fetch_assoc()){
                      $orderstatus = '';
                      if($file['order_status'] == 0){
                        $orderstatus = 'Pending';
                      }
                      if($file['order_status'] == 1){
                        $orderstatus = 'Confirm';
                      }
                      if($file['order_status'] == 2){
                        $orderstatus = 'Cancel';
                      }
                      $shippingstatus = '';
                      if($file['shipping_status'] == 2){
                        $shippingstatus = 'Pending';
                      }
                      if($file['shipping_status'] == 1){
                        $shippingstatus = 'Confirm';
                      }
                      if($file['shipping_status'] == 0){
                        $shippingstatus = 'Cancel';
                      }
                      $productQuery = $conn->query("select order_products.*,products.name as pro_name,products.image from order_products left join products on order_products.product_id=products.id where order_id='".$file['id']."'");
                          $fetchproducts = $productQuery->fetch_assoc();
                          //prd($fetchproducts);
                    ?>
                  
                    <tr>
                      <td><?php if($file){echo $cnt++; } ?></td>
                      <td><?php echo $file['order_no'] ?></td>
                      <td><?php echo $file['user_name']?></td>
                      <td><?php echo $file['phone_no']?></td>
                      <td><?php echo $orderstatus; ?></td>
                      <td><?php echo $shippingstatus ; ?></td>  
                      <td><?php echo $file['order_total']; ?></td>
                      <td>
                      <img src="<?php echo SITEURL; ?>upload/products/<?php echo $fetchproducts['image']; ?>" width="40">
                      </td>
                       
                        <td>
                        <a href="<?php echo SITEADMINURL;?>orders/orderview.php?id=<?php echo $file['id'];?>" class="btn btn-success"><i class="fa-sharp fa-solid fa-eye"></i> View</a>

                      </td>
                    </tr>
                    
                 
                  <?php } 
                  }else{
                    echo "No pages Found";
                  }
                  ?>
                   </tbody>
                </table>
              </div>
              <!-- /.card-body -->  
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
               <?php  $pagLink = "";       
      
      if($page>=2){   
          echo "<li class='page-item'><a class='page-link active' href='".SITEADMINURL."city/?page=".($page-1)."'>  Prev </a></li>";   
      }       
                 
      for ($i=1; $i<=$total_pages; $i++) {   
        if ($i == $page) {   
            $pagLink .= "<li class='page-item'><a class = 'page-link active' href='".SITEADMINURL."city/?page=".$i."'>".$i." </a></li>";   
        }               
        else  {   
            $pagLink .= "<li class='page-item'><a class='page-link active' href='".SITEADMINURL."city/?page=".$i."'> ".$i." </a></li>";     
        }   
      };     
      echo $pagLink;   

      if($page<$total_pages){   
          echo "<li class='page-item'><a class='page-link active' href='".SITEADMINURL."city/?page=".($page+1)."'>  Next </a></li>";   
      }  ?> 

                 
                </ul>
              </div>
            </div>
            
          </div>
     
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include("../include/footer.php");?>