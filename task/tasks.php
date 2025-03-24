<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- Bootstrap CSS (optional, for styling) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
require_once 'inc/connection.inc.php';
// include "azure_config.php";
// include "azure_auth.php";
// if(!isset($_SESSION["uid"]))
// {
//   echo '<script type="text/javascript">
//   window.location.href = "https://login.microsoftonline.com/'.$ad_config['authentication']['ad']['directory'].'/oauth2/v2.0/authorize?state=AlVuPzNFkwjhujp2CAnAovgkG6Jse0wM&scope=profile+openid+email+offline_access+User.Read&response_type=code&approval_prompt=auto&client_id='.$ad_config['authentication']['ad']['client_id'].'&redirect_uri='.$ad_config['authentication']['ad']['return_url'].'";
// </script>';
// die();
// }

require_once 'inc/header.func.inc.php';
$complition_tick = array(
	"cross.png",
	"tick.png"
);

/*if(!loggedin())
	header('Location: login.php');
*/
$error_messages = array(
	"Incorrect Date. Please Enter a Valid Date",
	"Could Not Perform The Specified Action. Please Try Again.",
	"Could Not Load your event list. Please Try Again.",
	"You Can Edit only one Task at a Time.",
	"Select Atleast one Task to perform This Task"
);

$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$edit_flag = 0;
$no_task_flag = 0;
$userID = $_SESSION['uid'];

include('inc/header.inc.php');
include('inc/navbar.inc.php');
?>
<style>


	table td {
		word-wrap: break-word;
		max-width: 50%;
	}

	#example td {
		white-space: inherit;
	}

	@media only screen and (max-width: 700px) {
		body .modal-dialog {
			width: 600px;
			margin-top: -35px;
			margin-left: -138px;
		}

		table td {
			word-wrap: break-word;
			max-width: 10%;
		}
	}
</style>
<script>
	//alert("sss");
	document.addEventListener('keydown', function(event) {
		// Check if Ctrl key is pressed along with the 'N' key
		if (event.altKey && event.key === 'n') {
			event.preventDefault(); // Prevent the default behavior (usually opening a new window)
			//alert('Ctrl + N shortcut detected!');
			modal.style.display = "block";
			document.getElementById("title").focus();
			// You can add your custom logic here instead of the alert
		}
	});

	const myModal = document.getElementById('moreInfoModal');
	myModal.addEventListener('shown.bs.modal', function() {
		document.getElementById('title').focus();
	});
</script>
<div style=" 
   
    position: absolute;
    top:10%;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;">
	<?php
	if (isset($_POST['submit'])) {
		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['task']));
		// $day_temp = $_POST['day'];
		// $month_temp = $_POST['month'];
		// $year_temp = $_POST['year'];
		$title = $_POST['title'];
		$dept = $_POST['dept'];
		$dept2 = $_POST['dept2'];
		$cron = $_POST['cron'];
		$date = $_POST['dates'];
		// $timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
		$query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron,dates) VALUES ('$task',now(),'$userID',$dept,$dept2,'$title','$cron','$date')";
		//echo $query; 
		if (!mysqli_query($connection, $query))
			$error = 1;
	}

	if (isset($_POST['taskdonesubmit'])) {


		$selectedtasks = $_POST['eid3'];

		$query = "UPDATE `events` SET `done`=1 WHERE `id`='$selectedtasks'";
		//	echo $query;
		if (!mysqli_query($connection, $query))
			$error = 1;
	}

	if (isset($_POST['deletetask-submit'])) {
		$selectedtasks = $_POST['eid2'];

		$query = "DELETE FROM `events` WHERE `id`='$selectedtasks'";
		//	echo $query;
		if (!mysqli_query($connection, $query))
			$error = 1;
	}

	if (isset($_POST['edit-tasks'])) {
		$selectedtasks = $_POST['eid'];

		$query = "DELETE FROM `events` WHERE `id`='$selectedtasks'";
		//	echo $query;
		if (!mysqli_query($connection, $query))
			$error = 1;
		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['edittask']));
		
		$title = $_POST['edittitle'];
		$dept = $_POST['editdept'];
		$dept2 = $_POST['editdept2'];
		$cron = $_POST['ecron'];
		$query = "INSERT INTO `events` (id,`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$selectedtasks','$task',now(),'$userID',$dept,$dept2,'$title','$cron')";
	
		//echo $query; 
		if (!mysqli_query($connection, $query))
			$error = 1;
	}

	$query = "SELECT id, uid, description, done, time, priority, title, department, cron, dates 
          FROM events 
          WHERE done = 0 
          ORDER BY dates DESC, time ASC, priority DESC";

	$query_run = mysqli_query($connection, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) == 0) {
			echo '<div class="task"><center>No Tasks</center></div>';
			$no_task_flag = 1;
		} else {
			echo "\n" . '<form method="POST" id="taskslist">' . "\n\n";
			echo '<table id="example" class="display nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th data-priority="2">Status</th>
                    <th data-priority="3">Task</th>
                    <th>Date</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Event ID</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>';

			$pri = ["Information", "Normal", "Warning", "Danger"];
			$dept = [
				"Magdyn Electronics",
				"Magdyn IT",
				"Magdyn Mechanical",
				"TT Electronics",
				"TT IT",
				"TT Mechanical",
				"Magdyn Accounts",
				"TT Accounts"
			];

			while ($query_row = mysqli_fetch_assoc($query_run)) {
				// Assign values with defaults to avoid warnings
				$id = $query_row['id'] ?? 'N/A';
				$description = trim($query_row['description'] ?? 'No description');
				$done_flag = $query_row['done'] == 1 ? 'Completed' : 'Pending';
				$time = $query_row['dates'] ?? 'Unknown';
				$priority_index = ($query_row['priority'] ?? 1) - 1;
				$priority_text = $pri[$priority_index] ?? 'Unknown';
				$department = $query_row['department'] ?? 'General';
				$title = $query_row['title'] ?? 'Untitled';

				echo '<tr>
                    <td>' . $done_flag . '</td>
                    <td>' . $description . '</td>
                    <td>' . $time . '</td>
                    <td>' . $priority_text . '</td>
                    <td>' . $department . '</td>
                    <td>' . $id . '</td>
                    <td>
                        <a href="#" id ="edit_task_button"  title="Edit">
                            <img src="images/pen_edit.png"  onclick="Edittask(\'' . $title . '\', \'' . htmlspecialchars($description) . '\', \'' . $query_row['priority'] . '\', \'' . $id . '\', \'' . $department . '\', \'' . ($query_row['cron'] ?? '') . '\')">
                        </a>
                        <a href="#" title="Delete">
                            <img src="images/trash.png" onclick="deletetask(' . $id . ', \'' . $title . '\')">
                        </a>
                        <a href="#" title="Complete">
                            <img src="img/trip-finished.png" onclick="completetask(' . $id . ', \'' . $title . '\')">
                        </a>
                    </td>
                </tr>';
			}

			echo '</tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Event ID</th>
                    <th>Edit/Delete</th>
                </tr>
            </tfoot>
        </table>';
			echo '</form>' . "\n";
		}
	} else {
		echo '<div class="task"><center>Query Error</center></div>';
	}
	?>

</div>
</div>


<script>
	function detectmob() {
		if (window.innerWidth <= 800 || window.innerHeight <= 600) {
			return true;
		} else {
			return false;
		}
	}

	if (detectmob()) {
		top.location.href = "https://tt-eybus.com/task/display-mobile.php";
	}

	var colcount = 0;
	$(document).ready(function() {


		$('#myModal').on('hidden.bs.modal', function(e) {
			$(this)
				.find("input,textarea,select")
				.val('')
				.end()
				.find("input[type=checkbox], input[type=radio]")
				.prop("checked", "")
				.end();
		});


		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}

		jqtabels('#example tfoot th').each(function() {
			if ((colcount != 7)) {
				var title = $(this).text();
				if (colcount == 0) {
					$(this).html('<input type="text" style="width:99%" placeholder="&#x1F50D;  ' + title + '" value="Pending" />');

				} else {
					$(this).html('<input type="text" style="width:99%" placeholder="&#x1F50D;  ' + title + '" />');
				}
			}
			colcount++;
		});
		$('#example').show();
		var table = jqtabels('#example').DataTable({
			dom: '<"top">rCt<"footer"><"bottom"ilp><"clear">',
			"order": [
				[1, "desc"]
			],
			rowReorder: {
				selector: 'td:nth-child(3)'
			},

			responsive: true,
			deferRender: true,
			stateSave:true,
			scrollY: $(window).height() - 212,
			scrollCollapse: false,
			scroller: true,

			footerCallback: function(row, data, start, end, display) {
				var api = this.api(),
					data;

				// Remove the formatting to get integer data for summation
				var intVal = function(i) {
					return typeof i === 'string' ?
						i = 1 :
						typeof i === 'number' ?
						i : 0;
				};

				// Total over all pages
				total = api
					.column(6)
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);

				// Total over this page
				pageTotal = api
					.column(6, {
						filter: "applied"
					})
					.data()
					.reduce(function(a, b) {
						return intVal(a) + intVal(b);
					}, 0);

				// Update footer
				$(api.column(6).footer()).html(
					'' + pageTotal + '(' + total + ')'
				);
			}
		});
		var colidx = 0;
		table.columns().every(function() {
			var that = this;
			if (colidx == 0) {
				that
					.search("Pending")
					.draw();
			}
			colidx++;
			$('input', this.footer()).on('keyup change', function() {
				if (that.search() !== this.value) {
					that
						.search(this.value)
						.draw();
				}
			});
		});

	});

	function Edittask(title, desp, dept, id, dept2, cron) {
		console.log(title + ' ' + desp + ' ' + dept);
		$('#editModal').modal('show');
		$('#edit-tasks-desp').val(desp);
		$('#edit-tasks-title').val(title);
		$("#edit-tasks-pro").val(dept);
		$("#edit-tasks-pro2").val(dept2);
		$('#eid').val(id);
		$('#ecron').val(cron);
		$('#editModal').on('shown.bs.modal', function () {
        $('#edit-tasks-title').focus();
    });
	}


	$("#editModal").on("hidden.bs.modal", function() {
		alert('hello');
	});


	function deletetask(id, title) {
		$('#deleteModal').modal('show');
		$("#deletep").html("Are you sure you want to delete <br />(" + title + ")<br /> with id " + id + "!");
		$('#eid2').val(id);
		setTimeout(function() {
			$('#delete_task').focus();
		}, 600);

	}

	function completetask(id, title) {
		$('#completeModal').modal('show');
		$("#completep").html("Are you sure you want to complete <br />(" + title + ")<br /> task with id " + id + "!");
		$('#eid3').val(id);
		setTimeout(function() {
			$('#done_task').focus();
		}, 600);

	}

	$(document).keydown(function(e) {
		if (e.which === 78 && e.altKey) {
			$("#add_task_btn").click();
			console.log("done is here")
		}

	});
</script>







<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog" style="width=100%">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="POST" id="addtaskform">
				<div class="modal-header">
				<h4 class="modal-title">Add Task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				<div class="modal-body">

					<script type="text/javascript">
						function addcopy() {
							//console.log('kkkk');
							var n1 = document.getElementById("title");
							var n2 = document.getElementById("desc");
							n2.value = n1.value;

						}

						// Ensure the DOM is fully loaded before attaching the event listener
						document.addEventListener('DOMContentLoaded', function() {
							// Get the button element by ID
							var addTaskButton = document.getElementById('add_task_btn');

							// Check if the button exists to avoid errors
							if (addTaskButton) {
								// Attach the click event listener to the button
								addTaskButton.addEventListener('click', function() {


									// Set a delay before focusing on the title input field
									setTimeout(function() {
										document.getElementById('title').focus();
									}, 1000); // Delay of 300ms
								});
							}
						});


	





					</script>
					<?php
					if (isset($error)) {
						echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . @$error_messages[$error] . '</div>';
					}
					?>


					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<textarea class="form-control not-round" rows="6" type="text" required name="title" id="title" onkeyup="addcopy();" placeholder="Enter task  here" value="<?php if ($edit_flag) echo $edit_title; ?>"></textarea>
						</div>
					</div>

					<div class="row" style="margin: 10px auto; display:none;">
						<div class="col-md-12">
							<textarea class="form-control not-round" rows="6" type="text" required name="task" id="desc" placeholder="Enter your task here"><?php if ($edit_flag) echo $edit_task; ?></textarea>
						</div>

					</div>
					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<input class="form-control not-round" type="Date" name="dates"></input>
						</div>

					</div>
					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<input class="form-control not-round" type="text" name="cron" placeholder="Enter Cron command here"></input>
						</div>

					</div>

					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<select class="form-control not-round" required name="dept">

								<option value="0" disabled>Select Priority</option>

								<option value="1">Information</option>
								<option value="2">Normal</option>
								<option value="3">Warning</option>
								<option value="4" selected>Danger</option>
							</select>
						</div>

					</div>
					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<select class="form-control not-round" required name="dept2">
								<option value="0" disabled selected>Select User</option>
								<?php
								$query = "SELECT * FROM `department`";
								if ($query_run = mysqli_query($connection, $query)) {
									while ($query_row = mysqli_fetch_assoc($query_run)) {
								?>
										<option value="<?php echo $query_row['department_id']; ?>"><?php echo $query_row['department_name']; ?></option>

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
					<button form="addtaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="submit">Add Task</button>
				</div>
			</form>
		</div>

	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
	<div class="modal-dialog" style="width=100%">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="POST" id="edittaskform">
				<div class="modal-header">
				<h4 class="modal-title">Edit Task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				<div class="modal-body">

					<?php
					if (isset($error)) {
						echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . @$error_messages[$error] . '</div>';
					}
					?>
					<script type="text/javascript">
						function editcopy() {
							//console.log('kkkk');
							var n1 = document.getElementById("edit-tasks-title");
							var n2 = document.getElementById("edit-tasks-desp");
							n2.value = n1.value;
						}
					</script>


					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<textarea class="form-control not-round" rows="6" type="text" required name="edittitle" id="edit-tasks-title" placeholder="Enter task here" onkeyup="editcopy();"></textarea>
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
							<select class="form-control not-round" id="edit-tasks-pro" required name="editdept">
								<option value="1">Information</option>
								<option value="2">Normal</option>
								<option value="3">Warning</option>
								<option value="4">Danger</option>
							</select>
						</div>

					</div>
					<div class="row" style="margin: 10px auto">
						<div class="col-md-12">
							<select class="form-control not-round" required id="edit-tasks-pro2" name="editdept2">
								<option value="0" disabled selected>Select User</option>
								<?php
								$query = "SELECT * FROM `department`";
								if ($query_run = mysqli_query($connection, $query)) {
									while ($query_row = mysqli_fetch_assoc($query_run)) {
								?>
										<option value="<?php echo $query_row['department_id']; ?>"><?php echo $query_row['department_name']; ?></option>

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






<!-- Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
	<div class="modal-dialog" style="width=100%">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="POST" id="deletetaskform">
				<div class="modal-header">
				<h4 class="modal-title">Edit Task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				<div class="modal-body">

					<?php
					if (isset($error)) {
						echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . @$error_messages[$error] . '</div>';
					}
					?>
					<p id="deletep">
						<br data-mce-bogus="1">
					</p>

					<input class="form-control not-round" type="hidden" required name="eid2" id='eid2' placeholder="Enter task title here" "></input>
				
				
			
		</div>

        <div class=" modal-footer">
					<button form="deletetaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="deletetask-submit" id="delete_task">Delete Task</button>
				</div>
			</form>
		</div>

	</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="completeModal" role="dialog">
	<div class="modal-dialog" style="width=100%">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="POST" id="completetaskform">
				<div class="modal-header">
				<h4 class="modal-title">Complete Task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					
				</div>
				<div class="modal-body">

					<?php
					if (isset($error)) {
						echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . @$error_messages[$error] . '</div>';
					}
					?>
					<p id="completep">
						<br data-mce-bogus="1">
					</p>


					<input class="form-control not-round" type="hidden" required name="eid3" id='eid3' placeholder="Enter task title here" "></input>
				
				
			
		</div>

        <div class=" modal-footer">
					<button form="completetaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" id="done_task" name="taskdonesubmit">Complete Task</button>
				</div>
			</form>
		</div>

	</div>
</div>
</div>



<?php include('inc/footer.php'); ?>