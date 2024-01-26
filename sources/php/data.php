<?php

	function query($object) {
		$mysqli = new mysqli('', '', '', ''); // complete with the server address, username, password and database
		if ($mysqli->connect_error) {
			echo "Error connecting";
			die('Error connecting (' . $mysqli->connect_errno . ') '
    		. $mysqli->connect_error);
		}
		$search = $mysqli->query($object);
		return $search;
	}

?>
