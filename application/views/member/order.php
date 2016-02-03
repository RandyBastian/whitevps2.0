<div class="row">
<?php
foreach($order as $o)
{
    $id         = $o->id;
    $name       = $o->name;
    $price_idr  = $o->price_idr;
    $price_usd  = $o->price_usd;
?>
	<div class="col-lg-4" style="border-style:dotted">
		<?php echo form_open("order/process/$id", array("class" => "form-horizontal")); ?>
			<div class="form-group">
				<label for="product" class="col-lg-4 control-label">Product :</label>
				<div class="col-lg-6">
				<label class="control-label"><?php echo $name; ?></label>
				</div>
			</div>
			<div class="form-group">
				<label for="price_idr" class="col-lg-4 control-label">Price IDR :</label>
				<div class="col-lg-6">
				<label class="control-label">Rp. <?php echo $price_idr; ?> ,00</label>
				</div>
			</div>
			<div class="form-group">
				<label for="product" class="col-lg-4 control-label">Price USD :</label>
				<div class="col-lg-6">
				<label class="control-label">$ <?php echo $price_usd; ?></label>
				</div>
			</div>
			<div class="form-group">
				<div class="">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Buy This">
				</div>
			</div>
		</form>
	</div>
<?php
}
?>
</div>