<?php

	function password() {
		$characters = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
		for($i = 0; $i < 12; $i++) {
			$j = rand(0, strlen($characters) - 1);
			$pass[$i] = substr($characters, $j, 1);
		}
		$password = implode("", $pass);
		return $password;
	}

	function createUser($fname, $username, $password, $email, $userlvl) {
		include('connect.php');
		$pass = $password; //I only have this so when we create a new user, we can actually see the password and use the account since the email doesn't work right now
		$password = password_hash($password, PASSWORD_DEFAULT);
		$userString = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$password}', '{$pass}', '{$email}', CURRENT_TIMESTAMP, '{$userlvl}', 'no')";
		$userQuery = mysqli_query($link, $userString);
		if($userQuery) {
			redirect_to("admin_index.php");
		}else{
			$message = "There was a problem setting up this user. Maybe reconsider your hiring practices.";
			return $message;
		}
		mysqli_close($link);
	}
?>