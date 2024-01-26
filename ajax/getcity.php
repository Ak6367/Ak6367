<?php 
	require('../global.php');
	$state_id = $_POST['state_id'];
	$html = '<option value="">Select State</option>';
	if(!empty($state_id)){
		$getcity = $conn->query("select * from city where state_id = '".$state_id."' order by name asc");
		if($getcity->num_rows > 0){
			while($fetch_city = $getcity->fetch_assoc()){
			// prd($fetch_state);
			$html .= '<option value='.$fetch_city["id"].'>'.$fetch_city["name"].'</option>';
			}
		}
	}
	echo $html;exit;
?>