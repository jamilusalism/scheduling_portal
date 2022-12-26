<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT *,concat(UPPER(lastname),', ',othernames) as name FROM facilitators where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

	$qry = $conn->query("SELECT course FROM programme where id=".$programme_id)->fetch_array();
	foreach($qry as $k =>$v){
		 $$k = $v;
	}

?>
<div class="container-fluid">
	
	<p><b>Name:</b> <?php echo ucwords($name) ?></p>
	<p><b>Area of Expertise:</b> <?php echo ucwords($course) ?></p>
	<p><b>Gender:</b> <?php echo ucwords($gender) ?></p>
	<p><b>ID No.:</b> <?php echo ucwords($id_no) ?></p> <hr>
	<p><b>Email:</b> </i> <?php echo $email ?></p>
	<p><b>Contact:</b> </i> <?php echo $contact ?></p> <hr>
	<p><b>State:</b> <?php echo ucwords($state) ?></p>
	<p><b>LGA:</b> <?php echo ucwords($lga) ?></p>
	<p><b>Address:</b> </i> <?php echo $address ?></p>

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
	
</script>