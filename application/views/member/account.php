<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('member/account_create');?>" class="btn btn-block btn-social btn-dropbox"><i class="fa fa-dropbox"></i> Create New</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php echo form_open("member/account_multi_action",array("class" => "form-horizontal","id" => "userform")); ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Server</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Server</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($account as $data){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data->username;?></td>
                        		<td style="text-align:center"><?php echo $data->created_date;?></td>
                        		<td style="text-align:center">
                        		<?php 
                        			echo $data->expired_date;
                        			if($data->expired_date < date("Y-m-d")){
                        				echo "<p style='color:red'>(Expired)</p>";
                        			}
                        		?></td>
                        		<td style="text-align:center"><?php
                        		foreach($server as $list)
                        		{
                        			if($list->id == $data->id_server)
                        				echo $list->name;
                        		}
                        		?></td>
                        		<td style="text-align:center">
                                    <a target="_blank" href='<?php echo site_url("member/account_edit/$data->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Edit</button></a> | <a target="_blank" href='<?php echo site_url("member/top_up/$data->id");?>'><button type="button" class="btn btn-danger" onclick="return confirm('Add 1 Month Expired Account : <?php echo "$data->username";?> ?')"><i class="fa fa-plus-circle"></i> Top Up 1 Month</button></a>
                        		</td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                    	<div class="form-group">
                            <label for="server" class="col-lg-2 control-label">Select Server :</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="server" id="server">
                                    <?php
                                    	$no = 1;
                                    	foreach($server as $choose_server)
                                    	{
                                    		echo "<option value='$choose_server->id'>$no. $choose_server->name</option>";
                                    		$no++;
                                    	}
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="multi_action" class="col-lg-2 control-label">Multi Action :</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="multi_action" id="multi_action">
                                    <option value="1">Delete Accounts</option>
                                    <option value="2">Move to Selected Server</option>
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
                        <button class="btn btn-warning btn-block" id="refresh">Refresh Accounts Data</button>
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