<script>

</script>


<div class="top-info-bar">
				
				 
	To-Do
<?php
if(loggedin())
	echo '<button id="add_task_btn" form="taskslist" type="button" class=" pull-left btn btn-success" data-toggle="modal" data-target="#myModal">Add Task</button><a href="logout.php"><button class="pull-right btn btn-danger">Logout</button></a>';
?>
	<button class="pull-right btn btn-warning" data-toggle="modal" data-target="#moreInfoModal">GO TO</button>
</div>

<div class="modal fade" id="moreInfoModal" tabindex="-1" role="dialog" aria-labelledby="moreInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="moreInfoModalLabel">GO-TO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
        <?php
            $query = "SELECT * FROM `department`";
            if($query_run = mysqli_query($connection, $query)){
               while($query_row = mysqli_fetch_assoc($query_run)){
            ?>

            <p><a href="display.php?dept=<?php echo $query_row['department_id'] ;?>">Open <?php echo $query_row['department_name'] ; ?>`s Task</a></p>
              
             
            <?
               }
            }
            ?>
      </div>
    </div>
  </div>
</div>