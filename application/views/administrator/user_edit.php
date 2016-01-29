<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/user_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Username :</label>
				<div class="col-lg-6">
					<input type="text" id="username" name="username" class="form-control" value="<?php echo $username;?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password :</label>
				<div class="col-lg-6">
					<input type="text" id="password" name="password" class="form-control" value="<?php echo $password;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="credit" class="col-lg-2 control-label">Credit :</label>
				<div class="col-lg-6">
					<input type="text" id="credit" name="credit" class="form-control" value="0<?php echo $credit;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="role_user" class="col-lg-2 control-label">Role User :</label>
				<div class="col-lg-6">
					<select class="form-control" name="role_user" id="role_user">
					<?php
					if($role == 1)
					{
						echo "<option value='1'>Administrator</option>
						<option value='2'>Admin</option>
						<option value='3'>Member</option>
						";
					}
					elseif($role==2)
					{
						echo "<option value='2'>Admin</option>
						<option value='1'>Administrator</option>
						<option value='3'>Member</option>
						";
					}
					else
					{
						echo "<option value='3'>Member</option>
						<option value='1'>Administrator</option>
						<option value='2'>Admin</option>
						";
					}

					?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="facebook" class="col-lg-2 control-label">Facebook :</label>
				<div class="col-lg-6">
					<input type="text" id="facebook" name="facebook" class="form-control" value="<?php echo $facebook;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="hp" class="col-lg-2 control-label">No. Telepon :</label>
				<div class="col-lg-6">
					<input type="text" id="hp" name="hp" class="form-control" value="<?php echo $hp;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="expired" class="col-lg-2 control-label">Expired :</label>
				<div class="col-lg-6">
					<input type="date" id="expired" name="expired" class="form-control" value="<?php echo $expired;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="status" class="col-lg-2 control-label">Status</label>
				<div class="col-lg-6">
					<select class="form-control" name="status" id="status">
					<?php
					if($flag == 1)
					{
						echo "<option value='1'>Activated</option>
						<option value='0'>Lock</option>
						<option value='2'>Not Activated</option>
						";
					}
					elseif($flag ==0)
					{
						echo "<option value='0'>Lock</option>
						<option value='1'>Activated</option>
						<option value='2'>Not Activated</option>
						";
					}
					else
					{
						echo "<option value='2'>Not Activated</option>
						<option value='1'>Activated</option>
						<option value='0'>Lock</option>
						";
					}
					?>
					</select>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-3" id="loading" style="display:none;">
					<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update User">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>