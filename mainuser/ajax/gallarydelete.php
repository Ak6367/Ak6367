<?php
    require('../../global.php');
    //print_r($_POST);
    $gall_sql = $conn->query("select * from product_images where id = '".$_POST['galleryid']."' ");
    $fetch_gall = $gall_sql->fetch_assoc();
   
    $galimg = $fetch_gall['image'];
    if($gall_sql->num_rows>0){
        //unlink('../../upload/products/'.$galimg);
        unlink('../../upload/products/galleryimage/'.$galimg);
       $delete = $conn->query("DELETE FROM `product_images` WHERE id ='".$_POST['galleryid']."' ");
    }
    echo 1; exit;
?>