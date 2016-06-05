<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("partner/user/user_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="credit_premium_premium" class="col-lg-2 control-label">Jumlah Credit :</label>
				<div class="col-lg-6">
					<input type="number" id="credit_premium" name="credit_premium" class="form-control" value="0" required>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Tambah Credit">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>