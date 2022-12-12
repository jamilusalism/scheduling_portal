<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM schedules where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	
	<p><b>Programme:</b> <?php echo ucwords($title) ?></p>
	<p><b>State:</b> <?php echo ucwords($state) ?></p>
	<p><b>LGA:</b> <?php echo ucwords($lga) ?></p>
	<p><b>Location:</b> </i> <?php echo $location ?></p>
	<p><b>Contact Person:</b> </i> <?php echo $contact_person ?></p>
	<hr>
	<p><b>Schedule Date:</b> <?php echo $schedule_date ?></p>
	<p><b>Time:</b> </i> <?php echo date('h:i A',strtotime("2022-01-01 ".$time_from)) ?>
	<b>-</b> </i> <?php echo date('h:i A',strtotime("2022-01-01 ".$time_to)) ?></p>
	<hr>
	<p><b>Description:</b> <?php echo $description ?></p>
	<hr class="divider">
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	$('#edit').click(function(){
		uni_modal('Edit Schedule','manage_schedule.php?id=<?php echo $id ?>','mid-large')
	})
	$('#delete_schedule').click(function(){
		_conf("Are you sure to delete this schedule?","delete_schedule",[$(this).attr('data-id')])
	})
	
	function delete_schedule($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_schedule',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>