<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Registered Facilitators</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_facilitator">
					<i class="fa fa-plus"></i> New Facilitator</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">ID No</th>
									<th class="">Full Name</th>
									<th class="">Email</th>
									<th class="">Contact</th>
									<!-- <th class="">Area of Expertise</th>	 -->
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$facilitator =  $conn->query("SELECT *,concat(UPPER(lastname),', ',othernames) as name from facilitators order by concat(UPPER(lastname),', ',othernames) asc");
								while($row=$facilitator->fetch_assoc()):
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><?php echo $row['id_no'] ?></p>
										 
									</td>
									<td class="">
										 <p><?php echo ucwords($row['name']) ?></p>
										 
									</td>
									<td class="">
										 <p><?php echo $row['email'] ?></p>
									</td>
									<td class="text-right">
										 <p><?php echo $row['contact'] ?></p>
									</td>
									<td class="text-center">

						<div class="btn-group">
							<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-chevron-bar-down"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
							
								<button class="dropdown-item view_facilitator" type="button" data-id="<?php echo $row['id'] ?>" ><span class="text-primary">View</span></button>
								
								<button class="dropdown-item edit_facilitator" type="button" data-id="<?php echo $row['id'] ?>"><span class="text-primary">Edit</span></button>

								<button class="dropdown-item  delete_facilitator" type="button" data-id="<?php echo $row['id'] ?>" ><span class="text-danger">Delete</span></button>

							</div>
						</div>


									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_facilitator').click(function(){
		uni_modal("Register New Facilitator","manage_facilitator.php",'mid-large')
	})
	$('.view_facilitator').click(function(){
		uni_modal("<b>Facilitator's Details</b>","view_facilitator.php?id="+$(this).attr('data-id'),'')

	})
	$('.edit_facilitator').click(function(){
		uni_modal("<b>Modify Facilitator's Details</b>","manage_facilitator.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_facilitator').click(function(){
		_conf("Are you sure to delete this facilitator?","delete_facilitator",[$(this).attr('data-id')],'mid-large')
	})

	function delete_facilitator($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_facilitator',
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