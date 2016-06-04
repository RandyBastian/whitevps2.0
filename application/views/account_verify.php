<br>
<br>
<div class="container">
	<center>
		<?php
		if($hasil == "ERROR")
		{
			?>
			<div id="div4" class="error">
                <div class="message-box-wrap">
               <button class="close-but" id="colosebut4">close</button> This is an <strong>Error !!!</strong></div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="success">
				<div class="message-box-wrap">
          	<button class="close-but" id="colosebut2">close</button><strong>Your Account has been Activated !!!.</strong> You can login <a href="<?php  echo site_url("login");?>"> HERE</a></div>
			</div>
			<?php
		}
		?>
	</center>
</div>