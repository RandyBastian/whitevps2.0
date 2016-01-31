<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("member/profil_update", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Email :</label>
				<div class="col-lg-6">
					<label class="control-label"><?php echo $email;?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Credit :</label>
				<div class="col-lg-6">
					<label class="control-label"><?php echo $credit_premium;?></label>
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-lg-2 control-label">First Name :</label>
				<div class="col-lg-6">
					<input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $first_name;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="last_name" class="col-lg-2 control-label">Last Name :</label>
				<div class="col-lg-6">
					<input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $last_name;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-lg-2 control-label">Address :</label>
				<div class="col-lg-6">
					<textarea class="form-control" id="address" name="address" rows="5"><?php echo $address;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="no_hp" class="col-lg-2 control-label">No. HP :</label>
				<div class="col-lg-6">
					<input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo $no_hp;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="facebook" class="col-lg-2 control-label">Facebook :</label>
				<div class="col-lg-6">
					<input type="text" id="facebook" name="facebook" class="form-control" value="<?php echo $facebook;?>">
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update Profile">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>