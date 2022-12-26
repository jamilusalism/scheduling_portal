<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM facilitators where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid py-3">
	<form action="" id="manage-facilitator">
		<div id="msg"></div>
				<input type="hidden" name="id" 
				value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" readonly class="form-control">
		
		
		<div class="row form-group" hidden>
			<div class="col-md-4">
						<label class="control-label">ID No.</label>
						<input type="text" name="id_no" readonly class="form-control" value="<?php echo isset($id_no) ? $id_no:'' ?>" >
						<small><i>Leave this blank if you want to a auto generate ID no.</i></small>
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Last Name</label>
				<input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname:'' ?>" required>
			</div>
			<div class="col-md-8">
				<label class="control-label">Other Name(s)</label>
				<input type="text" name="othernames" class="form-control" value="<?php echo isset($othernames) ? $othernames:'' ?>" required>
			</div>
			
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender</label>
				<select name="gender" required="" class="custom-select" id="">
					<option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
					<option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">State of Residence</label>
				<input type="state" name="state" class="form-control" value="<?php echo isset($state) ? $state:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">LGA of Residence</label>
				<input type="lga" name="lga" class="form-control" value="<?php echo isset($lga) ? $lga:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Area of Expertise</label>
				<select name="programme_id" required="" class="custom-select" id="">
					<option value="">Select please...</option>
					<?php 
							$courses = $conn->query("SELECT * FROM programme order by course asc");
							while($row= $courses->fetch_array()):
						?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($programme_id) && $programme_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['course']) ?></option>
						<?php endwhile; ?>
				</select>
			</div>
			
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('#manage-facilitator').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_facilitator',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Data successfully saved.",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}else if(resp == 2){
					$('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
					end_load();
				}
			}
		})
	})
</script>