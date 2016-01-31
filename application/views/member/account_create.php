<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("member/account_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Username :</label>
				<div class="col-lg-6">
					<input type="text" id="username" name="username" class="form-control" placeholder="Username here">
					<p style="color:red">*Alpha-Numeric Only | More than 5 Character.</p>
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password :</label>
				<div class="col-lg-6">
					<input type="text" id="password" name="password" class="form-control" placeholder="Password here">
					<p style="color:red">*Alpha-Numeric Only |  More than 5 Character.</p>
				</div>
			</div>
			<?php
				if($trial_account > 0)
				{
					?>
					<div class="form-group">
						<label for="type" class="col-lg-2 control-label">Account Type :</label>
						<div class="col-lg-6">
							<select class="form-control" name="type" id="type">
								<option value='FREE'>Free Account - Expired 2 Days</option>
								<option value='PREMIUM'>Premium Account - Expired 30 Days</option>
							</select>
						</div>
					</div>
					<?php
				}
				else
				{?>
					<div class="form-group">
						<label for="type" class="col-lg-2 control-label">Account Type :</label>
						<div class="col-lg-6">
							<select class="form-control" name="type" id="type">
								<option value='PREMIUM'>Premium Account - Expired 30 Days</option>
							</select>
						</div>
					</div>
				<?php
				}
			?>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Create New Account">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>