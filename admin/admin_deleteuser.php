<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	require_once('phpscripts/config.php');
	confirm_logged_in();
	$tbl = "tbl_user";
	$users = getAll($tbl);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS Portal Login</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<h1>Welcome Company Name to your admin page</h1>
	<div id="fBox">
		<?php
			while($row = mysqli_fetch_array($users)) {
				echo "<h3 class=\"fName\">{$row['user_fname']}</h3> <a class=\"fire\" href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete User</a><br>";
			}
		?>
	</div>
</body>
</html>