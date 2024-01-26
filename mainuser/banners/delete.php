<?php
include('../../global.php');
$id = $_GET['id'];
$checkcate =$conn->query("select * from banners where id ='".$id."' ");
if($checkcate->num_rows>0){
    $soft_delete = $conn->query("update banners set dstatus=1 where id ='".$id."' ");
    // prd($soft_delete);
    if( $soft_delete){
        header("location:".SITEADMINURL.'banners');
    }else{
        echo 'unable to process...';
    }
}else{
    header("location:".SITEADMINURL.'banners');
}
?>