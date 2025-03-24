<?php

include 'inc/connection.inc.php';
$query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE `cron` IS NOT NULL ORDER BY priority DESC, `time` ASC");

function parse_crontab($time, $crontab)
         {$time=explode(' ', date('i G j n w', strtotime($time)));
          $crontab=explode(' ', $crontab);
          foreach ($crontab as $k=>&$v)
                  {$time[$k]=intval($time[$k]);
                   $v=explode(',', $v);
                   foreach ($v as &$v1)
                           {$v1=preg_replace(array('/^\*$/', '/^\d+$/', '/^(\d+)\-(\d+)$/', '/^\*\/(\d+)$/'),
                                             array('true', $time[$k].'===\0', '(\1<='.$time[$k].' and '.$time[$k].'<=\2)', $time[$k].'%\1===0'),
                                             $v1
                                            );
                           }
                   $v='('.implode(' or ', $v).')';
                  }
          $crontab=implode(' and ', $crontab);
          return eval('return '.$crontab.';');
         }
		 
		 
		 
		 
		 
		 
		 
		 while($query_row = mysqli_fetch_assoc($query_run)){
			 
			 echo $query_row['cron'];
			 
			var_export(parse_crontab(date("Y-m-d H:i:s", time()), $query_row['cron']));
			if(parse_crontab(date("Y-m-d H:i:s", time()), $query_row['cron']))
			{
				echo "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('".$query_row['description']."',now(),'".$query_row['uid']."',".$query_row['priority'].",".$query_row['department'].",'".$query_row['title']."',NULL)";
				mysqli_query($connection, "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('".$query_row['description']."',now(),'".$query_row['uid']."',".$query_row['priority'].",".$query_row['department'].",'".$query_row['title']."',NULL)");
			}
			else
			{
				echo "dont run crontab";
			}
		 }
		 
		 
		 
		 
		 //var_export(parse_crontab('2011-05-04 02:08:03', '*/2,3-5,9 2 3-5 */2 *'));//echo parse_crontab('2011-05-04 02:08:03', '*/2,3-5,9 2 3-5 */2 *')."ssssss";
		 
	 
?>