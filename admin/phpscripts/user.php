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
		$userString = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$password}', '{$pass}', '{$email}', CURRENT_TIMESTAMP, 'yes', TIMESTAMPADD(DAY, 3, CURRENT_TIMESTAMP), '{$userlvl}', 'no', '2')";
		$userQuery = mysqli_query($link, $userString);
		if($userQuery) {
			redirect_to("admin_index.php");
		}else{
			$message = "There was a problem setting up this user. Maybe reconsider your hiring practices.";
			return $message;
		}
		mysqli_close($link);
	}

	function editUser($id, $fname, $username, $password, $email) {
		include('connect.php');
		$pass = $password;
		$password = password_hash($password, PASSWORD_DEFAULT);
		$updateString = "UPDATE tbl_user t SET user_fname = '{$fname}', user_name = '{$username}', user_prehash = '{$pass}', user_pass = '{$password}', user_email = '{$email}' WHERE t.user_id = '{$id}'";
		$updateQuery = mysqli_query($link, $updateString);
		if($updateQuery) {
			redirect_to("admin_index.php");
		}else{
			$message = "There was a problem changing your information, please contact your web admin.";
			return $message;
		}
		mysqli_close($link);
	}

	function deleteUser($id) {
		//echo $id;
		include('connect.php');
		$delString = "DELETE FROM tbl_user WHERE user_id = '{$id}'";
		$delQuery = mysqli_query($link, $delString);
		if($delQuery) {
			redirect_to("../admin_index.php");
		}else{
			$message = "F%*k, call security...";
			return $message;
		}
		mysqli_close($link);
	}
?>