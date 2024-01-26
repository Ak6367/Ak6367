<?php
include('../../global.php');
$id = $_GET['id'];
$checkcate =$conn->query("select * from shippings where id ='".$id."' ");
if($checkcate->num_rows>0){
    $soft_delete = $conn->query("update shippings set dstatus=1 where id ='".$id."' ");
    // prd($soft_delete);
    if( $soft_delete){
        header("location:".SITEADMINURL.'shipping/');
    }else{
        echo 'unable to process...';
    }
}else{
    header("location:".SITEADMINURL.'shipping/');
}
?>