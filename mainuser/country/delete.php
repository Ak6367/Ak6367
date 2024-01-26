<?php 
	include('../../global.php');
	$updatedata = $conn->query("update `country` set  dstatus = 1 where id = '".$_GET['id']."'");
	if($updatedata){
		header("location:".SITEADMINURL.'country');
	}
?>