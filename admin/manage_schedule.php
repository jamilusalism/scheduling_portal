<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM schedules where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
if(!empty($repeating_data)){
$rdata= json_decode($repeating_data);
	foreach($rdata as $k => $v){
		 $$k = $v;
	}
	$dow_arr = isset($dow) ? explode(',',$dow) : '';
	// var_dump($start);
}
}
?>
<style>
	
	
</style>
<div class="container-fluid">
	<form action="" id="manage-schedule">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-16">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Select Programme</label>
						<select name="title" id="title" class="custom-select select2">
							<option value="0">Please select programme</option>
						<?php 
							$courses = $conn->query("SELECT * FROM courses order by course asc");
							while($row= $courses->fetch_array()):
						?>
							<option value="<?php echo $row['course'] ?>" <?php echo isset($courses_id) && $courses_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['course']) ?></option>
						<?php endwhile; ?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="" class="control-label">State</label>
						<input type="text" name="state" class="form-control" value="<?php echo isset($state) ? $state:'' ?>" required>
					</div>
					<div class="form-group">
						<label for="" class="control-label">LGA</label>
						<input type="text" name="lga" class="form-control" value="<?php echo isset($lga) ? $lga:'' ?>" required>
					</div>

					<div class="form-group">
						<label for="" class="control-label">Traning Location</label>
						<input type="text" name="location" class="form-control" value="<?php echo isset($location) ? $location:'' ?>" required>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Contact Person</label>
						<input type="text" name="contact_person" id="contact_person" class="form-control" value="<?php echo isset($contact_person) ? $contact_person : '' ?>">
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group for-nonrepeating">
						<label for="" class="control-label">Schedule Date</label>
						<input type="date" name="schedule_date" id="schedule_date" class="form-control" value="<?php echo isset($schedule_date) ? $schedule_date : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Starting Time</label>
						<input type="time" name="time_from" id="time_from" class="form-control" value="<?php echo isset($time_from) ? $time_from : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Ending Time</label>
						<input type="time" name="time_to" id="time_to" class="form-control" value="<?php echo isset($time_to) ? $time_to : '' ?>">
					</div>
					
					<div class="form-group">
						<label for="" class="control-label">Training Description </label>
						<textarea class="form-control" name="description" cols="30" rows="5" placeholder="such as total participants, etc"><?php echo isset($description) ? $description : '' ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="imgF" style="display: none " id="img-clone">
			<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>
<script>
	if('<?php echo isset($id) ? 1 : 0 ?>' == 1){
		if($('#is_repeating').prop('checked') == true){
			$('.for-repeating').show()
			$('.for-nonrepeating').hide()
		}else{
			$('.for-repeating').hide()
			$('.for-nonrepeating').show()
		}
	}
	$('#is_repeating').change(function(){
		if($(this).prop('checked') == true){
			$('.for-repeating').show()
			$('.for-nonrepeating').hide()
		}else{
			$('.for-repeating').hide()
			$('.for-nonrepeating').show()
		}
	})
	$('.select2').select2({
		placeholder:'Please select facilitator',
		width:'100%'
	})
	$('#manage-schedule').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_schedule',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				
			}
		})
	})
	
</script>