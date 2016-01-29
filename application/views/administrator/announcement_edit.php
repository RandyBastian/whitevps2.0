<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/announcement_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="title" class="col-lg-2 control-label">Title :</label>
				<div class="col-lg-6">
					<input type="text" id="title" name="title" class="form-control" value="<?php echo $title;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="tag" class="col-lg-2 control-label">Tag :</label>
				<div class="col-lg-6">
					<input type="text" id="tag" name="tag" class="form-control" value="<?php echo $tag;?>">
					<p style="color:red">*Split Tag using character comma ( , ).</p>
				</div>
			</div>
			<div class="form-group">
				<label for="source" class="col-lg-2 control-label">Source :</label>
				<div class="col-lg-6">
					<textarea id="source" name="source" class="form-control" rows="7"><?php echo $source;?></textarea>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update Announcement">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>