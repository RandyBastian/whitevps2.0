<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/server_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Name :</label>
				<div class="col-lg-6">
					<input type="text" id="name" name="name" class="form-control" placeholder="Ex : SG1">
				</div>
			</div>
			<div class="form-group">
				<label for="host" class="col-lg-2 control-label">Host :</label>
				<div class="col-lg-6">
					<input type="text" id="host" name="host" class="form-control" placeholder="128.199.xx.xx">
				</div>
			</div>
			<div class="form-group">
				<label for="user_login" class="col-lg-2 control-label">User Login :</label>
				<div class="col-lg-6">
					<input type="text" id="user_login" name="user_login" class="form-control" value="root">
				</div>
			</div>
			<div class="form-group">
				<label for="password_login" class="col-lg-2 control-label">Password Login :</label>
				<div class="col-lg-6">
					<input type="text" id="password_login" name="password_login" class="form-control" value="Randy27Bast!">
				</div>
			</div>
			<div class="form-group">
				<label for="port" class="col-lg-2 control-label">Port Login :</label>
				<div class="col-lg-6">
					<input type="text" id="port" name="port" class="form-control" value="2020">
				</div>
			</div>
			<div class="form-group">
				<label for="area" class="col-lg-2 control-label">Area :</label>
				<div class="col-lg-6" >
					<select class="form-control" name="area" id="area">
						<option value="ASIA">ASIA</option>
						<option value="EUROPE">EUROPE</option>
						<option value="US">US</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="certificate" class="col-lg-2 control-label">Certificate :</label>
				<div class="col-lg-6">
					<textarea id="certificate" name="certificate" class="form-control" rows="5" placeholder="Certificate Here"></textarea>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Create Server">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>