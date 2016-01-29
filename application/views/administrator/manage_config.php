<div class="row">
	<div class="col-lg-12">
		<?php echo form_open_multipart("administrator/manage_config_submit/$id", array("class" => "form-horizontal", "id" => "file_upload")); ?>
			<div class="form-group">
				<label for="port" class="col-lg-2 control-label">Port :</label>
				<div class="col-lg-6">
					<input type="text" id="port" name="port" class="form-control" placeholder="Ex : 443">
				</div>
			</div>
			<div class="form-group">
				<label for="config" class="col-lg-2 control-label">Configuration Type :</label>
				<div class="col-lg-6">
					<select class="form-control" name="config" id="config">
						<option value="TCP">VPN TCP</option>
						<option value="UDP">VPN UDP</option>
					</select>
				</div>
			</div>
			<div class="col-lg-offset-3" id="loading" style="display:none;">
				<img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="Add Configuration">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-6 col-lg-offset-2" id="result"></div>

<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php echo form_open("administrator/config_multi_action",array("class" => "form-horizontal","id" => "userform")); ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Configuration Type</th>
                                <th style="text-align:center">Port</th>
                                <th style="text-align:center">Download</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Configuration Type</th>
                                <th style="text-align:center">Port</th>
                                <th style="text-align:center">Download</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($config as $data){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data->type;?></td>
                        		<td style="text-align:center"><?php echo $data->port;?></td>
                        		<td style="text-align:center"><a href="<?php echo site_url("download/file/$data->id");?>">Download</a></td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="form-group">
                            <label for="multi_action" class="col-lg-2 control-label">Multi Action :</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="multi_action" id="multi_action">
                                    <option value="1">Delete Configuration File</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-offset-3" id="loading" style="display:none;">
                            <img src="<?php echo base_url();?>assets/loading_2.gif" style="width:400px; height:200px">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-2">
                               <input class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Take Action">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2" id="hasil"></div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>