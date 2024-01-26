<?php
require('../../../global.php');
$pagename = 'Category';
$groupname = 'Product';
$id = $_GET['id'];
$checkcate =$conn->query("select * from categories where id ='".$id."' ");
if($checkcate->num_rows>0){
    $soft_delete = $conn->query("update categories set dstatus=1 where id ='".$id."' ");
    // prd($soft_delete);
    if( $soft_delete){
        header("location:".SITEADMINURL.'product/category');
    }else{
        echo 'unable to process...';
    }
}else{
    header("location:".SITEADMINURL.'product/category');
}
?>