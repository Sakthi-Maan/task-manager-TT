<?php
	header("refresh: 300");
  if(isset($_GET['dept']))
  {
    $department=$_GET['dept'];
  }else{
    $department=$_POST['dept'];
  }

	include 'inc/connection.inc.php';
  $query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE department=$department AND done=0 ORDER BY `dates` ASC, `time` ASC, `priority` DESC");


		$query_run3 = mysqli_query($connection, "SELECT * FROM `department` WHERE department_id=$department");
	session_start();
	 //$_SESSION['uid']=12;
	
?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/js/all.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
//alert("sss");
document.addEventListener('keydown', function(event) {
    // Check if Ctrl key is pressed along with the 'N' key
    if (event.altKey && event.key === 'n') {
        event.preventDefault(); // Prevent the default behavior (usually opening a new window)
        //alert('Ctrl + N shortcut detected!');
         modal1.style.display = "block";
		  document.getElementById("title").focus();
		  window.stop();
        
        // You can add your custom logic here instead of the alert
    }
});
function showEditModal(id, title, description) {
  // Set the values dynamically in the modal
  var text = [] ;
  text = description.split('~')
  var value = '';
  for(var i =0;i<text.length ; i++)
  {
    if(i == text.length-1){
      value =value + text[i] ;
    }else{
      value =value + text[i] + '<br>';
    }
   
  }

  document.getElementById("edit-tasks-desp1").value = value;
 
  
  // Set the priority in the select input

  
  // Show the modal (Bootstrap will handle this)

}

</script>

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
		  background-color:#d61212;
		}
		.colour3 {
		  background-color:#ff8100;
		}
		.colour2 {
		  background-color:#e4ff00;
		}
		.colour1 {
		  background-color:#00ff5a;
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

	</style>
	
	<?php
	$query_row3 = mysqli_fetch_assoc($query_run3);
	?>
	
  <script>
     $(document).ready(function () {
    $('#edittaskform').on('submit', function (e) {
        $('#savetaskbtn').prop('disabled', true).text('Submitting...');
    });
});
  </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<header class='topBar' ><a href="./tasks.php"  class="back previous">&laquo; Back</a><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$query_row3['department_name'];?>'s Task
		
		<button id="myBtn" class="pull-right btn btn-warning" data-toggle="modal" data-target="#moreInfoModal" style="color: #fff;
    background-color: #f0ad4e;
     float: right!important;border: 1px solid transparent;
    padding: 5px 12px;margin-right:5px;margin-top:3px;
    border-radius:5px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">GO TO</button>
		
		<button id="myBtn1" form="taskslist" type="button" class=" pull-left btn btn-success" data-toggle="modal1" data-target="#myModal1" style="color: #fff;
    background-color: #5cb85c;
     float: right!important;border: 1px solid transparent;
    padding: 5px 12px;margin-right:5px;margin-top:3px;
    border-radius:5px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Task</button>
		
		
		
		
		
		</header>
		
	<?php
	if(isset($_POST['function']) && $_POST['function'] == 'store'){

		$task = $_POST['tasks'];
    $date = $_POST['dates'];
		$dept = $_POST['priority'];
		$dept2 = $_POST['dept2'];
		$cron = $_POST['cron'] ;
		$uid=$_SESSION["uid"];
		
if(!isset($_SESSION["uid"]))
{
	$uid=$dept2;
}

$insert_query = "INSERT into events(uid , description ,  time ,priority , title , department , cron , dates ) 
                Values($uid , '$task' ,now() , '$dept' ,'$task' ,$dept2 , '$cron', $date );";
$result = mysqli_query($connection , $insert_query);
if(!$result){
  echo mysqli_error($connection);
}
// echo $insert_query;

			// $timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
			// $query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron,dates) VALUES ('$task',now(),'".$uid."',$dept,$dept2,'$title','$cron','$date')";
			// //echo $query; 
		
			// if(!mysqli_query($connection, $query))
			// {	$error = 1;}
      // else{
      //   echo "<script>window.location.href='display.php?dept=$department';</script>";
      //   //header('display.php?dept='.$department);
      //   exit();
      // }
			// 	//echo "<script>location.reload();</script>";
				
	}
  if(isset($_POST['edit-tasks'])){
    //echo "s";
      $selectedtasks = $_POST['eid'];
        
      $query = "DELETE FROM `events` WHERE `id`='$selectedtasks'";
     // echo $query;
      if(!mysqli_query($connection, $query))
        $error = 1;
     $task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['edittask']));
 
    $title = $_POST['edittitle'];
    $dept = $_POST['editdept'];
    $dept2 = $_POST['editdept2'];
			$uid=$_SESSION["uid"];
		
if(!isset($_SESSION["uid"]))
{
	$uid=$dept2;
}
    $cron = $_POST['ecron'];
   
      $query = "INSERT INTO `events` (id,`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$selectedtasks','$task',now(),'".$uid."',$dept,$dept2,'$title','$cron')";
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
		
		


function Complete(id) {
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
function Delete(id) {
 //alert(id);
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
// function Edittask(title,desp,dept,id,dept2,cron)
//  {
//   jQuery.noConflict();
//    console.log(title+' '+desp+' '+dept);
//    $('#editModal').modal('show');
//     $('#edit-tasks-desp').val(desp);
//      $('#edit-tasks-title').val(title);
//      $("#edit-tasks-pro").val(dept);
//      $("#edit-tasks-pro2").val(dept2);
//      $('#eid').val(id);
//      $('#ecron').val(cron);
//      setTimeout(function() {
//     document.getElementById('edit-tasks-title').focus();
// }, 300); // Delay to allow the modal to fully open 


//  }
function Edittask(title, desp, dept, id, dept2, cron) {
    jQuery.noConflict();
    
    // console.log(title + ' ' + desp + ' ' + dept);
    
    // Show the modal
    $('#editModal').modal('show');

    var val = title.replace('~' , '\n');
    



    $('#edit-tasks-title').val(val);  // Task title
    






    // Set the values for the modal form fields
    $('#edit-tasks-desp').val(desp);  // Task description

    $("#edit-tasks-pro").val(dept);  // Department dropdown
    $("#edit-tasks-pro2").val(dept2);  // User dropdown (Department 2)
    $('#eid').val(id);  // Hidden input for task ID
    $('#ecron').val(cron);  // Cron command field

    // Set focus to the title after the modal opens
    setTimeout(function() {
        document.getElementById('edit-tasks-title').focus();
    }, 300); // Delay to allow the modal to fully open
}

</script>
		<div id="ticker_02" class="grid-container" style="grid-auto-flow: row;">
		
		
    
		
		<?php
		while($query_row = mysqli_fetch_assoc($query_run)){
		    
		    $source="";
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
		    }
		?>
		<div class="card" >
		
    
<div class="card-body">
	
<div class="grid-item colour<?php echo $query_row['priority']; ?>"
    onclick="showEditModal('<?php echo $query_row['id']; ?>', 
    '<?php echo addslashes(preg_replace('/\s+/', ' ', $query_row['title'])); ?>', 
    '<?php echo addslashes(preg_replace('/\s+/', ' ', $query_row['description'])); ?>')">
    
    <p data-toggle="modal" data-target="#exampleModal" ><?php
        $text = $query_row['title'];
        $val =explode('~' , $text);
        for($i = 0 ; $i < count($val) ; $i++)
        {
          echo $val[$i].'<br>';
        }
    ?></p>
 
		
		<?php if((isset($_SESSION['uid']) && !empty($_SESSION['uid']) && ($_SESSION['uid']==$query_row['uid'])) || ($_SESSION['uid']==12))
		{?>
		
				
			<br><button onclick="Complete('<?php echo $query_row['id'];?>')" class="button button1"><i class="fa fa-check-square" aria-hidden="true"></i></button>
			<button onclick="Delete('<?php echo $query_row['id'];?>')" class="button button2"><i class="fa fa-trash" aria-hidden="true"></i></button>


      
      <button 
    id="ed<?php echo $query_row['id']; ?>" 
    style="background-color:orange;" 
    <?php 
    echo 'onclick="' . 
        "Edittask('" . 
        preg_replace('/\s+/', ' ', $query_row['title']) . "', '" . 
        preg_replace('/\s+/', ' ', $query_row['description']) . "', '" . 
        $query_row['priority'] . "', '" . 
        $query_row['id'] . "', '" . 
        $query_row['department'] . "', '" . 
        $query_row['cron'] . 
        "')\""; 
?>

    class="button button3">
    <i class="fa fa-edit" aria-hidden="true"></i>
</button>






			<!--br><select id="sel<?php echo $query_row['id'];?>" onchange="getval(this,'<?php echo $query_row['id'];?>');" style="width: auto;border:1px;border-radius:2px;padding:2px;display:none;">
   							<option value="0"  disabled selected><b>TRANSFER TO</b></option>
						<?php
						$query2 = "SELECT * FROM `department`";
						if($query_run2 = mysqli_query($connection, $query2)){
							 while($query_row2 = mysqli_fetch_assoc($query_run2)){
                
						?>
						  <option value="<?php echo $query_row2['department_id'] ;?>" ><?php echo $query_row2['department_name'] ;?></option>
						 
						<?
							 }
						}
						?>
  </select-->

  			<button id="tr<?php echo $query_row['id'];?>" style="display: none; background-color:#00ff5a;" onclick="Tranfer('<?php echo $query_row['id'];?>')" class="button button3">Tranfer</button></br>
        
        <!-- <button style="background-color: #000;color:white;"><i class="fa-solid fa-eye fa-bounce"></i></button> -->
  				
		<?php }
		if($query_row['uid']==$department && ($_SESSION['uid']!=12))
		{?>
			<br><button onclick="Complete('<?php echo $query_row['id'];?>')" class="button button1"><i class="fa fa-check-square" aria-hidden="true"></i></button>
			<button onclick="Delete('<?php echo $query_row['id'];?>')" class="button button2"><i class="fa fa-trash" aria-hidden="true"></i></button>
			<button id="ed<?php echo $query_row['id'];?>" style="background-color:orange;" <?php echo 'onclick="'."Edittask('".$query_row['title']."','".str_replace (array("\r\n", "\n", "\r"), ' ', $query_row['description'])."','".$query_row['priority']."','".$query_row['id']."','".$query_row['department']."','".$query_row['cron']."')".'"';?> class="button button3"><i class="fa fa-edit" aria-hidden="true"></i></button>
			<!--br><select id="sel<?php echo $query_row['id'];?>" onchange="getval(this,'<?php echo $query_row['id'];?>');" style="width: auto;border:1px;border-radius:2px;padding:2px;display:none;">
   							<option value="0"  disabled selected><b>TRANSFER TO</b></option>
						<?php
						$query2 = "SELECT * FROM `department`";
						if($query_run2 = mysqli_query($connection, $query2)){
							 while($query_row2 = mysqli_fetch_assoc($query_run2)){
                
						?>
						  <option value="<?php echo $query_row2['department_id'] ;?>" ><?php echo $query_row2['department_name'] ;?></option>
						 
						<?
							 }
						}
						?>
  </select-->

  			<button id="tr<?php echo $query_row['id'];?>" style="display: none; background-color:#00ff5a;" onclick="Tranfer('<?php echo $query_row['id'];?>')" class="button button3">Tranfer</button></br>
		<?}
		?>

		</div>
		</div>
  </div>

		<?php
		}
		?>
	

	
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
function editcopy()
{
	//console.log('kkkk');
    var n1 = document.getElementById("edit-tasks-title");
    var n2 = document.getElementById("edit-tasks-desp");
    
    n2.value = n1.value;
}
</script>
      
        <div class="row" style="margin: 10px auto;">
          <div class="col-md-12">
            <textarea class="form-control not-round" rows="6"  type="text" required name="edittitle" id="edit-tasks-title"  placeholder="Enter task here" onkeyup="editcopy();" onClick="editcopy();"></textarea>
          </div>
        </div>
    
        <div class="row" style="margin: 10px auto; display:none;">
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
    var n1 = document.getElementById("title");
    var n2 = document.getElementById("desc");
    n2.value = n1.value;
}
</script>	
			
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<textarea class="form-control not-round"  rows="6"  type="text" required name="title" id="title" onkeyup="addcopy();" placeholder="Enter task here" value="<?php if($edit_flag) echo $edit_title;?>"></textarea>
					</div>
				</div>
		
				<div class="row" style="margin: 10px auto;display:none;">
					<div class="col-md-12">
						<textarea class="form-control not-round" rows="6" type="text" required name="task" id="desc" placeholder="Enter your task here"><?php if($edit_flag) echo $edit_task;?></textarea>
					</div>
					
				</div>
        <div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<input class="form-control not-round" type="Date" name="dates" id='formn-date'></input>
					</div>
					
				</div>
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<input class="form-control not-round" type="text" name="cron" placeholder="Enter Cron command here" id='cron'></input>
					</div>
					
				</div>
						
				<div class="row" style="margin: 10px auto">
					<div class="col-md-12">
						<select class="form-control not-round" required name="dept" id='form-priority' >
						
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
						<select class="form-control not-round" required name="dept2" id='dept-form'>
						<option value="0"  disabled >Select Department</option>
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
		<button form="addtaskform" type="button" class="btn btn-lg btn-block btn-primary not-round submit-btn" name="submit" onclick="save()">Add Task</button>
		
        </div>
        
		</form>
    
  </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
   
        <button type="button" class="close1" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="edit-tasks-title">Task Details</h4>
      </div>
      <form id="edittaskform">
        <div class="modal-body">
          <div class="row" style="margin: 10px auto;">
            <div class="col-md-12">
              <textarea class="form-control not-round" rows="6" type="text" required id="edit-tasks-desp1" name="edittask"  readonly></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
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
   document.getElementById("title").focus();
   window.stop();
        
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

var inputValue =[];
var input = document.getElementById("title");
input.addEventListener("keypress", function(event) {
   if (event.key === "Enter") {
   var val = document.getElementById('title').value ;
   val = val.split('\n');
   inputValue.push(val);
   console.log(inputValue)
   
  }
});


function save(){

  const keypressEvent = new KeyboardEvent("keypress", {
    key: "Enter", // Specify the key you want to simulate
    charCode: 13, // Optional: ASCII code for Enter key
    keyCode: 13, // Legacy key code for Enter key
    bubbles: true, // The event bubbles up
    cancelable: true // The event can be canceled
  });

// Dispatch the event on the input element
input.dispatchEvent(keypressEvent);


  var lastVal = inputValue[inputValue.length-1];
  console.log(lastVal);

  var string = '';
  for(var i = 0; i<lastVal.length ; i++)
  {
    if( i == lastVal.length-1 )
    {
      string  = string +lastVal[i] ;
    }
    else{
      string  = string +lastVal[i] + '~';
    }
   
    
  }
  console.log(string);
  var desc = $('#desc').val();
  var fdate = $('#formn-date').val();
  var cron = $('#cron').val() ? $('#cron').val() : null;
  var dept = $('#dept-form').val();
  var priority =$('#form-priority').val();

 
  $.ajax({
      url : 'display.php',
      type:'POST',
      data:{function:'store', tasks:string , dates:fdate ,  cron : cron , priority:priority , dept2:dept , dept: <?php echo $department?>},
      success:function(response)
      {
        location.reload();
       
      },error:function(response){alert(response);}


});
}

</script>



		
	</body>
</html>