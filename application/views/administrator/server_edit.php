<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/server_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Name :</label>
				<div class="col-lg-6">
					<input type="text" id="name" name="name" class="form-control" value="<?php echo $name;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host" class="col-lg-2 control-label">Host :</label>
				<div class="col-lg-6">
					<input type="text" id="host" name="host" class="form-control" value="<?php echo $host;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="user_login" class="col-lg-2 control-label">User Login :</label>
				<div class="col-lg-6">
					<input type="text" id="user_login" name="user_login" class="form-control" value="<?php echo $user_login; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="password_login" class="col-lg-2 control-label">Password Login :</label>
				<div class="col-lg-6">
					<input type="text" id="password_login" name="password_login" class="form-control" value="<?php echo $password_login;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="port" class="col-lg-2 control-label">Port Login :</label>
				<div class="col-lg-6">
					<input type="text" id="port" name="port" class="form-control" value="<?php echo $port_login;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="area" class="col-lg-2 control-label">Area :</label>
				<div class="col-lg-6" >
					<select class="form-control" name="area" id="area">
						<?php
						if($area == "ASIA")
						{
							echo "
							<option value='ASIA'>ASIA</option>
							<option value='EUROPE'>EUROPE</option>
							<option value='US'>US</option>";
						}
						elseif($area == "EUROPE")
						{
							echo "
							<option value='EUROPE'>EUROPE</option>
							<option value='ASIA'>ASIA</option>
							<option value='US'>US</option>";
						}
						else
						{
							echo "
							<option value='US'>US</option>
							<option value='ASIA'>ASIA</option>
							<option value='EUROPE'>EUROPE</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="certificate" class="col-lg-2 control-label">Certificate :</label>
				<div class="col-lg-6">
					<textarea id="certificate" name="certificate" class="form-control" rows="5"><?php echo $certificate;?></textarea>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update Server">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>