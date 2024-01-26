<?php
	
	require_once "<path to the php folder>/php/data.php"; // complete with the path to the php folder
	
	//$botUpdateURL = "https://api.telegram.org/bot$token/getUpdates";
	
	//$botSendURL = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatID&text=$testo";
	
	$token = ""; // complete with the bot http key
	
	function notify($mail,$text) {
		global $token;
		$hasTelegram = query("SELECT name, telegram FROM users WHERE mail='$mail'");
		if($hasTelegram->num_rows) {
			while($a=mysqli_fetch_row($hasTelegram)) {
				$name = $a[0];
				$chatID = $a[1];
			}
			
			$testo = urlencode("Hi $name, $text");
			
			$botSendURL = file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chatID&text=$testo");
		
			return true;
		} else
			return false;
	}

	function notifyFromChatID($chatID,$mail,$text) {
		global $token;
		
		$queryName = query("SELECT name FROM users WHERE mail='$mail'");
		if($queryName->num_rows) {
			while($a=mysqli_fetch_row($queryNome))
				$name = $a[0];
			
			$testo = urlencode("Hi $name, $text");
			
			$botSendURL = file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chatID&text=$testo");
		
			return true;
		} else
			return false;
	}

?>
