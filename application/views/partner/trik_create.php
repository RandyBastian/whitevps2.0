<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("partner/trik/trik_create_submit", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="judul" class="col-lg-2 control-label">Judul</label>
				<div class="col-lg-9">
					<input type="text" id="judul" name="judul" class="form-control" placeholder="Judul here">
				</div>
			</div>
			<div class="form-group">
				<label for="isi" class="col-lg-2 control-label">isi :</label>
				<div class="col-lg-9">
					<textarea class="form-control" name="isi" id="isi"></textarea>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-9 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Tambah Trik & Tools">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>