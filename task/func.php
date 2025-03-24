<?php
	include 'inc/connection.inc.php';
	if(isset($_POST['taskdonesubmit'])){


		$selectedtasks = $_POST['eid3'];
				
			$query = "UPDATE `events` SET `done`=1 WHERE `id`='$selectedtasks'";
		//	echo $query;
			if(!mysqli_query($connection, $query))
				$error = 1;
			echo "OK";

		
	}
	
	if(isset($_POST['deletetask-submit'])){
		$selectedtasks = $_POST['eid2'];
				
			$query = "DELETE FROM `events` WHERE `id`='$selectedtasks'";
			//echo $query;
			if(!mysqli_query($connection, $query))
				$error = 1;
			echo "OK";
	}
	if(isset($_POST['tranfer_submit'])){
		$selectedtasks = $_POST['eid2'];
		$selecteddept = $_POST['did'];	
			$query = "UPDATE `events` SET `department` = '$selecteddept' WHERE `id` = '$selectedtasks'";
			//echo $query;
			if(!mysqli_query($connection, $query))
				$error = 1;
			echo "OK";
	}


?>