<?php
require('../../../global.php');
$id = $_GET['id'];
$checkcate =$conn->query("select * from products where id ='".$id."' ");
if($checkcate->num_rows>0){
    $soft_delete = $conn->query("update products set dstatus=1 where id ='".$id."' ");
    $gallery_delete = $conn->query("update product_images set dstatus=1 where product_id ='".$id."' ");
    // prd($soft_delete);
    if( $soft_delete){
        header("location:".SITEADMINURL.'product/products');
    }else{
        echo 'unable to process...';
    }
}else{
    header("location:".SITEADMINURL.'product/products');
}
?>