<?php
	// including the database connection file
	include_once("config.php");
////////////////////////////////////////////////////////////
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$category = mysqli_real_escape_string($mysqli, $_POST['category']);
	$url = mysqli_real_escape_string($mysqli, $_POST['url']);
	$threshold = mysqli_real_escape_string($mysqli, $_POST['threshold']);	
	
	// checking empty fields
	if(empty($url) || empty($threshold)) {	
			
		if(empty($url)) {
			echo "<font color='red'>Url field is empty.</font><br/>";
		}
		
		if(empty($threshold)) {
			echo "<font color='red'>Threshold field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$sql = "UPDATE ".$category." SET url='$url',threshold='$threshold' WHERE id=$id";
		$result = mysqli_query($mysqli, $sql);
		if ($result == true){
			echo 1;		
		}
		
		//redirectig to the display page. In our case, it is index.php
		//header("Location: index.php");
	}
?>

