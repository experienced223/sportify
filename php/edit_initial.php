<?php
	// including the database connection file
	include_once("config.php");
	$tr_category = $_POST['tr_category'];
	$tr_id = $_POST['tr_id'];
	//selecting data associated with this particular id
	if ($tr_category == "italy"){
		$result = mysqli_query($mysqli, "SELECT * FROM italy WHERE id=$tr_id");
	}else if ($tr_category == "international"){
		$result = mysqli_query($mysqli, "SELECT * FROM international WHERE id=$tr_id");
	}
	//echo $result;
	echo json_encode($result->fetch_array());
////////////////////////////////////////////////////////////
	
?>

