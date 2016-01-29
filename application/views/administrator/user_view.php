<div class='col-lg-offset-2'>
	<div class='row'>
		<div class='col-lg-3'>Username</div>
		<div class='col-lg-4'>: <?php echo $username; ?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Password</div>
		<div class='col-lg-4'>: <?php echo $password; ?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Credit</div>
		<div class='col-lg-4'>: <?php echo $credit; ?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Role User</div>
		<div class='col-lg-4'>: <?php 
		if($role == 1)
		{
			echo "Administrator";
		} 
		elseif($role == 2)
		{
			echo "Admin";
		}
		else
		{
			echo "Member";
		}
		?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Expired</div>
		<div class='col-lg-4'>: <?php echo $expired; ?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Status</div>
		<div class='col-lg-2'>: <?php 
		if($flag == 1)
		{
			echo "Activated";
		}
		elseif($flag == 0)
		{
			echo "Lock";
		}
		else
		{
			echo "Not Activated";
		}
		?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>Facebook Account</div>
		<div class='col-lg-4'>: <?php echo $facebook; ?></div>
	</div>
	<div class='row'>
		<div class='col-lg-3'>No. Telepon</div>
		<div class='col-lg-4'>: <?php echo $hp; ?></div>
	</div>
</div>