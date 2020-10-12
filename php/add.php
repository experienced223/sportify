
<?php
//including the database connection file
include_once("config.php");
if(isset($_POST['category']) && isset($_POST['url']) && isset($_POST['threshold'])) {
	$category = mysqli_real_escape_string($mysqli, $_POST['category']);
	$url = mysqli_real_escape_string($mysqli, $_POST['url']);
	$threshold = mysqli_real_escape_string($mysqli, $_POST['threshold']);
	// checking empty fields
	if(empty($category) || empty($url) || empty($threshold)) {
		if(empty($category)) {
			echo "category field is empty.";
		}


		if(empty($url)) {
			echo "url field is empty.";
		}
		
		if(empty($threshold)) {
			echo "threshold field is empty";
		}
		
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		if ($category == "italy"){
			$result = mysqli_query($mysqli, "INSERT INTO italy(url,threshold) VALUES('$url','$threshold')");
		}else if ($category == "international"){
			$result = mysqli_query($mysqli, "INSERT INTO international(url,threshold) VALUES('$url','$threshold')");
		}
		
		
		//display success message
		echo "Data added successfully.";
		//echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
