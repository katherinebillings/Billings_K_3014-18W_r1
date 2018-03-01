<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	require_once('phpscripts/config.php');
	confirm_logged_in();
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
	<?php date_default_timezone_set("America/Toronto");
	$dayT = idate("H");
	if($dayT < 5) {
		echo "<h2>Why are you still up {$_SESSION['user_name']}?</h2>"; 
	} else if(5 <= $dayT && $dayT < 12) {
		echo "<h2>Good morning {$_SESSION['user_name']}</h2>"; 
	} else if(12 <= $dayT && $dayT < 18) {
		echo "<h2>Good afternoon {$_SESSION['user_name']}</h2>"; 
	} else if(18 <= $dayT && $dayT < 22) {
		echo "<h2>Good evening {$_SESSION['user_name']}</h2>"; 
	} else if(22 <= $dayT) {
		echo "<h2>Good night {$_SESSION['user_name']}</h2>"; 
	}
	
	//$date = date('l, F jS, Y \a\t g:i:s a');
	echo "<h3>You last logged in on {$_SESSION['user_date']}</h3>";
	?>
	<div id="anchors">
		<a href="admin_createuser.php">Create User</a>
		<a href="admin_edituser.php">Edit User</a>
		<a href="admin_deleteuser.php">Fired</a>
		<a href="phpscripts/caller.php?caller_id=logout">Sign Out</a>
	</div>
</body>
</html>