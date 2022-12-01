<?php
	// Flag to indicate if upload was successful (1 yes, 0 no)
	$uploadOk = 1;

// isset() checks if a variable has a value (including False, 0 or empty string), but not NULL. Returns TRUE if var exists; FALSE otherwise.
if(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
	echo "Error no file selected";
	$uploadOk = 0;
} 
else {
	echo "Reading from the FILES array: <BR />";
	echo "Upload: " . $_FILES["fileToUpload"]["name"] . "<br />";
	echo "Type: " . $_FILES["fileToUpload"]["type"] . "<br />";
	echo "Size: " . $_FILES["fileToUpload"]["size"] . " <br />";
	echo "Stored in: " . $_FILES["fileToUpload"]["tmp_name"] . "<br /><br />";

	$thefilename = $_FILES["fileToUpload"]["name"];
	$thefiletype = $_FILES["fileToUpload"]["type"];
	$thefilesize = $_FILES["fileToUpload"]["size"];
	$thefilelocation = $_FILES["fileToUpload"]["tmp_name"];

	echo "Reading from the variable names: <BR />";
	echo "The file name: " . $thefilename . "<br />";
	echo "The file type: " . $thefiletype . "<br />";
	echo "The file size: " . $thefilesize . "<br />";
	echo "The file location: " . $thefilelocation . "<br /><br />";

	// Specifies the directory where the file is going to be placed
	$target_dir = "uploads/";

	// Specifies the complete path of the file (path + filename: path starts from where the .php file is executing)
	// The basename function is used to ensure that the filename has no path attached to it
	$target_file = $target_dir . basename($thefilename);
	echo "Target file: " . $target_file . "<BR />";

	// Holds the  extension of the file (in lower case)
	$imgFileTypeExt = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	echo "The extension of the file is: " . $imgFileTypeExt . "<BR />";

	// File types
	$actualMimeType = mime_content_type($thefilename);
	echo "<BR>The type of the uploaded file type is actually: " . $actualMimeType . "<BR>";

	// Properly testing for file type
	if ($actualMimeType!="image/gif" && $actualMimeType!="image/jpg" && $actualMimeType!="image/jpeg" && $actualMimeType!="image/png") {
		echo "<br>NOT A FILE TYPE THAT WE CAN ACCEPT<BR>";
		$uploadOk = 0;
	}
	else
		echo "<br>YES WE CAN ACCEPT THIS FILE<BR>";





	// File size
	echo "<BR>We know that the size of the file is : " . $thefilesize . " bytes.";
	$filesize2 = filesize($thefilelocation);
	echo "<BR>But it can also be found like this : " . $filesize2 . " bytes.";
	echo "<BR>Presented in KB : " . $thefilesize/1024 . " KB.";
	echo "<BR>Presented in KB with specific decimal values: " . number_format($thefilesize/1024,3)."<br><br>";

	if ($filesize2==0) {
		echo "The file size is 0. Error in upload. <BR>";
		$uploadOk = 0;
	}

	// CHECKING IF THE FILE ALREADY EXISTS
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	// CHECKING/LIMITING FILE SIZE
	if ($thefilesize > 10000000) {
		echo "Sorry, your file is too large (larger than 10MB).";
		$uploadOk = 0;
	}

	// CHECK IF $uploadOk IS SET TO 0 BY ANY ERROR
	if ($uploadOk == 0)
		echo "<BR>Sorry, your file was not uploaded.<BR>";
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		else
			echo "<BR>Sorry, there was an error uploading your file.<BR>";
	}
}

?>