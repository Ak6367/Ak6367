<?php 
	include('../../global.php');
	$updatedata = $conn->query("update `state` set  dstatus = 1 where id = '".$_GET['id']."'");
	if($updatedata){
		header("location:".SITEADMINURL.'state');
	}
?>