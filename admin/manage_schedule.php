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

		<div class="col-lg-16">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Select Programme</label>
						<select name="title" id="title" class="custom-select select2" onchange="showUser(this.value)">
							<option value="">Please select programme</option>
						<?php 
							$courses = $conn->query("SELECT * FROM programme order by course asc");
							while($row= $courses->fetch_array()):
						?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($title) && $title == $row['course'] ? 'selected' : '' ?>><?php echo ucwords($row['course']) ?></option>
						<?php endwhile; ?>
						</select>
					
						<input type="hidden" readonly  name="id" value="<?php echo isset($id) ? $id : '' ?>">

						<div id="forEdit">
							<input type="hidden" name="title" id="title" readonly  value="<?php echo isset($title) ? $title : '' ?>">
							<input type="hidden" readonly name="facilitator_email" value="<?php echo isset($facilitator_email) ? $facilitator_email : '' ?>">
							<input type="hidden" readonly name="facilitator_id" value="<?php echo isset($facilitator_id) ? $facilitator_id : '' ?>">
						</div>

						<div id="setFacilitator"><i></i></div>
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
						<label for="" class="control-label">Description Summary</label>
						<textarea class="form-control" name="description" cols="30" rows="5" placeholder="such as total participants, etc"><?php echo isset($description) ? $description : '' ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	
	$('.select2').select2({
		placeholder:'Please select programme',
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


<script>
    function showUser(str) {
        if (str=="") {
            document.getElementById("setFacilitator").innerHTML="";
			$("#forEdit").show(); 
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
				$("#forEdit").hide(); 
            	document.getElementById("setFacilitator").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","assignedFacilitator.php?q="+str,true);
        xmlhttp.send();
    }
</script>