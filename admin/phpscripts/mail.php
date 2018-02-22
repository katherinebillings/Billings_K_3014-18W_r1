<?php
	//echo "From mail file";
	function submitMessage($direct, $fname, $username, $password, $email, $url) {
		//echo "From submitmessage()";
		$to = $email;
		$subject = "New Account";
		$extra = "Reply to: accounts@FSB.com";
		$msg = "Welcome ".$fname." to the Finest Selection of Blu-rays."."\n\nUsername: ".$username."\n\nPassword: ".$password."\n\nURL: ".$url;
		mail($to,$subject,$msg,$extra);
	}
?>