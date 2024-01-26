<?php 
	require('../global.php');
	$country_id = $_POST['country_id'];
	//prd($country_id);
	$html = '<option value="">Select State</option>';
	if(!empty($country_id)){
		$getstate = $conn->query("select * from state where country_id = '".$country_id."' order by name asc");
		if($getstate->num_rows > 0){
			while($fetch_state = $getstate->fetch_assoc()){
			//prd($fetch_state);
			$html .= '<option value='.$fetch_state["id"].'>'.$fetch_state["name"].'</option>';
			}
		}
	}
	echo $html;exit;
?>