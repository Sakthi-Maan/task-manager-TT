<?php
include 'inc/connection.inc.php';
session_start();
		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['edit_desc']));
		$day_temp = $_POST['day'];
		$month_temp = $_POST['month'];
		$year_temp = $_POST['year'];
		$title = $_POST['edit_title'];
		$dept = $_POST['edit_pri'];
		$dept2 = $_POST['edit_dept'];
		$cron = $_POST['edit_cron'];
		$id = $_POST['edit_id'];
		
			$timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
			 $query = "DELETE FROM `events` WHERE `id`='$id'";
     // echo $query;
      mysqli_query($connection, $query);
   
			$query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$task',now(),'".$_SESSION['uid']."',$dept,$dept2,'$title','$cron')";
			
			//echo $query; 
		
			if(!mysqli_query($connection, $query))
			{	echo "failed";}
      else{
      //  echo "<script>window.location.href='display.php?dept=$department';</script>";
        //header('display.php?dept='.$department);
        echo "ok";
      }

?>