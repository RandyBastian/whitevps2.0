<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("partner/account/account_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-3 control-label">Username :</label>
				<div class="col-lg-6">
				<label class="control-label"><?php echo $username; ?></label>
				</div>
			</div>
			<div class="form-group">
				<label for="new_password" class="col-lg-3 control-label">New Password :</label>
				<div class="col-lg-6">
					<input type="password" id="new_password" name="new_password" class="form-control" placeholder="*****">
				</div>
			</div>
			<div class="form-group">
				<label for="new_password_confirm" class="col-lg-3 control-label">New Password Confirm :</label>
				<div class="col-lg-6">
					<input type="password" id="new_password_confirm" name="new_password_confirm" class="form-control" placeholder="*****">
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-3">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Change Account Password">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-3" id="hasil"></div>