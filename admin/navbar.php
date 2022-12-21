
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark pt-5' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home "><span class='icon-field'><i class="fa fa-home"></i></span> Dashboard</a>

				<a href="index.php?page=schedule" class="nav-item nav-schedule"><span class='icon-field'><i class="fa fa-calendar-day"></i></span> Manage Schedule</a>
				<?php if($_SESSION['login_type'] == 1): ?>
					
				<a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i class="fa fa-list"></i></span> Manage Programme</a>
				
				<a href="index.php?page=facilitator" class="nav-item nav-facilitator"><span class='icon-field'><i class="fa fa-user-tie"></i></span> Manage Facilitators</a>
			
					<!-- <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a> -->

			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
