<?php
include('../../global.php');
$id = $_GET['id'];
$checkcate =$conn->query("select * from banner_categories where id ='".$id."' ");
if($checkcate->num_rows>0){
    $soft_delete = $conn->query("update banner_categories set dstatus=1 where id ='".$id."' ");
    // prd($soft_delete);
    if( $soft_delete){
        header("location:".SITEADMINURL.'bannercategory');
    }else{
        echo 'unable to process...';
    }
}else{
    header("location:".SITEADMINURL.'bannercategory');
}
?>