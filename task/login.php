<?php
// include "azure_config.php";
// session_start();
// if(!isset($_SESSION["uid"]))
// {
//   echo '<script type="text/javascript">
//   window.location.href = "https://login.microsoftonline.com/'.$ad_config['authentication']['ad']['directory'].'/oauth2/v2.0/authorize?state=AlVuPzNFkwjhujp2CAnAovgkG6Jse0wM&scope=profile+openid+email+offline_access+User.Read&response_type=code&approval_prompt=auto&client_id='.$ad_config['authentication']['ad']['client_id'].'&redirect_uri='.$ad_config['authentication']['ad']['return_url'].'";
// </script>';
// die();
// }
// else
// {
//   //window.location.href = "https://tt-eybus.com/task/tasks.php";
//    echo '<script type="text/javascript">
//   window.location.href = "https://localhost/task/tasks.php";
// </script>';
// die(); 
// }

session_start();
$_SESSION['username'] ="shyam@magdyn.com";
$_SESSION['name'] = "Shyam Sundar";
$_SESSION['uid'] = 16;
header('Location: tasks.php');
?> 