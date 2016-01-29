<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('administrator/server-create');?>" class="btn btn-block btn-social btn-dropbox"><i class="fa fa-dropbox"></i> Create New</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php echo form_open("administrator/server_multi_action",array("class" => "form-horizontal","id" => "userform")); ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">AREA</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Status Updated</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">AREA</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Status Updated</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($server as $data){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data->name;?></td>
                        		<td style="text-align:center"><?php echo $data->host;?></td>
                        		<td style="text-align:center"><?php echo $data->area;?></td>
                                <td style="text-align:center"><?php echo $data->status;?></td>
                                <td style="text-align:center"><?php echo $data->update_status;?></td>
                        		<td style="text-align:center">
                                    <a target="_blank" href='<?php echo site_url("administrator/server-edit/$data->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"> Edit</i></button></a>
                                    <a target="_blank" href='<?php echo site_url("administrator/manage-config/$data->id");?>'><button type="button" class="btn btn-success"><i class="fa fa-gears"> Config</i></button></a>
                        		</td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="form-group">
                            <label for="multi_action" class="col-lg-2 control-label">Multi Action :</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="multi_action" id="multi_action">
                                    <option value="1">Delete Selected Servers</option>
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
                        <button class="btn btn-warning btn-block" id="refresh">Refresh Servers Data</button>
                    </div>
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