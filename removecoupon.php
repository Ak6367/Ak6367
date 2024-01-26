<?php
	include('global.php');
	unset($_SESSION['coupondata']);
	header("location:".SITEURL.'cart.php');
?>