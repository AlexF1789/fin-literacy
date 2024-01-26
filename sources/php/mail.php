<?php

	require "<path to the sources folder>/php/data.php"; // complete with the path to the php folder in your server
	
	echo "Attendere prego...</br></br>";

	$query = query("SELECT mail FROM users");
	if($query->num_rows)
		while($a=mysqli_fetch_row($query))
			echo $a[0];

?>
