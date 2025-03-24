<?php
	//header("refresh: 120");
	$department=$_GET['dept'];
	include 'inc/connection.inc.php';
	$query_run101 = mysqli_query($connection, "SELECT * FROM `department`");
	$query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE department=$department AND done=0 ORDER BY priority DESC, `time` ASC");
		$query_run3 = mysqli_query($connection, "SELECT * FROM `department` WHERE department_id=$department");
	session_start();
  if(!isset($_SESSION['uid'])){
	  header('Location: https://tt-eybus.com/task/');
	  die();
  }
	 // $_SESSION['uid']=12;
	
?>

<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <link rel = "stylesheet" href = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
      <script src = "https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  
   <!-- jQuery -->
	<style>
.topBar {
  height: 40px;
  width: 100%;
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
    border-color: #497bae;
    color: #333;
    font-weight: 700;
  font-size: 1.25rem;
  text-align: center;
  background-image: linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/);
}
html,
body {
  height: 100%;
  width: 100%;
  font: 400px 16px/1.428 Consolas;
}
body {
  overflow-x: hidden;
  overflow-y: scroll;
}

.back {
  text-decoration: none;
  display: inline-block;
  position:absolute; top:1.2vh; left:0;
}



.back:hover {
  background-color: #ddd;
  color: black;
}
.previous {
  background-color: transparent;
  color: #ddd !important;
}
.round {
  border-radius: 50%;
}


		.grid-container {
		  display: grid;
		  grid-template-columns: auto auto auto auto;
		  grid-gap: 10px;
		  background-color: #2196F3;
		  padding: 10px;
		  margin-top: 40px;
		}
		.grid-item {
		  border: 1px solid rgba(0, 0, 0, 1);
		  padding: 20px;
		  font-size: 20px;
		  text-align: center;
		}
		.colour4 {
		  background:#d61212 !important;
      color: white !important;
		}
		.colour3 {
		  background:#ff8100 !important;
      color: white !important;
		}
		.colour2 {
		  background:#e4ff00 !important;
      color: black !important;
		}
		.colour1 {
		  background:#00ff5a !important;
      color: black !important;
		}

.button {
  border: none;
  color: white;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  border-radius:5px;
}

.button1 {
  background-color: #4CAF50; /* Green */
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.button2 {background-color: Red;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
} /* Blue */
.button3 {background-color: Blue;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 30%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal1-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}



.modal1-footer {
  padding: 15px;
  background-color: #5cb85c;
  color: white;
}

.modal1-body {
    position: relative;
    padding: 15px;
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
textarea.form-control {
    height: auto;
}

.btn-block {
    display: block;
    width: 100%;
}

.btn-group-lg>.btn, .btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
}
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}

.modal1-content {
    position: relative;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
    box-shadow: 0 3px 9px rgba(0,0,0,.5);
    outline: 0;
    width: 20%;
    margin-left:35%;
}
@media only screen and (max-width: 800px) {
.modal1-content {

    width: 94% !important;
    margin-left:2% !important;
}
.modal-content {

    width: 94% !important;
    margin-left:2% !important;
}
.grid-container {
      display: grid;
      grid-template-columns: auto auto !important;
      grid-gap: 3px !important;
      background-color: #2196F3;
      padding: 3px !important;
      margin-top: 40px;
          margin-right: 14px;
    }
    .grid-item {
      border: 1px solid rgba(0, 0, 0, 1);
      padding: 10px !important;
      font-size: 15px !important;
      text-align: center;
    }
    .back {
    text-decoration: none;
    display: inline-block;
    position: absolute;
    top: 0.2vh;
    left: 0;
}
.topBar {
    font-size: 1.00rem !important;
  
}

}
.close1 {
  color: white;
  float: right;
  font-size: 28px;
  background-color: #5cb85c;
  border-color: #5cb85c;
  border-right-color: #5cb85c;
}

.close1:hover,
.close1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.ui-listview>.ui-li-static, .ui-listview>.ui-li-divider, .ui-listview>li>a.ui-btn {
	white-space: normal !important;
}
	</style>
	
	<?php
	$query_row3 = mysqli_fetch_assoc($query_run3);
	?>
	
	</head>
	<body>
	
		<!--header class='topBar' ><a href="./tasks.php"  class="back previous">&laquo; Back</a><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$query_row3['department_name'];?>'s Task
		
		
		
		
		</header-->
		
	<?php
	if(isset($_POST['submit'])){
		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['task']));
		$day_temp = $_POST['day'];
		$month_temp = $_POST['month'];
		$year_temp = $_POST['year'];
		$title = $_POST['title'];
		$dept = $_POST['dept'];
		$dept2 = $_POST['dept2'];
		$cron = $_POST['cron'];
		
			$timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
			$query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$task',now(),'".$_SESSION['uid']."',$dept,$dept2,'$title','$cron')";
			//echo $query; 
		
			if(!mysqli_query($connection, $query))
			{	$error = 1;}
      else{
        echo "<script>window.location.href='display.php?dept=$department';</script>";
        //header('display.php?dept='.$department);
        exit();
      }
				//echo "<script>location.reload();</script>";
				
	}
  if(isset($_POST['edit-tasks'])){
    //echo "s";
      $selectedtasks = $_POST['eid'];
        
      $query = "DELETE FROM `events` WHERE `id`='$selectedtasks'";
     // echo $query;
      if(!mysqli_query($connection, $query))
        $error = 1;
     $task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['edittask']));
    $day_temp = $_POST['day'];
    $month_temp = $_POST['month'];
    $year_temp = $_POST['year'];
    $title = $_POST['edittitle'];
    $dept = $_POST['editdept'];
    $dept2 = $_POST['editdept2'];
    $cron = $_POST['ecron'];
      $timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
      $query = "INSERT INTO `events` (id,`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$selectedtasks','$task',now(),'".$_SESSION['uid']."',$dept,$dept2,'$title','$cron')";
     //echo $query;
      //echo $query; 
      if(!mysqli_query($connection, $query))
        {$error = 1;}
      else{
        //echo "sss";
        echo "<script>window.location.href='display.php?dept=$department';</script>";
        exit();
      }
    
  }
	
	?>
	
		
		
		
		<script>
function Complete() {
  var id=$("#edit_id").val();
 //alert(id);
 if (confirm("Are you sure, You want to Complete task?")) {
 var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "func.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('eid3='+id+'&taskdonesubmit=1');
                xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          if(this.responseText=="OK")
                        {
                         //alert("Task completed!!!");
                         location.reload();
                        }
                          else
                        {
                            alert("Changes not reflected!!! Please try again later.");
                        }
                        }
                  };
              }


}
function Delete() {
 //alert(id);
  var id=$("#edit_id").val();
 
 if (confirm("Are you sure, You want to Delete?")) {
 var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "func.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('eid2='+id+'&deletetask-submit=1');
                xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          if(this.responseText=="OK")
                        {
                         //alert("Task Deleted!!!");
                         location.reload();
                        }
                          else
                        {
                            alert("Changes not reflected!!! Please try again later.");
                        }
                        }
                  };
              }

}
function Tranfer(id) {
 //alert(id);
if (confirm("Are you sure, You want to tranfer?")) {
 var selid=$('#sel'+id).val();
 var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "func.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('eid2='+id+'&did='+selid+'&tranfer_submit=1');
                xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          if(this.responseText=="OK")
                        {
                         alert("Task Tranfered!!!");
                         location.reload();
                        }
                          else
                        {
                            alert("Changes not reflected!!! Please try again later.");
                        }
                        }
                  };
              }

}

function getval(sel,id)
{
    //alert(sel.value);
    if(sel.value!=0)
    {
    	$("#tr"+id).show();
    }
    else
    {
    	$("#tr"+id).hide();
    }
}
function Edittask(title,desp,dept,id,dept2,cron)
 {
  jQuery.noConflict();
   console.log(title+' '+desp+' '+dept);
   $('#editModal').modal('show');
    $('#edit-tasks-desp').val(desp);
     $('#edit-tasks-title').val(title);
     $("#edit-tasks-pro").val(dept);
     $("#edit-tasks-pro2").val(dept2);
     $('#eid').val(id);
     $('#ecron').val(cron);
 }
</script>
		
		
    <div data-role="page">
  <div data-role="header">
    <h1>Task</h1>
	<a href="#mypanel" data-role="button" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-notext ui-icon-grid"></a>
</div>

  <div data-role="panel" id="mypanel">
 
	<a href="https://tt-eybus.com/task/logout.php" data-role="button" class="ui-btn ui-corner-all ui-shadow">Logout</a>	
    <!-- panel content goes here -->
</div><!-- /panel -->

<div role="main" class="ui-content">
  <div data-role="collapsible-set" data-inset="false">
		
		<?php
		while($query_row = mysqli_fetch_assoc($query_run101)){
		    
		    /*$source="";
		    if($query_row['priority']==4){
		        
		        $source="donow.jpeg";
		    }
		    if($query_row['priority']==3){
		        
		        $source="donext.jpeg";
		    }
		    if($query_row['priority']==2){
		        
		        $source="donext.jpeg";
		    }
		    if($query_row['priority']==1){
		        
		        $source="dolater.jpeg";
		    }*/
		?>
		<!--div class="card" >
		
    
<div class="card-body">
		<div class="grid-item colour<?php echo $query_row['priority'];?>"> <?php echo $query_row['description'];?>
		
		<?php if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && ($_SESSION['uid']==$query_row['uid']))
		{?>
		
				
			<br><button onclick="Complete('<?php echo $query_row['id'];?>')" class="button button1"><i class="fa fa-check-square" aria-hidden="true"></i></button>
			<button onclick="Delete('<?php echo $query_row['id'];?>')" class="button button2"><i class="fa fa-trash" aria-hidden="true"></i></button>
			<button id="ed<?php echo $query_row['id'];?>" style="background-color:"orange";" <?php echo 'onclick="'."Edittask('".$query_row['title']."','".str_replace (array("\r\n", "\n", "\r"), ' ', $query_row['description'])."','".$query_row['priority']."','".$query_row['id']."','".$query_row['department']."','".$query_row['cron']."')".'"';?> class="button button3"><i class="fa fa-edit" aria-hidden="true"></i></button>
			

  			<button id="tr<?php echo $query_row['id'];?>" style="display: none; background-color:#00ff5a;" onclick="Tranfer('<?php echo $query_row['id'];?>')" class="button button3">Tranfer</button></br>
        
        
  				
		<?php }
		?>

		</div>
		</div >
  </div-->
  
    <div id="<?php echo $query_row['department_id']?>" data-role="collapsible">
        <h3 onclick="getuid('<?php echo $query_row['department_id']?>');"><?php echo $query_row['department_name'];?></h3>
		 <a href="#" onclick="openadddiag('<?php echo $query_row['department_id']?>')" style="float:right;">Add Task</a><br><br>

        <ul data-role="listview" data-inset="false">
		<?php
		$query_run102 = mysqli_query($connection, "SELECT * FROM `events` WHERE `department`=".$query_row['department_id']." AND done=0 ORDER BY priority DESC, `time` ASC");
		while($query_row2 = mysqli_fetch_assoc($query_run102)){
			
			if($_SESSION['uid']==$query_row2['uid'] || ($_SESSION['uid']==12)){
		?>
            <li class="colour<?php echo $query_row2['priority'];?>" onclick="openeditdiag('<?php echo $query_row2['description'];?>','<?php echo $query_row2['description'];?>','<?php echo $query_row2['cron'];?>','<?php echo $query_row2['priority'];?>','<?php echo $query_row2['department'];?>','<?php echo $query_row2['id'];?>')"><?php echo $query_row2['description'];?>
		  	
</li>
    
		<?php
			}
			else{
				?>
				<li class="colour<?php echo $query_row2['priority'];?>"><?php echo $query_row2['description'];?>
		  	
</li>
				<?php
			}
		}
		?>
		
		</ul>
		
    </div>
	
	

  

		<?php
		}
		?>
		<div data-role="collapsible" id="two">
    <ul data-role="listview" data-inset="true">
        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-btn-b">Edit</a>
<a href="#" class="ui-btn ui-btn-inline">Delete</a>
<a href="#" class="ui-btn ui-btn-inline">GO-TO</a>
    </ul>
  </div>
		</div>
		
	</div>
</div>
 
	
 <!-- Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
    <form method="POST" id="edittaskform">
        <div class="modal-header">
          <button type="button" class="close1 " data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Task</h4>
        </div>
        <div class="modal-body">
 
<?php 
  if(isset($error)){
    echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
  }
?>
      <script type="text/javascript">
	var savestate=0;
	window.onload = (event) => {

if(x!=0){
	var x = localStorage.getItem("selected");
	$('#'+x+' .ui-collapsible-heading-toggle').trigger('click');
	//alert (x);
	savestate=1;
  //console.log('page is fully loaded');
} 
};
function getuid(gid)
        {
 	if (savestate==1){
		if ($('#'+gid).collapsible("option", "collapsed")) {
			localStorage.setItem('selected', gid);
		}
		else{
			localStorage.setItem('selected', 0);
		}
	}
	}	  
        function openeditdiag(etitle,edesc,ecron,epri,edesc,id)
        {
         // alert('open');
          $.mobile.changePage( "#page2", { role: "dialog" } );
           $("#edit_title").val(etitle).change();; 
            $("#edit_desc").val(edesc).change();;
             $("#edit_cron").val(ecron).change();;
              $("#edit_pri").val(epri).change();;
               $("#edit_dept").val(edesc).change();;
                $("#edit_id").val(id).change();;
          //$.mobile.changePage("#popupDialog2");
        }
        function openadddiag( department)
        {
        // alert(department);
          $.mobile.changePage( "#page3", { role: "dialog" } );
          $("#add_dept").val(department).change();;
          //$.mobile.changePage("#popupDialog2");
        }
$("#add_task_but").click(function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    add_task_func();
    //Do important stuff....
});
function add_task_func()
{
  //alert('ssss');
  var t_title=$("#add_title").val();
  var t_desc=$("#add_desc").val();
  var t_cron=$("#add_cron").val();
  var t_pri=$("#add_pri").val();
  var t_dept=$("#add_dept").val();
   var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    if(this.responseText=="ok")
    {
      location.reload();
      //alert("Added Successfull");
    }
	else
    {
        alert("Changes not reflected!!! Please try again later.");
    }
  }
};

  xhttp.open("POST", "add_task.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("add_title="+t_title+"&"+"add_desc="+t_desc+"&"+"add_cron="+t_cron+"&"+"add_pri="+t_pri+"&"+"add_dept="+t_dept);

}

function edit_task_func()
{
  //alert('ssss');
  var t_title=$("#edit_title").val();
  var t_id=$("#edit_id").val();
  var t_desc=$("#edit_title").val();
  var t_cron=$("#edit_cron").val();
  var t_pri=$("#edit_pri").val();
  var t_dept=$("#edit_dept").val();
   var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    if(this.responseText=="ok")
    {
      //alert("Edited Successfull");
      location.reload();
    }
  }
};

  xhttp.open("POST", "edit_task.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("edit_title="+t_title+"&"+"edit_desc="+t_desc+"&"+"edit_cron="+t_cron+"&"+"edit_pri="+t_pri+"&"+"edit_dept="+t_dept+"&"+"edit_id="+t_id);

}

function editcopy()
{
	//console.log('kkkk');
    var n1 = document.getElementById("edit-tasks-title");
    var n2 = document.getElementById("edit-tasks-desp");
    n2.value = n1.value;
}
</script>
      
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <input class="form-control not-round"  type="text" required name="edittitle" id="edit-tasks-title"  placeholder="Enter task title here" onkeyup="editcopy();" onClick="editcopy();"></input>
          </div>
        </div>
    
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <textarea class="form-control not-round" rows="6" type="text" required id="edit-tasks-desp" name="edittask" placeholder="Enter your task here"></textarea>
            <input class="form-control not-round" type="hidden" required name="eid" id='eid' placeholder="Enter task title here"></input>
        
          </div>
          
        </div>
          <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <input class="form-control not-round" type="text" name="ecron" id='ecron' placeholder="Enter Cron command here"></input>
          </div>
          
        </div>  
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" id="edit-tasks-pro" required name="editdept" >
              <option value="1">Information</option>
              <option value="2">Normal</option>
              <option value="3">Warning</option>
              <option value="4">Danger</option>
            </select>
          </div>
          
        </div>
  <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" required id="edit-tasks-pro2" name="editdept2" >
            <option value="0"  disabled selected>Select User</option>
            <?php
            $query = "SELECT * FROM `department`";
            if($query_run = mysqli_query($connection, $query)){
               while($query_row = mysqli_fetch_assoc($query_run)){
            ?>
              <option value="<?php echo $query_row['department_id'] ;?>"><?php echo $query_row['department_name'] ;?></option>
             
            <?
               }
            }
            ?>
            </select>
          </div>
          
        </div>
        <div class="row submit-button-row" style="margin-top:20px;">
          <div class="col-md-10 col-md-offset-1">
            
          </div>
        </div>
      
    </div>

        <div class="modal-footer">
    <button form="edittaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="edit-tasks">Save</button>
        </div>
    </form>
      </div>
      
    </div>
  </div>
   </div>

  

      
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>GO-TO</h2>
    </div>
    <div class="modal-body">
      <?php
            $query = "SELECT * FROM `department`";
            if($query_run = mysqli_query($connection, $query)){
               while($query_row = mysqli_fetch_assoc($query_run)){
            ?>

            <p><a href="display.php?dept=<?php echo $query_row['department_id'] ;?>">Open <?php echo $query_row['department_name'] ; ?>`s Task</a></p>  
             
            <?php
               }
            }
            ?>
    </div>
    
  </div>

</div>

<div id="myModal1" class="modal1">

  <!-- Modal content -->
  <div class="modal1-content">
    
    <form method="POST" id="addtaskform" >
        <div class="modal1-header">
          <button type="button" class="close1 close2" data-dismiss="modal1">&times;</button>
          <h4 class="modal1-title">Add Task</h4>
        </div>
        <div class="modal1-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
		 <script type="text/javascript">
function addcopy()
{
	//console.log('kkkk');
    var n1 = document.getElementById("edit_title");
    var n2 = document.getElementById("edit_desc");
    n2.value = n1.value;
}
function addcopy2()
{
  //console.log('kkkk');
    var n1 = document.getElementById("add_title");
    var n2 = document.getElementById("add_desc");
    n2.value = n1.value;
}
</script>	
			
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<input class="form-control not-round"  type="text" required name="title" id="title" onkeyup="addcopy();" placeholder="Enter task title here" value="<?php if($edit_flag) echo $edit_title;?>"></input>
					</div>
				</div>
		
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<textarea class="form-control not-round" rows="6" type="text" required name="task" id="desc" placeholder="Enter your task here"><?php if($edit_flag) echo $edit_task;?></textarea>
					</div>
					
				</div>
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<input class="form-control not-round" type="text" name="cron" placeholder="Enter Cron command here"></input>
					</div>
					
				</div>
						
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<select class="form-control not-round" required name="dept" >
						
						<option  value="0" disabled >Select Priority</option>
							
						<option value="1">Information</option>
						  <option value="2">Normal</option>
						  <option value="3">Warning</option>
						  <option value="4" selected>Danger</option>
						</select>
					</div>
					
				</div>
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<select class="form-control not-round" required name="dept2" >
						<option value="0"  disabled >Select User</option>
						<?php
						$query = "SELECT * FROM `department`";
						if($query_run = mysqli_query($connection, $query)){
							 while($query_row = mysqli_fetch_assoc($query_run)){
                $selected="";
                if($department==$query_row['department_id'])
                {
                  $selected="selected";
                }
						?>
						  <option value="<?php echo $query_row['department_id'] ;?>" <?php echo $selected;?> ><?php echo $query_row['department_name'] ;?></option>
						 
						<?
							 }
						}
						?>
						</select>
					</div>
					
				</div>
				
				<div class="row submit-button-row" style="margin-top:20px;">
					<div class="col-md-10 col-md-offset-1">
						
					</div>
				</div>
			
		</div>

        <div class="modal1-footer">
		<button form="addtaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="submit" >Add Task</button>
		
        </div>
        
		</form>
    
  </div>

</div>

<div id="page2" data-role="page">
        <div data-role="header">  
           <h1>Edit Task</h1>
        </div>        
        <div data-role="content">   
             <h3 class="ui-title">Edit Task Information Here</h3>
<div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <textarea class="form-control not-round"  type="text" required name="title" id="edit_title" onkeyup="addcopy();" placeholder="Enter task title here" value="<?php if($edit_flag) echo $edit_title;?>"></textarea>
              <input class="form-control not-round"  type="text" style="display:none;" required name="id" id="edit_id"  placeholder="id" ></input>
        
          </div>
        </div>
    
        <div class="row" style="margin: 10px auto; display:none;">
          <div class="col-md-12">
            <textarea class="form-control not-round" rows="6" type="text" required name="task" id="edit_desc" placeholder="Enter your task here"><?php if($edit_flag) echo $edit_task;?></textarea>
          </div>
          
        </div>
        <div class="row" style="margin: 10px auto; display:none;">
          <div class="col-md-12">
            <input class="form-control not-round" type="text" name="cron" id="edit_cron" placeholder="Enter Cron command here"></input>
          </div>
          
        </div>
            
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" required name="dept" id="edit_pri" >
            
            <option  value="0" disabled >Select Priority</option>
              
            <option value="1">Information</option>
              <option value="2">Normal</option>
              <option value="3">Warning</option>
              <option value="4" selected>Danger</option>
            </select>
          </div>
          
        </div>
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" required name="dept2" id="edit_dept" >
            <option value="0"  disabled >Select User</option>
            <?php
            $query = "SELECT * FROM `department`";
            if($query_run = mysqli_query($connection, $query)){
               while($query_row = mysqli_fetch_assoc($query_run)){
                $selected="";
                if($department==$query_row['department_id'])
                {
                  $selected="selected";
                }
            ?>
              <option value="<?php echo $query_row['department_id'] ;?>" <?php echo $selected;?> ><?php echo $query_row['department_name'] ;?></option>
             
            <?
               }
            }
            ?>
            </select>
          </div>
          
        </div>
<table style="margin-left:30px;">
 <tr>   
<td><a href="#" style="width:69px;" data-role="button" data-mini="true" data-inline="true" data-icon="back" data-theme="b" data-rel="back">Cancel</a></td>
<td><a href="#" style="width:69px;" data-role="button" data-mini="true" data-inline="true" data-icon="edit" data-theme="b" onclick="edit_task_func()">Save Task</a></td></tr>
<tr><td><a href="#" style="width:69px;"data-role="button" data-mini="true" data-inline="true" data-icon="check" data-theme="b"  onclick="Complete()">Complete</a></td>
<td><a href="#" style="width:69px;" data-role="button" data-mini="true" data-inline="true" data-icon="delete" data-theme="b" onclick="Delete()">Delete Task</a></td></tr>  
</table>
    </div>
    </div>


<div id="page3" data-role="page">
        <div data-role="header">  
           <h1>Add Task</h1>
        </div>        
        <div data-role="content">   
             <h3 class="ui-title">Add Task Information Here</h3>
<div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <textarea class="form-control not-round"  type="text" required name="title" id="add_title" onkeyup="addcopy2();" placeholder="Enter task title here" value="<?php if($edit_flag) echo $edit_title;?>"></textarea>
          </div>
        </div>
    
        <div class="row" style="margin: 10px auto; display:none;">
          <div class="col-md-12">
            <textarea class="form-control not-round" rows="6" type="text" required name="task" id="add_desc" placeholder="Enter your task here"><?php if($edit_flag) echo $edit_task;?></textarea>
          </div>
          
        </div>
        <div class="row" style="margin: 10px auto; display:none;">
          <div class="col-md-12">
            <input class="form-control not-round" type="text" name="cron" id="add_cron" placeholder="Enter Cron command here"></input>
          </div>
          
        </div>
            
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" required name="dept" id="add_pri" >
            
            <option  value="0" disabled >Select Priority</option>
              
            <option value="1">Information</option>
              <option value="2">Normal</option>
              <option value="3">Warning</option>
              <option value="4" selected>Danger</option>
            </select>
          </div>
          
        </div>
        <div class="row" style="margin: 10px auto">
          <div class="col-md-12">
            <select class="form-control not-round" required name="dept2" id="add_dept" >
            <option value="0"  disabled >Select User</option>
            <?php
            $query = "SELECT * FROM `department`";
            if($query_run = mysqli_query($connection, $query)){
               while($query_row = mysqli_fetch_assoc($query_run)){
                $selected="";
                if($department==$query_row['department_id'])
                {
                  $selected="selected";
                }
            ?>
              <option value="<?php echo $query_row['department_id'] ;?>" <?php echo $selected;?> ><?php echo $query_row['department_name'] ;?></option>
             
            <?
               }
            }
            ?>
            </select>
          </div>
          
        </div>
		<table style="margin-left:30px;">
 <tr>   
<td><a href="#" style="width:69px;" data-role="button" data-mini="true" data-inline="true" data-icon="back" data-theme="b" data-rel="back">Cancel</a></td>
<td><a href="#" style="width:69px;" data-role="button" data-mini="true" data-inline="true" data-icon="action" data-theme="b" onclick="add_task_func()">Add Task</a></td>	
</tr>
</table>	
    </div>
    </div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
// Get the modal
var modal1 = document.getElementById("myModal1");

// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
  modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
</script>



		
	</body>
</html>