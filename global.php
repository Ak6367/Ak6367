<?php
session_start();
define('SITENAME', 'Ecommerce');
define('ORDERPREPIX', 'ECO');
define('SITEURL', 'http://localhost/ecommerce/');
define('SITEADMINURL', 'http://localhost/ecommerce/mainuser/');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
global $conn;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$statusarr = array(
    1 => 'Active',
    2 => 'Inactive',
  );
  function prd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
  }
  define('PAGINATION',10);
//   print_r($statusarr);die;

function getcategory($conn){
    $getdistinct = $conn->query("SELECT DISTINCT(category_id) FROM products WHERE status=1 && dstatus = 0");
        $cate_id_arr = array();
            if($getdistinct->num_rows > 0){
              while($cateids = $getdistinct->fetch_assoc()){
                $cate_id_arr[] = $cateids['category_id'];
              }
            }
    $res = $conn->query("select * from categories where status = 1 && dstatus = 0 && id IN(".implode(',',$cate_id_arr).") order by id desc limit 0,5");
    return $res;
}
function getbrands($conn){
    $getdist_brand = $conn->query("SELECT DISTINCT(brand_id) FROM products WHERE status=1 && dstatus = 0");
        $brandid_arr = array();
            if($getdist_brand->num_rows > 0){
              while($brandids = $getdist_brand->fetch_assoc()){
                $brandid_arr[] = $brandids['brand_id'];
              }
            }
    $responce = $conn->query("select * from brands where status = 1 && dstatus = 0 && id IN(".implode(',',$brandid_arr).") order by id desc limit 0,3");
    return $responce;
}
$currencysym = '₹';
function displaycurrency($amount){
    return '₹ '.number_format($amount,2);
}
$orderstatus = array(
    1 => 'Confirm',
    2 => 'Pending',
    0=> 'Cancel',
);
$shipstatus = array(
    1 => 'Confirm',
    2 => 'Pending',
    0=> 'Cancel',
);