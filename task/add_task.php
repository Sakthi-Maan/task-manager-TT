<?php
include 'inc/connection.inc.php';
session_start();
echo "<script>alert('Error: $error_message');</script>";
// 		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['add_desc']));
// 		$day_temp = $_POST['day'];
// 		$month_temp = $_POST['month'];
// 		$year_temp = $_POST['year'];
// 		$title = $_POST['add_title'];
// 		$dept = $_POST['add_pri'];
// 		$dept2 = $_POST['add_dept'];
// 		$cron = $_POST['add_cron'];
// 		$uid=$_SESSION["uid"];
		
// if(!isset($_SESSION["uid"]))
// {
// 	$uid=$dept2;
// }
		
// 			$timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
// 			$query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$task',now(),'".$uid."',$dept,$dept2,'$title','$cron')";
			
// 			//echo $query; 
		
// 			if(!mysqli_query($connection, $query))
// 			{	echo "failed";}
//       else{
//       //  echo "<script>window.location.href='display.php?dept=$department';</script>";
//         //header('display.php?dept='.$department);
//         echo "ok";
//       }

?>