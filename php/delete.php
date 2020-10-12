<?php
//including the database connection file
include("config.php");
$category = $_POST['category'];
//getting id of the data from url
$id = (int)$_POST['id'];
if(empty($category) || empty($id)) {
	if(empty($category)) {
		echo "category field is empty.";
	}


	if(empty($id)) {
		echo "id field is empty.";
	}
	
}else{
	if ($category == "italy"){
		$result = mysqli_query($mysqli, "DELETE FROM italy WHERE id=$id");
	}else if ($category == "international"){
		$result = mysqli_query($mysqli, "DELETE FROM international WHERE id=$id");
	}
	
	echo "Data deleted successfully.";	
}


//redirecting to the display page (index.php in our case)
//header("Location:index.php");
?>

