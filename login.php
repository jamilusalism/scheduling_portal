<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('admin/db_connect.php');
ob_start();
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Facilitators Scheduling System</title>

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
		position:fixed;
	}
	#main{
		width: calc(100%);
	    height: calc(100%);
		display:flex;
		align-items:center;
		justify-content:center
	}
	#login{
		/* background: url(admin/assets/img/user_bg.); */
	}
	
</style>

<body>

  <main id="main" class=" bg-dark">
  		<div id="login" class="col-md-4">
  			<div class="card">
  				<div class="card-body">
  						
  					<form id="login-form" class="pb-3">
					  <h4 class="py-4"><b>Login as Facilitator</b> <br><br>
					<small><i>Please enter your Facilitators ID to view your training schedules</i></small>
					</h4>
  						<div class="form-group">
  							
  							<input type="text" placeholder="Enter your ID to login" id="id_no" name="id_no" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login_facilitator',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">ID Number is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>