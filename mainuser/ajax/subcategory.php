<?php
    require('../../global.php');
    $html = '<option value="">Select SubCategory</option>';
    if(!empty($_POST['categoryid'])){
         $subcat = $conn->query('select * from subcategories where category_id = "'.$_POST['categoryid'].'" && dstatus=0 && status=1 ');
         if($subcat->num_rows > 0){
            while($subcategory = $subcat->fetch_assoc()){
                $html .= '<option value="'.$subcategory["id"].'">'.$subcategory["name"].'</option>';
                // $html .= '<option value="'.$singlesub["id"].'">'.$singlesub["name"].'</option>';   
            }
         }
    }
    echo $html;exit;    
?>