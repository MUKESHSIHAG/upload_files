<?php
	session_start();
	include_once 'dbh.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
	$sql = "SELECET * FROM user";
	$result = mysql_query($conn, $sql);
	if (mysqli_num_rows($result > 0)) {
		while ($row = mysqli_fetch_assoc($result) {
			$id = $row['id'];
			$sqlImg = "SELECET * FROM profileimg WHERE userid='$id'";
			$resultImg = mysqli_query($conn, $sqlImg);
			while ($rowImg = mysql_fetch_assoc($resultImg) {
				echo "<div class='user-container'>";
					if ($rowImg['status'] == 0) {
						$filename = "uploads/profile".$id."*";
						$fileinfo = glob($filename);
						$fileext = explode(".", $fileinfo[0]);
						$fileactualext = $fileext[1];
						echo "<img src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
					}else{
						echo "<img src='uploads/profiledefault.jpg'>";
					}
					echo "<p>".$row['username']."</p>";
				echo "</div>";
			}
		}
	}else{
		echo "There are no user yet!";
	}

	if (isset($_SESSION['id'])) {
		if ($_SESSION['id'] == 1) {
			echo "You are logged in as user #1";
		}
		echo "<form action='upload.php' method='POST' enctype='multipart/form_data'>
			<input type='file' name='file'>
			<button type='submit' name='submit'>UPLOAD</button>
		</form>";
		echo "<form action='deleteprofile.php' method='POST'>
			<button type='submit' name='submit'>Delete Profile image</button>
		</form>";
	}else{
		echo "You are not logged in!";
		echo "<form action='login.php' method='POST'>
			<input type='text' name='first' placeholder='First_name'>
			<input type='text' name='last' placeholder='Last_name'>
			<input type='text' name='uid' placeholder='Username'>
			<input type='password' name='pwd' placeholder='Password'>
			<button type='submit' name='submitSignup'>Signup</button>
		</form>";
	}
?>

<p>Login as user!</p>
<form action="login.php" method="POST">
	<button type="submit" name="submitLogin">Login</button>
</form>

<p>Logout as user!</p>
<form action="logout.php" method="POST">
	<button type="submit" name="submitLogout"></button>
</form>

</body>
</html>