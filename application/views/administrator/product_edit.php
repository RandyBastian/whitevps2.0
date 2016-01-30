<div class="row">
	<div class="col-lg-12">
		<?php echo form_open("administrator/product_edit_submit/$id", array("class" => "form-horizontal", "id" => "userform")); ?>
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Name :</label>
				<div class="col-lg-6">
					<input type="text" id="name" name="name" class="form-control" value="<?php echo $name;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="price_idr" class="col-lg-2 control-label">Price IDR :</label>
				<div class="col-lg-6">
					<input type="text" id="price_idr" name="price_idr" class="form-control" value="<?php echo $price_idr;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="price_usd" class="col-lg-2 control-label">Price USD :</label>
				<div class="col-lg-6">
					<input type="text" id="price_usd" name="price_usd" class="form-control" value="<?php echo $price_usd;?>">
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Update Product">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="hasil"></div>