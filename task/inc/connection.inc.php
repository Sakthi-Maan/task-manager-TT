<?php
	// $connect_error = 'Could not connect';
	// $mysql_host = 'localhost';
	// $mysql_user = 'u149713068_task';
	// $mysql_pass = 'tasktask';
	// $mysql_data = 'u149713068_task';

	$connect_error = 'Could not connect';
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = '';
	$mysql_data = 'u149713068_task';
	//echo "error";
    try
    {
    	if(!@$connection = mysqli_connect($mysql_host , $mysql_user , $mysql_pass ,$mysql_data))
    	{
    	   // echo "error";
    		die($connect_error);
    	}
    	else
    	{
    	   // echo "connected";
    	}
    }
    catch(Exception $e)
    {
        print_r($e);
    }
?>