<?php
	include 'inc/connection.inc.php';
	$query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE department=$department AND done=0 ORDER BY priority DESC, `time` ASC");
	
	//echo phpinfo(); 
?>