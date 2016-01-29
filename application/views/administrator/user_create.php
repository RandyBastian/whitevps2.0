<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/user_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Username :</label>
				<div class="col-lg-6">
					<input type="text" id="username" name="username" class="form-control" placeholder="Ex : whitevps">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password :</label>
				<div class="col-lg-6">
					<input type="text" id="password" name="password" class="form-control" placeholder="Ex : whitevps">
				</div>
			</div>
			<div class="form-group">
				<label for="credit" class="col-lg-2 control-label">Credit :</label>
				<div class="col-lg-6">
					<input type="text" id="credit" name="credit" class="form-control" value="0">
				</div>
			</div>
			<div class="form-group">
				<label for="role_user" class="col-lg-2 control-label">Role User :</label>
				<div class="col-lg-6">
					<select class="form-control" name="role_user" id="role_user">
						<option value="3">Member</option>
						<option value="2">Admin</option>
						<option value="1">Administrator</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="facebook" class="col-lg-2 control-label">Facebook :</label>
				<div class="col-lg-6">
					<input type="text" id="facebook" name="facebook" class="form-control" value="facebook.com/">
				</div>
			</div>
			<div class="form-group">
				<label for="telp" class="col-lg-2 control-label">No. Telepon :</label>
				<div class="col-lg-6">
					<input type="text" id="telp" name="telp" class="form-control" placeholder="Ex : 087xxxxxxxx">
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Create User">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>