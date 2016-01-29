<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/account_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Username :</label>
				<div class="col-lg-6">
					<input type="text" id="username" name="username" class="form-control" value="whitevps">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password :</label>
				<div class="col-lg-6">
					<input type="text" id="password" name="password" class="form-control" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<label for="server" class="col-lg-2 control-label">Server List :</label>
				<div class="col-lg-6" >
					<select class="form-control" name="server" id="server">
						<option value='-1'>Choose Server..</option>
						<?php
						$no = 1;
						foreach($server as $list)
						{
							echo "<option value='$list->id'>$no. $list->name</option>";
							$no++;
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Create Account">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>