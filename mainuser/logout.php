<?php
include('../global.php');
unset($_SESSION['islogin']);
unset($_SESSION['usertype']);
unset($_SESSION['userdata']);
$_SESSION['success_msg'] = ucwords("logout successfully");
header("location:".SITEADMINURL);
?>