<?php
session_start();
include_once 'dbh.php';
$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
	$file = $_FILES['file'];
	print_r($file);
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'pdf');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				$fileNameNew = "profile".$id.".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
				$result = mysqli_query($conn, $result);
				header("Location: index.php?uploadsuccess");
			}else{
				echo "your file is too big!";
			}
		}else{
			echo "There was an error uploading your file!";
		}
	}else{
		echo "you can not upload file of this type";
	}
}