<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("member/account_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
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
				<label for="server" class="col-lg-2 control-label">Server :</label>
				<div class="col-lg-6" >
					<select class="form-control" name="server" id="server">
						<?php
						foreach($server as $list)
						{
							if($list->id == $id_server)
								echo "<option value='$list->id'>1. $list->name</option>";
						}

						$no = 2;
						foreach($server as $list)
						{
							if($list->id == $id_server) continue;
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
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update Account">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>