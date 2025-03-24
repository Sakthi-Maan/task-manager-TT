<?php
		 session_start();
		 session_destroy();
		 session_commit();
		   //unset($_SESSION['uid']);


		echo "<script>
		localStorage.clear();
		sessionStorage.clear();
		window.location.href='https://login.microsoftonline.com/88e2b386-cc70-44d1-9c98-ab24471f8586/oauth2/v2.0/logout?post_logout_redirect_uri=https%3A%2F%2Ftt-eybus.com%2Ftask%2Flogin.php';
		location.reload();
		</script>";
		    
		exit;
	
?>