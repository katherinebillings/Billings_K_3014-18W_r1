<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}'";
		$user_set = mysqli_query($link, $loginstring);
		if(mysqli_num_rows($user_set)){
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			if(password_verify($password, $found_user['user_pass'])) {
				$id = $found_user['user_id'];
				$_SESSION['user_id'] = $id;
				$_SESSION['user_name'] = $found_user['user_fname'];
				$_SESSION['user_date'] = $found_user['user_date'];
				$new = $found_user['user_new'];
				$suspend = $found_user['user_suspend'];
				$time = $found_user['user_cdate'];
				date_default_timezone_set("America/Toronto");
				$date = strftime("%Y-%m-%d %X",strtotime("now"));
				if(mysqli_query($link, $loginstring)){
					if($suspend == 1) {
						$message = "Your account is currently suspended. Please call your web admin.";
						return $message;
					}else if($new == "yes"){
						if ($date < $time) {
							$updateStringFirst = "UPDATE tbl_user SET user_ip = '$ip', user_date = CURRENT_TIMESTAMP, user_new = 'no' WHERE user_id = {$id}";
							$updateQueryFirst = mysqli_query($link, $updateStringFirst);
							redirect_to("admin_edituser.php");
						} else {
							$suspendString = "UPDATE tbl_user SET user_suspend = 1 WHERE user_id = {$id}";
							$suspendQuery = mysqli_query($link, $suspendString);
							$message = "Your account is suspended for waiting too long.";
							return $message;
						}
					} else {
						$updatestring = "UPDATE tbl_user SET user_ip = '$ip', user_date = CURRENT_TIMESTAMP WHERE user_id = {$id}";
						$updateQuery = mysqli_query($link, $updatestring);
						redirect_to("admin_index.php");
					}
					
				}
			}
			else{
				$message = "Username and/or password is incorrect.<br>Please make sure your cap lock key is turned off.";
				return $message;
			}
			
		}else{
			$message = "Username and/or password is incorrect.<br>Please make sure your cap lock key is turned off.";
			/*I was trying to give each account a count for how many times it failed and update it as it went and reset it when they logged in
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			$counterstring = "UPDATE tbl_user SET user_lock = user_lock + 1 WHERE user_id = {$id}";
			$lockDquery = mysqli_query($link, $counterstring);*/
			return $message;
		}
		mysqli_close($link);
	}


?>