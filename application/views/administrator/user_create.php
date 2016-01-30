<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/user_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="email" class="col-lg-2 control-label">Email :</label>
				<div class="col-lg-6">
					<input type="text" id="email" name="email" class="form-control" placeholder="Ex : budi@white-vps.com">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password :</label>
				<div class="col-lg-6">
					<input type="text" id="password" name="password" class="form-control" placeholder="Password here...">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-lg-2 control-label">First Name :</label>
				<div class="col-lg-6">
					<input type="text" id="first_name" name="first_name" class="form-control" placeholder="Bastian">
				</div>
			</div>
			<div class="form-group">
				<label for="last_name" class="col-lg-2 control-label">Last Name :</label>
				<div class="col-lg-6">
					<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Bastian">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-lg-2 control-label">Address :</label>
				<div class="col-lg-6">
					<input type="text" id="address" name="address" class="form-control" placeholder="Jl. Angkasa Pura ...">
				</div>
			</div>
			<div class="form-group">
				<label for="credit_premium_premium" class="col-lg-2 control-label">Credit Premium :</label>
				<div class="col-lg-6">
					<input type="text" id="credit_premium" name="credit_premium" class="form-control" value="0">
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